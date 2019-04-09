<template>
    <tile :position="position" modifiers="overflow">
        <h1 class="text-3xl text-center border-b border-grey mb-3 pb-2">Help<span class="text-xl">, last updates 🗒 </span></h1>
        <div class="px-3">
            <ul class="align-self-center">
                <li v-for="documentItem in documents" class="mb-4">
                    <div class="text-xl">{{ documentItem.title }}</div>
                    <div class="text-lg text-dimmed">{{documentItem.description}}</div>
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
