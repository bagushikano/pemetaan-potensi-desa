<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pemetaan Potensi Desa</title>
        <!-- Custom fonts for this template-->
        <link href="{{asset('template/sbadmin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="{{asset('template/sbadmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.css" />
        <script src="https://unpkg.com/@geoman-io/leaflet-geoman-free@latest/dist/leaflet-geoman.min.js"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="{{asset('template/sbadmin/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('template/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{asset('template/sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{asset('template/sbadmin/js/sb-admin-2.min.js')}}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            #mapid { height: 100vh; }
        </style>
    </head>

    <body>
        <div id="mapid">
        </div>
        @include('/layout/desa-info-modal')
        @include('/layout/pasar-info-modal')
        @include('/layout/sekolah-info-modal')
        @include('/layout/tempat-ibadah-info-modal')
        @include('/layout/about-modal')
        <script>
            $(document).ready(function(){
                $('#beranda').addClass('active');
                let mainMap = L.map('mapid').setView([-8.612193497317223, 115.21365428261726], 14);
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

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'black',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: true,
                    showCancelButton: true
                })

                Toast.fire({
                    icon: 'info',
                    title: 'Selamat datang di Aplikasi Pemetaan Potensi Desa!',
                    text: 'Untuk melihat informasi Desa silahkan klik pada batas Desa dan untuk informasi potensi Desa klik marker pada peta.',
                    confirmButtonText: 'Oke!',
                    cancelButtonText: 'Tentang aplikasi'
                }).then((result) => {
                if (result.isDismissed) {
                    $('#aboutApp').modal('show');
                }})
            });
        </script>
    </body>
</html>
