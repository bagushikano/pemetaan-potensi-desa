@extends('/layout/layout')
@push('duar')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <h1 class="h3 mb-2 text-gray-800">Edit pasar</h1>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lokasi pasar</h6>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data pasar</h6>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form method="POST" action="{{ route('pasar-update', $pasar->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="nama_pasar">Nama pasar</label>
                                                        <input value="{{ $pasar->nama }}" type="text" class="form-control" name="nama_pasar" id="nama_pasar" placeholder="Ex: Pasar peguyangan" required>
                                                    </div>
                                                </div>
                                                <div class="input-group mt-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="desa">Desa</label>
                                                    </div>
                                                    <select class="custom-select" id="desa" name="desa">
                                                        @foreach ($desa as $desas)
                                                            @if ($desas->id == $pasar->id)
                                                            <option selected value={{ $desas->id }}>{{ $desas->nama}}</option>
                                                            @else
                                                            <option value={{ $desas->id }}>{{ $desas->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="alamat_pasar">Alamat pasar</label>
                                                        <input value="{{ $pasar->alamat }}" type="text" class="form-control" name="alamat_pasar" id="alamat_pasar" placeholder="Ex: Jalan astasura" required>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="lat">Data latitude</label>
                                                        <input value={{ $pasar->lat }} type="text-area" class="form-control" name="lat" id="lat" placeholder="" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="lng">Data longitude</label>
                                                        <input value={{ $pasar->lng }} type="text-area" class="form-control" name="lng" id="lng" placeholder="" required readonly>
                                                    </div>
                                                </div>

                                            </div>
                                            <a onclick='this.parentNode.submit(); return false;' class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Simpan data pasar</span>
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
            $('#pasar').addClass('active');
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
        var pasar = {!! json_encode($pasar) !!};
        var marker;
        marker = L.marker([pasar.lat, pasar.lng]).bindPopup().addTo(mainMap);
        mainMap.on('click', function(e){
            if (marker) { // check
                mainMap.removeLayer(marker); // remove
            }
            marker = L.marker(e.latlng, {}).addTo(mainMap);
            document.getElementById('lat').value=e.latlng.lat;
            document.getElementById('lng').value=e.latlng.lng;
        });
    </script>


    @if((session('done')))
    <script>
        $(document).ready(function(){
            alertDone('Data pasar berhasil di edit')
        });
    </script>
    @endif

    @if((session('failed')))
        <script>
            $(document).ready(function(){
                alertFail('Data pasar gagal di edit')
            });
        </script>
    @endif
@endpush
