@extends('layout.app')

@section('title', 'SPKBalita | Data Orang Tua')

@push('addon-style')
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Orang Tua</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Data Jenjang</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if(auth()->user()->level == 'kader')
                            <a href="{{ url('/orangtua/create') }}" class="btn btn-info float-right mb-2">Tambah Data</a>
                            @endif
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach ($orangtua as $posyandu => $list)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="tab-{{ $loop->index }}-tab" data-bs-toggle="tab" data-bs-target="#tab-{{ $loop->index }}" type="button" role="tab">
                                        {{ $posyandu }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>

                            <div class="tab-content pt-3" id="myTabContent">
                                @foreach ($orangtua as $posyandu => $list)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="tab-{{ $loop->index }}" role="tabpanel" aria-labelledby="tab-{{ $loop->index }}-tab">
                                    <h5><strong>Posyandu: {{ $posyandu }}</strong></h5>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th>Nama Ayah</th>
                                                    <th>Nama Ibu</th>
                                                    <th>Nama Balita</th>
                                                    <th>Jenis Kelamin</th>
                                                    <th>Nomor HP</th>
                                                    <th>Nomor Darurat</th>
                                                    <th>Alamat</th>
                                                    <th>Posyandu</th>
                                                    @if(auth()->user()->level == 'admin')
                                                    <th class="text-right">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $data->user->name }}</td>
                                                    <td>{{ $data->nama_ibu }}</td>
                                                    <td>{{ $data->nama_balita }}</td>
                                                    <td>{{ $data->jenis_kelamin }}</td>
                                                    <td>{{ $data->no_hp }}</td>
                                                    <td>{{ $data->no_darurat }}</td>
                                                    <td>{{ $data->alamat }}</td>
                                                    <td>{{ $data->posyandu }}</td>
                                                    @if(auth()->user()->level == 'kader')
                                                    <td class="text-right">
                                                        <a href="/orangtua/{{ $data->id }}/edit" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('orangtua.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin Hapus Data?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('addon-script')
<!-- DataTables  & Plugins -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script>
@endpush