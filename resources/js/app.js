import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Ontime from './components/Ontime';
import Help from './components/Help';
import Moody from './components/Moody';
import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Statistics from './components/Statistics';
import InternetConnection from './components/InternetConnection';
import TeamMember from './components/TeamMember';
import TimeWeather from './components/TimeWeather';
import TimeZone from './components/TimeZone';
import Trains from './components/Trains';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import Velo from './components/Velo';
import TileTimer from './components/TileTimer';

new Vue({
    el: '#dashboard',

    components: {
        Dashboard,
        Calendar,
        Ontime,
        Help,
        Moody,
        Statistics,
        InternetConnection,
        TeamMember,
        TimeWeather,
        TimeZone,
        Trains,
        Twitter,
        Uptime,
        Velo,
        TileTimer,
    },

    created() {
        let config = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            wsHost: window.location.hostname,
            wsPath: window.dashboard.clientConnectionPath,
            wsPort: window.dashboard.wsPort,
            disableStats: true,
        }

        if (window.dashboard.environment === 'local') {
            config.wsPort = 6001;
        }

        this.echo = new Echo(config);
    },
});
