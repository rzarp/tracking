@extends('dashboard.base')
<!-- @push('scripts')
    <script>
        <script src="{{ mix('js/app.js') }}"></script>
    </script>
@endpush -->
@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>         
    </div>
    <div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-header">
            <h4>List Device</h4>
            </div>
            <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Device</th>
                    <th scope="col">Colors</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($tracks as $t)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$t->dev_id}}</td>
                </tr>
                </tbody>
                @endforeach
            </table>
            </div>
        </div>              
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header">
            <h4>Marker</h4>
            </div>
            <div class="card-body">
            <div class="map" id="app">
                    <gmap-map
                        :center="mapCenter"
                        :zoom="10"
                        style="width: 100%; height: 400px;"
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
    </div>
</div>
@endsection



