<template>
    <tile :position="position" modifiers="overflow">
        <div class="">
            <h1 class="text-2xl">HELP, Last updates</h1>
            <ul class="align-self-center">
                <li v-for="documentItem in documents" class="help__documents">
                    <h2 class="font-bold">{{ documentItem.title }}</h2>
                    <div class="text-sm text-dimmed">{{documentItem.description}}</div>
                </li>
            </ul>
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

    props: ['position'],

    data() {
        return {
            documents: [],
        };
    },

    methods: {
        relativeDate,

        getEventHandlers() {
            return {
                'Help.LastUpdatedDocuments': response => {
                    this.documents = response.documents;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'help',
            };
        },
    },
};
</script>
