@extends('/layout/layout')
@push('duar')
    <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
    <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
    <style>
        #mapid { height: 50vh; }
    </style>
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total tempat ibadah</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $tempatIbadah->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-place-of-worship fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total pasar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pasar->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-store fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total sekolah</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sekolah->count() }}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Peta Batas Desa</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div id="mapid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            @endsection
            <!-- End of Main Content -->
            @include('/layout/desa-info-modal')
            @include('/layout/pasar-info-modal')
            @include('/layout/sekolah-info-modal')
            @include('/layout/tempat-ibadah-info-modal')
@push('anjay')
    <script>
        $(document).ready(function(){
            $('#beranda').addClass('active');
            let mainMap = L.map('mapid').setView([-8.612193497317223, 115.21365428261726], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mainMap);

            var markerIcon = L.Icon.extend({
                options: {
                    iconSize: [40, 40]
                }
            });

            var pasarIcon = new markerIcon({iconUrl: '{{ URL::asset('icon/marker_pasar.png') }}' }),
                sekolahIcon = new markerIcon({iconUrl: '{{ URL::asset('icon/marker_sekolah.png') }}' }),
                tempatIbadahIcon = new markerIcon({iconUrl: '{{ URL::asset('icon/marker_agama.png') }}'
            });

            var desa = {!! json_encode($desa->toArray()) !!}
            var sekolah = {!! json_encode($sekolah->toArray()) !!}
            var pasar = {!! json_encode($pasar->toArray()) !!}
            var tempatIbadah = {!! json_encode($tempatIbadah->toArray()) !!}
            var agama = {!! json_encode($agama->toArray()) !!}
            var jenjang = {!! json_encode($jenjang->toArray()) !!}

            pasar.forEach(element => {
                var id = jQuery.parseJSON(element['id']);
                var marker = L.marker([element['lat'], element['lng']], {icon: pasarIcon}).addTo(mainMap);
                marker.on('click', function(e){
                    $('#infoPasar').modal('show');
                    document.getElementById('namaPasar').innerHTML=( element['nama']);
                    document.getElementById('alamatPasar').innerHTML=( element['alamat']);
                    var duar2 = desa.find(item => item.id === element['id_desa']);
                    document.getElementById('lokasiDesaPasar').innerHTML=(duar2['nama']);
                });
            });

            sekolah.forEach(element => {
                var id = jQuery.parseJSON(element['id']);
                var marker = L.marker([element['lat'], element['lng']], {icon: sekolahIcon}).addTo(mainMap);
                marker.on('click', function(e){
                    $('#infoSekolah').modal('show');
                    document.getElementById('namaSekolah').innerHTML=( element['nama']);
                    document.getElementById('alamatSekolah').innerHTML=( element['alamat']);
                    if (element['jenis_sekolah'] == 0) {
                        document.getElementById('jenisSekolah').innerHTML=( "Sekolah negeri");
                    }
                    else if (element['jenis_sekolah'] == 1) {
                        document.getElementById('jenisSekolah').innerHTML=( "Sekolah swasta");
                    }
                    var duar = jenjang.find(item => item.id === element['id_jenjang']);
                    var duar2 = desa.find(item => item.id === element['id_desa']);
                    document.getElementById('lokasiDesaSekolah').innerHTML=(duar2['nama']);
                    document.getElementById('jenjangSekolah').innerHTML=(duar['jenjang']);
                });
            });

            tempatIbadah.forEach(element => {
                var id = jQuery.parseJSON(element['id']);
                var marker = L.marker([element['lat'], element['lng']], {icon: tempatIbadahIcon}).addTo(mainMap);
                marker.on('click', function(e){
                    $('#infoTempatIbadah').modal('show');
                    document.getElementById('namaTempatIbadah').innerHTML=( element['nama']);
                    document.getElementById('alamatTempatIbadah').innerHTML=( element['alamat']);
                    var duar = agama.find(item => item.id === element['id_agama']);
                    var duar2 = desa.find(item => item.id === element['id_desa']);
                    document.getElementById('lokasiDesaTempatIbadah').innerHTML=(duar2['nama']);
                    document.getElementById('agamaTempatIbadah').innerHTML=(duar['agama']);
                });
            });

            desa.forEach(element => {
                var id = jQuery.parseJSON(element['id']);
                var bruh = JSON.parse(element['area']);
                var polygon = L.polyline(bruh, {id: id, color: 'red'}).addTo(mainMap);
                polygon.on('click', function(e) {
                    $('#infoDesa').modal('show');
                    document.getElementById('namaDesa').innerHTML=(element['nama']);
                });
            });

            mainMap.invalidateSize();
        });
    </script>
@endpush
