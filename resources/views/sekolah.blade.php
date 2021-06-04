@extends('/layout/layout')
@push('duar')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <h1 class="h3 mb-2 text-gray-800">Manajemen sekolah</h1>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar sekolah</h6>
                                    <a href={{ route('sekolah-add') }} class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah sekolah</span>
                                    </a>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        @if ($sekolah->count() < 1)
                                        <div class="card-body my-auto">
                                            <p class="fs-5 my-auto text-center">Tidak ada sekolah</p>
                                        </div>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama sekolah</th>
                                                        <th>Jenjang</th>
                                                        <th>Jenis sekolah</th>
                                                        <th>Alamat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sekolah as $data)
                                                        <tr class="text-center align-middle my-auto">
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $data->nama }}</td>
                                                            <td class="align-middle">{{ $data->jenjang->jenjang }}</td>
                                                            @if ($data->jenis_sekolah == 0)
                                                                <td class="align-middle">Sekolah negeri</td>
                                                            @else
                                                                <td class="align-middle">Sekolah swasta</td>
                                                            @endif
                                                            <td class="align-middle">{{ $data->alamat }}</td>

                                                            <td>
                                                                <form action="{{ route('sekolah-show-update', $data->id) }}" class="d-inline">
                                                                    @csrf
                                                                    <a onclick='this.parentNode.submit(); return false;' class="btn btn-primary btn-icon-split">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-eye"></i>
                                                                        </span>
                                                                        <span class="text">Update sekolah</span>
                                                                    </a>
                                                                </form>
                                                                <form action="{{ route('sekolah-delete', $data->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <a onclick='this.parentNode.submit(); return false;' class="btn btn-danger btn-icon-split">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-trash"></i>
                                                                        </span>
                                                                        <span class="text">Hapus sekolah</span>
                                                                    </a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
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
    </script>
    @if((session('done-delete')))
    <script>
        $(document).ready(function(){
            alertDone('Data sekolah berhasli di hapus')
        });
    </script>
    @endif

    @if((session('failed-delete')))
        <script>
            $(document).ready(function(){
                alertFail('Data sekolah gagal di hapus')
            });
        </script>
    @endif
@endpush
