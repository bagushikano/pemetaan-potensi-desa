@extends('/layout/layout')
@push('duar')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <h1 class="h3 mb-2 text-gray-800">Edit sekolah</h1>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-lg-8">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Lokasi sekolah</h6>
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
                                    <h6 class="m-0 font-weight-bold text-primary">Data sekolah</h6>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <form method="POST" action="{{ route('sekolah-update', $sekolah->id) }}">
                                            @csrf
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="nama_sekolah">Nama sekolah</label>
                                                        <input value="{{ $sekolah->nama }}" type="text" class="form-control" name="nama_sekolah" id="nama_sekolah" placeholder="Ex: SDN 1" required>
                                                    </div>
                                                </div>
                                                <div class="input-group mt-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="jenjang_sekolah">Jenjang sekolah</label>
                                                    </div>
                                                    <select class="custom-select" id="jenjang_sekolah" name="jenjang_sekolah">
                                                        @foreach ($jenjang as $jenjangs)
                                                            @if ($jenjangs->id == $sekolah->id_jenjang)
                                                            <option selected value={{ $jenjangs->id }}>{{ $jenjangs->jenjang}}</option>
                                                            @else
                                                            <option value={{ $jenjangs->id }}>{{ $jenjangs->jenjang}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group mt-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="jenis_sekolah">Jenis sekolah</label>
                                                    </div>
                                                    <select class="custom-select" id="jenis_sekolah" name="jenis_sekolah">
                                                        @if ($sekolah->jenis_sekolah == 0)
                                                        <option selected value=0>Sekolah negeri</option>
                                                        <option value=1>Sekolah swasta</option>
                                                        @else
                                                        <option value=0>Sekolah negeri</option>
                                                        <option selected value=1>Sekolah swasta</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="input-group mt-3">
                                                    <div class="input-group-prepend">
                                                        <label class="input-group-text" for="desa">Desa</label>
                                                    </div>
                                                    <select class="custom-select" id="desa" name="desa">
                                                        @foreach ($desa as $desas)
                                                            @if ($desas->id == $sekolah->id)
                                                            <option selected value={{ $desas->id }}>{{ $desas->nama}}</option>
                                                            @else
                                                            <option value={{ $desas->id }}>{{ $desas->nama}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="alamat_sekolah">Alamat sekolah</label>
                                                        <input value="{{ $sekolah->alamat }}" type="text" class="form-control" name="alamat_sekolah" id="alamat_sekolah" placeholder="Ex: Jalan astasura" required>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="lat">Data latitude</label>
                                                        <input value="{{ $sekolah->lat }}" type="text-area" class="form-control" name="lat" id="lat" placeholder="" required readonly>
                                                    </div>
                                                </div>
                                                <div class="form-row mt-3">
                                                    <div class="col">
                                                        <label for="lng">Data longitude</label>
                                                        <input value="{{ $sekolah->lng }}" type="text-area" class="form-control" name="lng" id="lng" placeholder="" required readonly>
                                                    </div>
                                                </div>

                                            </div>
                                            <a onclick='this.parentNode.submit(); return false;' class="btn btn-primary btn-icon-split">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                                <span class="text">Simpan data sekolah</span>
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
            $('#sekolah').addClass('active');
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

        var sekolah = {!! json_encode($sekolah) !!};
        var marker;
        marker = L.marker([sekolah.lat, sekolah.lng]).bindPopup().addTo(mainMap);
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
            alertDone('Data sekolah berhasil di edit')
        });
    </script>
    @endif

    @if((session('failed')))
        <script>
            $(document).ready(function(){
                alertFail('Data sekolah gagal di edit')
            });
        </script>
    @endif
@endpush
