@extends('layout.app')

@section('title', 'SPKBalita | Data Balita')

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
                    <h1 class="m-0">Data Balita</h1>
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

                            {{-- Tab Nav --}}
                            <ul class="nav nav-tabs" id="posyanduTab" role="tablist">
                                @foreach ($balitaPerPosyandu as $posyandu => $list)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }}"
                                        id="tab-{{ $loop->index }}-tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#tab-{{ $loop->index }}"
                                        type="button"
                                        role="tab"
                                        aria-controls="tab-{{ $loop->index }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $posyandu }}
                                    </button>
                                </li>
                                @endforeach
                            </ul>

                            {{-- Tab Content --}}
                            <div class="tab-content pt-3" id="posyanduTabContent">
                                @foreach ($balitaPerPosyandu as $posyandu => $list)
                                <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}"
                                    id="tab-{{ $loop->index }}"
                                    role="tabpanel"
                                    aria-labelledby="tab-{{ $loop->index }}-tab">

                                    <h5><strong>Posyandu: {{ $posyandu }}</strong></h5>
                                    @if(auth()->user()->level == 'kader')
                                    <a href="{{ url('/balita/create') }}" class="btn btn-info float-right mb-2">Tambah Data</a>
                                    @endif
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">No</th>
                                                    <th rowspan="2">Nama Balita</th>
                                                    <th class="text-center" rowspan="2">Umur (bulan)</th>
                                                    <th rowspan="2">Jenis Kelamin</th>
                                                    <th rowspan="2">Posyandu</th>
                                                    <th class="text-center" rowspan="2">Berat Badan (Kg)</th>
                                                    <th class="text-center" rowspan="2">Tinggi Badan (cm)</th>
                                                    <th class="text-center" rowspan="2">LILA (cm)</th>
                                                    <th class="text-center" rowspan="2">Lingkar Kepala (cm)</th>
                                                    <th class="text-center" colspan="5">Nilai Antropometri</th>
                                                    @if(auth()->user()->level == 'kader')
                                                    <th rowspan="2" class="text-right">Action</th>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <th class="text-center">TB /U</th>
                                                    <th class="text-center">BB /U</th>
                                                    <th class="text-center">BB /TB</th>
                                                    <th class="text-center">LILA</th>
                                                    <th class="text-center">LKP</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $data)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $data->orangtua->nama_balita }}</td>
                                                    <td class="text-center">{{ $data->umur }}</td>
                                                    <td>{{ $data->orangtua->jenis_kelamin }}</td>
                                                    <td class="text-center">{{ $data->orangtua->posyandu }}</td>
                                                    <td class=" text-center">{{ $data->berat_badan }}</td>
                                                    <td class="text-center">{{ $data->tinggi_badan }}</td>
                                                    <td class="text-center">{{ $data->lila }}</td>
                                                    <td class="text-center">{{ $data->lingkar_kepala }}</td>
                                                    <td class="text-center">{{ $data->tbu }}<br><small>{{ $data->status_tbu }}</small></td>
                                                    <td class="text-center">{{ $data->bbu }}<br><small>{{ $data->status_bbu }}</small></td>
                                                    <td class="text-center">{{ $data->bbtb }}<br><small>{{ $data->status_bbtb }}</small></td>
                                                    <td class="text-center">{{ $data->bobot_lila }}<br><small>{{ $data->status_lila }}</small></td>
                                                    <td class="text-center">{{ $data->bobot_lingkarkepala }}<br><small>{{ $data->status_lingkarkepala }}</small></td>
                                                    @if(auth()->user()->level == 'kader')
                                                    <td class="text-right">
                                                        <a href="{{ route('balita.edit', $data->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('balita.destroy', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin Hapus Data?')">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tableData').DataTable();
    });
</script>
@endpush