<template>
    <tile :position="position">
        <h1 class="text-3xl text-center border-b border-grey pb-2">💬 Moody</h1>
        <div class="px-3">
            <div class="text-2xl text-center py-3">Today's records: {{ summary.total_comments_today ? summary.total_comments_today : 0 }}</div>
            <div class="flex text-center pb-10">
                <div class="w-1/2  flex-col">
                    <div class="text-5xl">😊</div>
                    <div class="text-3xl">{{ summary.nro_positive_comments ? summary.nro_positive_comments : 0 }}</div>
                    <div class="text-dimmed">{{ summary.positive_comments_percent ? summary.positive_comments_percent : 0 }}%</div>
                </div>
                <div class="w-1/2 flex-col">
                    <div class="text-5xl">😶</div>
                    <div class="text-3xl">{{ summary.nro_neutral_comments ? summary.nro_neutral_comments : 0 }}</div>
                    <div class="text-dimmed">{{ summary.neutral_comments_percent ? summary.neutral_comments_percent : 0 }}%</div>
                </div>
                <div class="w-1/2 flex-col">
                    <div class="text-5xl">😢</div>
                    <div class="text-3xl">{{ summary.nro_negative_comments ? summary.nro_negative_comments : 0 }}</div>
                    <div class="text-dimmed">{{ summary.negative_comments_percent ? summary.negative_comments_percent : 0 }}%</div>
                </div>
            </div>
            <div class="w-full text-right text-dimmed">Powered by Google Cloud Natural Language</div>
        </div>
    </tile>

</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import { addClassModifiers } from '../helpers';
import saveState from 'vue-save-state';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position', 'src'],

    data() {
        return {
            summary: Array(),
        };
    },

    computed: {

    },

    methods: {

        getEventHandlers() {
            return {
                'Moody.LastUpdatedRecords': response => {
                    this.summary = response.summary;
                },
            };
        },
        getSaveStateConfig() {
            return {
                cacheKey: 'moody',
            };
        },
    },
};
</script>
