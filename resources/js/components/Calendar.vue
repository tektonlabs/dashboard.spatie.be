<template>

    <tile :position="position">
        <h1 class="text-3xl text-center border-b border-grey mb-3 pb-2">{{ niceFormat(Date.now(), "MMMM") }} {{ calendarTitle }}</h1>
        <div class="px-3">
            <ul class="align-self-center" v-if="isCalendarEmpty == false">
                <li v-for="event in calendarEvents.events" class="mb-3">
                    <ul class="align-self-center">
                        <li><div class="text-xl" :class="{ 'font-bold text-2xl': isToday(event.date) }">{{ event.name }}</div></li>
                    </ul>
                    <div class="text-lg text-dimmed" v-if="isToday(event.date) == false" :class="{ 'font-bold text-xl': isToday(event.date) }">{{ niceFormat(event.date) }}</div>
                    <div class="text-lg text-dimmed" v-if="isToday(event.date) == true" :class="{ 'font-bold text-xl': isToday(event.date) }">{{ relativeDate(event.date) }}</div>
                </li>
            </ul>
            <div class="grid gap-padding markup text-center align-self-center text-xl text-dimmed" v-else>
                hmm, there's nothing here
            </div>
        </div>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { niceFormat, relativeDate, isToday } from '../helpers';

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
        isToday,

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
            return (this.calendarEvents != null) ? (Object.keys(this.calendarEvents.events).length ? false : true) : true;
        }
    },
};
</script>
