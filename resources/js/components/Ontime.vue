<template>
    <tile :position="position">
        <div class="">
            <h1 class="text-2xl">{{ calendarTitle }}</h1>
            <div class="grid gap-padding h-full markup" v-if="isCalendarEmpty == false">
                <div v-for="event in calendarEvents.events" v-if="relativeDate(event.date) == relativeDate(Date.now())" >
                    <h2 class="font-bold text-lg">{{ event.name }}</h2>
                    <ul class="align-self-center">
                        <li class="text-sm text-dimmed" v-for="attendee in event.attendees">{{ attendee.name }}</li>
                    </ul>
                </div>
            </div>
            <div class="grid gap-padding h-full markup align-self-center" v-if="isCalendarEmpty == true">
                <ul class="align-self-center">
                    <li class="text-sm text-dimmed">No hay registros para hoy</li>
                </ul>
            </div>
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

    props: ['position','calendarTitle'],

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
