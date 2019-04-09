<template>
    <tile :position="position">
        <h1 class="text-3xl text-center border-b border-grey mb-3 pb-2">{{ calendarTitle }}</h1>
        <div v-if="isCalendarEmpty == false">
            <div v-for="event in calendarEvents.events" v-if="relativeDate(event.date) == relativeDate(Date.now())" >
                <div class="border-b border-dotted pb-3" >
                    <div class="uppercase text-2xl">{{ event.name }}</div>
                    <ul class="align-self-center">
                        <li class="text-xl text-dimmed" v-for="attendee in event.attendees">{{ attendee.name }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid gap-padding markup text-center align-self-center text-xl text-dimmed" v-if="isCalendarEmpty == true">
            hmm, there's nothing today
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
            return (this.calendarEvents.length != 0) ? (Object.keys(this.calendarEvents.events).length ? false : true) : true;
        }
    },
};
</script>
