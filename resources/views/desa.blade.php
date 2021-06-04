@extends('/layout/layout')
@push('duar')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
        @section('content')
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid mt-5">
                    <h1 class="h3 mb-2 text-gray-800">Manajemen desa</h1>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Daftar desa</h6>
                                    <a href="{{ route('desa-add') }}" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Tambah desa</span>
                                    </a>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div>
                                        @if ($desa->count() < 1)
                                        <div class="card-body my-auto">
                                            <p class="fs-5 my-auto text-center">Tidak ada desa</p>
                                        </div>
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama desa</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($desa as $data)
                                                        <tr class="text-center align-middle my-auto">
                                                            <td class="align-middle">{{ $loop->iteration }}</td>
                                                            <td class="align-middle">{{ $data->nama }}</td>
                                                            <td>
                                                                <form action="{{ route('desa-show-update', $data->id) }}" class="d-inline">
                                                                    @csrf
                                                                    <a onclick='this.parentNode.submit(); return false;' class="btn btn-primary btn-icon-split">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-eye"></i>
                                                                        </span>
                                                                        <span class="text">Update desa</span>
                                                                    </a>
                                                                </form>
                                                                <form action="{{ route('desa-delete', $data->id) }}" method="POST" class="d-inline">
                                                                    @csrf
                                                                    <a onclick='this.parentNode.submit(); return false;' class="btn btn-danger btn-icon-split">
                                                                        <span class="icon text-white-50">
                                                                            <i class="fas fa-trash"></i>
                                                                        </span>
                                                                        <span class="text">Hapus desa</span>
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
                $('#desa').addClass('active');
            });
        </script>

    @if((session('done-delete')))
        <script>
            $(document).ready(function(){
                alertDone('Data desa berhasli di hapus')
            });
        </script>
    @endif

    @if((session('failed-delete')))
        <script>
            $(document).ready(function(){
                alertFail('Data desa gagal di hapus')
            });
        </script>
    @endif
@endpush


