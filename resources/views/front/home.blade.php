@extends('front.main')
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2>Titik Lokasi Bencana Alam Depok (1 minggu terakhir)</h2>

                <div id="mapid" style="height: 500px;"></div>
            </div>
        </div>
    </div>

    <input type="hidden" id="disastersInput" value="{{ $disasters }}">
@endsection
@push('js')
    <script>
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

        let map = L.map('mapid', mapOptions);

        let disastersInput = document.querySelector('#disastersInput').value;

        let disasters = JSON.parse(disastersInput);

        disasters.forEach(disaster => {
            L.marker([disaster.lat, disaster.long]).addTo(map)
                .bindPopup(disaster.nama)
                .openPopup();
        });
    </script>
@endpush
