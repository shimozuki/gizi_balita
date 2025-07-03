@extends('layout.app')

@section('title', 'Tambah Kader')

@section('content')
<div class="container">
    <h4>Tambah Data Kader</h4>
    <form action="{{ route('kader.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Posyandu</label>
            <select name="posyandu" class="form-control" required>
                <option value="">-- Pilih Posyandu --</option>
                <option value="Pada idi">Pada idi</option>
                <option value="Padaelo">Padaelo</option>
                <option value="Melati">Melati</option>
                <option value="Mawar">Mawar</option>
                <option value="Air Payau">Air Payau</option>
            </select>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kader.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection