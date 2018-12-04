<template>
    <tile :position="position" modifiers="overflow">
        <section class="calendar">
            <h1 class="calendar__title">{{ calendarName }}</h1>
            <div class="calendar__events" v-if="isCalendarEmpty == false">
                <div v-for="event in calendarEvents.events" v-if="relativeDate(event.date) == relativeDate(Date.now())" class="calendar__event" >
                    <div class="calendar__event__title">{{ event.name }}</div>
                    <ul class="calendar__event__attendees">
                        <li v-for="attendee in event.attendees">{{ attendee.name }}</li>
                    </ul>
                </div>
            </div>
            <div v-if="isCalendarEmpty == true">No hay registros para hoy</div>
        </section>
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
