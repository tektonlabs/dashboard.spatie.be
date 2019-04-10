<template>
    <tile :position="position" modifiers="overflow">
        <h1 class="text-3xl text-center border-b border-grey mb-3 pb-2">⏰ World Clock</h1>
        <div class="px-2">
            <ul class="align-self-center" v-for="city in cities">
                <li class=" mb-3">
                    <div class="text-lg"> {{ city.name }} - <span class="text-xl text-dimmed">{{ formatTimeByTimezone(city.timezone, timeFormat)  }}</span> </div>
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
