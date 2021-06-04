@extends('/layout/layout')
@push('duar')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <h1 class="h3 mb-2 text-gray-800">Edit desa</h1>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lokasi desa</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        <div id="mapid"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Data desa</h6>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form method="POST" action="{{ route('desa-update',  $desa->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="nama_desa">Nama desa</label>
                                                        <input value="{{ $desa->nama}}" type="text" class="form-control" name="nama_desa" id="nama_desa" placeholder="Ex: peguyangan" required>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="koordinat">Data koordinat</label>
                                                        <input value="{{ $desa->area}}" type="text-area" class="form-control" name="koordinat" id="koordinat" placeholder="" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <a onclick='this.parentNode.submit(); return false;' class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Simpan data</span>
                                            </a>
                                        </form>
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
@push('anjay')
    <script>
        $(document).ready(function(){
            $('#desa').addClass('active');
        });

        let mainMap = L.map('mapid').setView([-8.612193497317223, 115.21365428261726], 10);
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
                    'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
        }).addTo(mainMap);


        var desa = {!! json_encode($desa) !!};
        var id = jQuery.parseJSON(desa['id']);
        var bruh = JSON.parse(desa['area']);
        var polygon = L.polyline(bruh, {id: id, color: 'red'}).addTo(mainMap);
        polygon.on('pm:update', e => {
            editLine(e);
        });

        polygon.on('pm:remove', e => {
            document.getElementById('koordinat').value="";
        });

        function editLine(njay) {
            var coords = njay.layer._latlngs;
            console.log(coords);
            data = [];
            for (i=0; i<coords.length; i++) {
                data.push([coords[i].lat, coords[i].lng]);
            }
            document.getElementById('koordinat').value=JSON.stringify(data);
        }

            // add toolbar to map
        mainMap.pm.addControls({
            position: 'topleft',
            drawCircle: false,
            drawMarker: false,
            rotateMode: false,
            editMode: true,
            drawCircleMarker:false,
            drawRectangle: false,
            drawPolygon: false,
            drawPolyline: true,
            dragMode:false,
            cutPolygon: false,
        });
        var freshPoly;
        // create new polyline here
        mainMap.on('pm:create', ({ layer}) => {
            layer.on('pm:edit', e => {
                editLine(e);
            });
            layer.on('pm:remove', e => {
                document.getElementById('koordinat').value="";
            });
            var coords = layer.getLatLngs();
            console.log(coords);
            data = [];
            for (i=0; i<coords.length; i++) {
                data.push([coords[i].lat, coords[i].lng]);
            }
            document.getElementById('koordinat').value=JSON.stringify(data);
        });
    </script>


    @if((session('done')))
    <script>
        $(document).ready(function(){
            alertDone('Data desa berhasil di edit')
        });
    </script>
    @endif

    @if((session('failed')))
        <script>
            $(document).ready(function(){
                alertFail('Data desa gagal di edit')
            });
        </script>
    @endif
@endpush
