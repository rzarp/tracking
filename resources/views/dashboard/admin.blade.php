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
                    <th scope="col">Detail</th>
                </tr>
                </thead>
                @foreach ($tracks as $t)
                <tbody>
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{$t->dev_id}}</td>
                    <td>
                    <button class="btn btn-primary" data-toggle="modal" onClick="DetailModal('{{json_encode($t)}}')">Detail</button>
                    </td>
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



<div class="modal fade" role="dialog" id="modalDetailBarang" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            <div class="modal-body">

            <div class="form-group">
                <label for="">Device :</label>
                <span class="input-group-text" id="modal-content"></span>
            </div>

            <div class="form-group">
                <label for="">latitude :</label>
                <span class="input-group-text" id="modal-latitude"></span>
            </div>

            <div class="form-group">
                <label for="">Longtitude :</label>
                <span class="input-group-text" id="modal-longitude"></span>
            </div>

            </div>

            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
    
    <!-- <script>
        // $('.detail-modal').on('click', function (event) {
        //     event.preventDefault();
        //     // tangkap id modal yang ingin dimunculkan
        //     var id = $(this).attr('data-modal');
            
        //     // munculkan modal berdasarkan id
        //     $('#comment-modal-'+id).modal();
        // }
    </script>  -->

    <script>
        var DetailModal = (data) => {
            var json = JSON.parse(data)
            var modal = $('#modalDetailBarang');
            modal.modal ('toggle')
            $('#modal-content').html(json.dev_id);
            $('#modal-latitude').html(json.latitude);
            $('#modal-longitude').html(json.longitude);
            console.log( $('#modal-content'))
        }
    </script>
    
   
@endpush




