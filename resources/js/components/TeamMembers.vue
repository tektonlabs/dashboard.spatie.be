<template>
    <tile :position="position" modifiers="overflow">
        <h1 class="text-3xl text-center border-b border-grey mb-3 pb-2">TK Members<span class="text-xl">, at clients' offices 👩‍💼👨‍💼 </span></h1>
        <div class="px-3 flex mb-4">
                <div class="px-2 w-1/4" v-for="teamMember in teamMembers">
                    <div class="text-xl mb-3 uppercase">{{ teamMember.client }}</div>
                        <ul class="align-self-center">
                            <li v-for="member in teamMember.members">
                                <span class="text-lg text-dimmed">{{member}}</span>
                            </li>
                        </ul>
                </div>
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
            teamMembers: [],
        };
    },

    methods: {
        relativeDate,

        getEventHandlers() {
            return {
                'TeamMembers.MembersFetched': response => {
                    this.teamMembers = response.teamMembers;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'team-members',
            };
        },
    },
};
</script>
