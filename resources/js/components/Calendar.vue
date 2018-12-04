<template>
    <tile :position="position" modifiers="overflow">
        <section class="calendar">
            <h1 class="calendar__title">{{ calendarName }}</h1>
            <ul class="calendar__events" v-if="isCalendarEmpty == false">
                <li v-for="event in calendarEvents.events" class="calendar__event">
                    <h2 class="calendar__date">{{ niceFormat(event.date) }}</h2>
                    <ul class="calendar__event__attendees">
                        <li>{{ event.name }}</li>
                    </ul>
                </li>
            </ul>
            <div v-if="isCalendarEmpty == true">No hay registros para hoy</div>
        </section>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { niceFormat } from '../helpers';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position', 'calendarSummary'],

    data() {
        return {
            calendarName: "",
            calendarEvents: null,
        };
    },

    methods: {
        niceFormat,

        getEventHandlers() {
            return {
                'Calendar.EventsFetched': response => {
                    this.calendarName = response.calendarEvents[this.calendarSummary].calendarName;
                    this.calendarEvents = response.calendarEvents[this.calendarSummary];
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'calendar',
            };
        },
    },
    computed: {
        isCalendarEmpty: function() {
            return Object.keys(this.calendarEvents.events).length ? false:true;
        }
    },
};
</script>
