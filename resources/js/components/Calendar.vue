<template>

    <tile :position="position">
        <div class="">
            <h1 class="text-2xl">{{ niceFormat(Date.now(), "MMMM") }} {{ calendarTitle }}</h1>
            <ul class="align-self-center" v-if="isCalendarEmpty == false">
                <li v-for="event in calendarEvents.events">
                    <h2>{{ niceFormat(event.date) }}</h2>
                    <div class="text-sm text-dimmed">{{ relativeDate(event.date) }}</div>
                    <ul class="align-self-center">
                        <li><div :class="{ 'font-bold': withinWeek(event.date) }">{{ event.name }}</div></li>
                    </ul>
                </li>
            </ul>
            <div class="grid gap-padding h-full markup" v-if="isCalendarEmpty == true">
                <ul class="align-self-center">
                    <li class="text-sm text-dimmed">No records found</li>
                </ul>
            </div>
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

    props: ['position', 'calendarSummary', 'calendarTitle'],

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
