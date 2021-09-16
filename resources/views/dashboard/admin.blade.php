@extends('dashboard.base')
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
                <div id="map-canvas" class="map" style="width:600px;height:400px"></div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBP70mqIvWolNbVZGWo3vMqEmvwPPVwTog&callback=initialize"></script> -->
    <script>
        //Untuk pengaturan map center
        window.zoom = 5;

        // var koordinat = { lat: -6.373643041124395, lng: 106.784204331353 };

        window.lat = -6.373643041124395;
        window.lng = 106.784204331353;

        

        function init() {
            fetch('http://localhost:8000/api/tracks')
            .then(response => response.json(), (err) => console.log(err))
            .then(data => {
                initMap(data);
            });
        }

        var map;
        var LatLng;

        function getRandomArbitrary(min, max) {
            return Math.random() * (max - min) + min;
        }

        function updatePosition(datas, lastLocations) {
            //-------- EXPERIMENT ---------//
            async function getData(arr) {
                return arr.getPosition();
            }

            getData(datas).then(
                (res) => {
                    LatLng = new google.maps.LatLng(lastLocations.latitude, lastLocations.longitude);
                    datas.setPosition(LatLng);
                    console.log(lastLocations.latitude);
                },
                (err) => {
                    console.log(err);
                }
            );
        }

        function initMap(dataltln) {
            map  = new google.maps.Map(document.getElementById('map-canvas'), {center:{lat:lat,lng:lng},zoom:zoom});
            setInterval(() => {
                    fetch('http://localhost:8000/api/tracks')
                    .then(response => response.json(), (err) => console.log(err))
                    .then(data => {
                        console.log(data);
                        data.forEach((e,i) => {
                            dataltln[i].latitude = parseFloat(e.latitude);
                            dataltln[i].longtitude =parseFloat(e.longtitude);
                        })
                    })
                    // updatePosition(markers);
                },3000);
            dataltln.forEach((e, i) => {
                var markers = new google.maps.Marker({
                                    position:{
                                        lat:e.latitude,
                                        lng:e.longitude
                                    }, map:map
                                });
                //update pake fungsi updatePosition()
                setInterval(() => {
                    updatePosition(markers, dataltln[i]);
                }, 5000);


                // // infoo markers
                // var contentString = '<h2> {{$t->latitude}}  </h2>'  ;

                // var infowindow = new google.maps.InfoWindow({
                //     content: contentString,
                // }); 

                // var marker = new google.maps.Marker({
                //     position: koordinat,
                //     map,
                // });

                // marker.addListener("click", () => {
                // infowindow.open({
                // anchor: marker,
                // map,
                // shouldFocus: false,
                // });

                
                // });
                // ... code
            });


           

           
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP70mqIvWolNbVZGWo3vMqEmvwPPVwTog&callback=init&libraries=places"type="text/javascript"></script>
@endpush
