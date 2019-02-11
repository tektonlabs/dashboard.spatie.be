<template>

    <tile :position="position">
        <div class="">
            <h1 class="calendar__title">{{ calendarName }}</h1>
            <ul class="align-self-center" v-if="isCalendarEmpty == false">
                <li v-for="event in calendarEvents.events" class="calendar__event">
                    <h2 class="calendar__date">{{ niceFormat(event.date) }}</h2>
                    <div class="text-sm text-dimmed">{{ relativeDate(event.date) }}</div>
                    <ul class="align-self-center">
                        <li><div :class="{ 'font-bold': withinWeek(event.date) }">{{ event.name }}</div></li>
                    </ul>
                </li>
            </ul>
            <div v-if="isCalendarEmpty == true">No hay registros para hoy</div>
        </div>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { niceFormat, relativeDate, withinWeek } from '../helpers';

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
        relativeDate,
        withinWeek,

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
