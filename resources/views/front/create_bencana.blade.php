@extends('front.main')
@section('content')
    <div class="container mt-3">
        <form method="POST" action="/disaster">
            @csrf
            <h2 class="text-center mb-3">Form Pelaporan Bencana Alam di Kota Depok</h2>
            <hr>

            <div class="row">
                <div class="col">
                    <div class="form-group mb-3">
                        <label for="nama">Nama Bencana Alam</label>
                        <input id="nama" name="nama" type="text" class="form-control">
                    </div>

                    <div class="form-group mb-3">
                        <label for="tgl">Tanggal</label>
                        <input id="tgl" name="tgl" type="date" class="form-control">
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="lokasi">Lokasi: (Click on the map)</label>
                                <div id="mapsid" style="height: 400px;" class="mb-3"></div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group mb-3">
                                <label for="lat">Latitude (auto fill by map)</label>
                                <input id="lat" name="lat" type="text" class="form-control bg-light" readonly>
                            </div>

                            <div class="form-group mb-3">
                                <label for="long">Longitude (auto fill by map)</label>
                                <input id="long" name="long" type="text" class="form-control bg-light" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <button name="submit" type="submit" class="btn btn-primary d-block mx-auto">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script>
        const lat = document.querySelector('#lat');
        const long = document.querySelector('#long');

        let centerLatLng = [-6.402854155821783, 106.79616349033121];
        let mapOptions = {
            center: centerLatLng,
            zoom: 13,
            layers: [
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: `&copy; <a href="http://www.openstreetmap.org/copyright"> OpenStreetMap </a>`
                })
            ]
        }

        let map = L.map('mapsid', mapOptions);

        map.on('click', function(e) {
            // assign value to input
            lat.value = e.latlng.lat;
            long.value = e.latlng.lng;

            // remove marker from map
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // add marker to map
            L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
        });
    </script>
@endpush
