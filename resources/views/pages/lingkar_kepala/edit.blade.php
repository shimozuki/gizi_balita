@extends('layout.app')

@section('title', 'SPKBalita | Tambah Data Lingkar Kepala')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tambah Data Lingkar Kepala</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/lingkar-kepala') }}" method="POST">
                                @csrf
                                <h5 mt-3>Data Lingkar Kepala (cm)</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Umur (bulan)</label>
                                        <input type="number" name="umur" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>-3 SD</label>
                                        <input type="number" step="any" name="min3sd" class="form-control" required>
                                        <label>-2 SD</label>
                                        <input type="number" step="any" name="min2sd" class="form-control" required>
                                        <label>-1 SD</label>
                                        <input type="number" step="any" name="min1sd" class="form-control" required>
                                        <label>Median</label>
                                        <input type="number" step="any" name="median" class="form-control" required>
                                        <label>+1 SD</label>
                                        <input type="number" step="any" name="plus1sd" class="form-control" required>
                                        <label>+2 SD</label>
                                        <input type="number" step="any" name="plus2sd" class="form-control" required>
                                        <label>+3 SD</label>
                                        <input type="number" step="any" name="plus3sd" class="form-control" required>
                                    </div>
                                </div>
                                <br>
                                <a href="/lingkar-kepala" class="btn btn-primary">Kembali</a>
                                <button type="submit" class="btn btn-success btn-fill pull-right">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3"></div>
        </div>
</div>
</section>
</div>
@endsection