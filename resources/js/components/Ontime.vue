<template>
    <tile :position="position" modifiers="overflow">
        <div class="">
            <h1 class="calendar__title">{{ calendarName }}</h1>
            <div class="grid gap-padding h-full markup" v-if="isCalendarEmpty == false">
                <div v-for="event in calendarEvents.events" v-if="relativeDate(event.date) == relativeDate(Date.now())" class="calendar__event" >
                    <div class="font-bold">{{ event.name }}</div>
                    <ul class="align-self-center">
                        <li class="text-sm text-dimmed" v-for="attendee in event.attendees">{{ attendee.name }}</li>
                    </ul>
                </div>
            </div>
            <div class="text-sm text-dimmed" v-if="isCalendarEmpty == true">No hay registros para hoy</div>
        </div>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { relativeDate } from '../helpers';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position'],

    data() {
        return {
            calendarName: "",
            calendarEvents: [],
            attendees: [],
        };
    },

    methods: {
        relativeDate,

        getEventHandlers() {
            return {
                'Calendar.EventsFetched': response => {
                    this.attendees = response.calendarEvents['Ontime'].attendees;
                    this.calendarName = response.calendarEvents['Ontime'].calendarName;
                    this.calendarEvents = response.calendarEvents['Ontime'];
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'ontime',
            };
        },
    },
    computed: {
        isCalendarEmpty: function() {
            return  Object.keys(this.calendarEvents.events).length ? false : true;
        }
    },
};
</script>
