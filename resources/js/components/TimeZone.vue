<template>
    <tile :position="position" modifiers="overflow">
        <div class="">
            <h1 class="">World Clock</h1>
            <ul class="align-self-center" v-for="city in cities">
                <li class="text-sm text-dimmed">
                    <div class="font-bold">{{ city.name }}</div>
                    <time class="time-zone__content">
                        <span class="">{{ formatDateByTimezone(city.timezone, dateFormat) }}</span> -
                        <span class="time-zone__time">{{ formatTimeByTimezone(city.timezone, timeFormat)  }}</span>
                    </time>
                </li>
            </ul>
        </div>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { formatDateByTimezone, formatTimeByTimezone  } from '../helpers';


export default {
    mixins: [echo, saveState],

    components: {
        Tile,
    },

    props: {
        dateFormat: {
            type: String,
            default: 'DD-MM-YYYY',
        },
        timeFormat: {
            type: String,
            default: 'HH:mm',
        },
        position: {
            type: String,
        },
    },

    data() {
        return {
            date: '',
            time: '',
            cities: [],
        };
    },

    methods: {
        formatDateByTimezone,
        formatTimeByTimezone,

        getEventHandlers() {
            return {
                'Timezone.TimezonesFetched': response => {
                    this.cities = response.cities;
                },
            };
        },
        getSaveStateConfig() {
            return {
                cacheKey: 'timezone',
            };
        },

    },
};
</script>
