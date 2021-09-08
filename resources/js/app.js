
require('./bootstrap');

window.Vue = require('vue');


// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import { any } from 'async';
import Axios from 'axios';


import * as VueGoogleMaps from 'vue2-google-maps';

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyBP70mqIvWolNbVZGWo3vMqEmvwPPVwTog'
    }
});

const app = new Vue({
    el: '#app',
    data() {
        return {
            tracks: [],
            infoWindowOptions: {
                pixelOffset: {
                    width: 0,
                    height: -35
                }
            },
            activetracks: {},
            infoWindowOpened: false
        }
    },
    created() {
        axios.get('/api/tracks')
            .then((response) => this.tracks = response.data)
            .catch((error) => console.error(error));
    },
    methods: {
        getPosition(r) {
            return {
                lat: parseFloat(r.latitude),
                lng: parseFloat(r.longitude)
            }
        },
        handleMarkerClicked(r) {
            this.activetracks = r;
            this.infoWindowOpened = true;
        },
        handleInfoWindowClose() {
            this.activetracks = {};
            this.infoWindowOpened = false;
        },
        // handleMapClick(e) {
        //     this.tracks.push({
        //         name: "Placeholder",
        //         hours: "00:00am-00:00pm",
        //         city: "Orlando",
        //         state: "FL",
        //         latitude: e.latLng.lat(),
        //         longitude: e.latLng.lng()
        //     });
        // }
    },
    computed: {
        mapCenter() {
            if (!this.tracks.length) {
                return {
                    lat: 10,
                    lng: 10
                }
            }

            return {
                lat: parseFloat(this.tracks[0].latitude),
                lng: parseFloat(this.tracks[0].longitude)
            }
        },
        infoWindowPosition() {
            return {
                lat: parseFloat(this.activetracks.latitude),
                lng: parseFloat(this.activetracks.longitude)
            };
        },
    }
});