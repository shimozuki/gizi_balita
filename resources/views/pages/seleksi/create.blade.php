@extends('layout.app')

@section('title', 'SPKBalita | Cek Gizi Balita')

@push('addon-style')
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid"></div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-7">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cek Gizi Balita</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/cek-balita') }}" method="GET">
                                <div class="form-group">
                                    <label>Pilih Posyandu</label>
                                    <select name="posyandu" class="form-control select2" onchange="this.form.submit()">
                                        <option disabled selected>Pilih Posyandu</option>
                                        @foreach($posyandus as $pos)
                                        <option value="{{ $pos }}" {{ $selectedPosyandu == $pos ? 'selected' : '' }}>
                                            {{ $pos }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            @if($balita->isNotEmpty())
                            <form action="{{ url('/cek-balita/status-gizi') }}" method="POST">
                                @csrf
                                <h5 class="mt-3">Data Balita</h5>
                                <div class="form-group">
                                    <label>Nama Balita</label>
                                    <select name="id_balita" class="form-control select2">
                                        <option disabled selected>Pilih Nama Balita</option>
                                        @foreach($balita as $data)
                                        <option value="{{ $data->id }}">{{ $data->orangtua->nama_balita }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Proses</button>
                            </form>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-sm-5"></div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-script')
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script>
    $('select').select2({
        theme: 'bootstrap4',
        width: '100%'
    });
</script>
@endpush