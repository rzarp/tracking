<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Google Maps</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 1rem 2rem;
            }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
               <a href="/">Tracks</a>
               <a href="/login">Login</a>
               
              
                <div class="map" id="app">
                    <gmap-map
                        :center="mapCenter"
                        :zoom="10"
                        style="width: 100%; height: 440px;"
                        @click="handleMapClick"
                    >
                    <gmap-info-window
                            :options="infoWindowOptions"
                            :position="infoWindowPosition"
                            :opened="infoWindowOpened"
                            @closeclick="handleInfoWindowClose"
                    >
                    <div class="info-window">
                        <h2>Perangkat Tersambung</h2> <hr>
                        <p v-text="'device id : ' + activetracks.dev_id"></p>
                        <p v-text="'Time : ' + activetracks.time"></p>
                        <p v-text="'Hardware Serial : ' + activetracks.hardware_serial"></p>
                        <p v-text="'Lat  : ' + activetracks.latitude"></p>
                        <p v-text="'Lang : ' + activetracks.longitude"></p>
                    </div>
                
                    </gmap-info-window>
                    <gmap-marker
                        v-for="(r, index) in tracks"
                        :key="r.id"
                        :position="getPosition(r)"
                        :clickable="true"
                        :draggable="false"     
                        @click="handleMarkerClicked(r)"
                    ></gmap-marker>
                </gmap-map>
                </div>
            </div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        <script async defer
        src="https://maps.googleapis.com/maps/api/js?AIzaSyBP70mqIvWolNbVZGWo3vMqEmvwPPVwTog&callback=initMap">
        </script>

    </body>
</html>
