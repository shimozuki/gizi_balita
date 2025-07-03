@extends('layout.app')

@section('title', 'Edit Kader')

@section('content')
<div class="container">
    <h4>Edit Data Kader</h4>
    <form action="{{ route('kader.update', $kader->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" value="{{ $kader->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ $kader->email }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Posyandu</label>
            <select name="posyandu" class="form-control" required>
                <option value="">-- Pilih Posyandu --</option>
                <option value="Pada idi" {{ $kader->posyandu == 'Pada idi' ? 'selected' : '' }}>Pada idi</option>
                <option value="Padaelo" {{ $kader->posyandu == 'Padaelo' ? 'selected' : '' }}>Padaelo</option>
                <option value="Melati" {{ $kader->posyandu == 'Melati' ? 'selected' : '' }}>Melati</option>
                <option value="Mawar" {{ $kader->posyandu == 'Mawar' ? 'selected' : '' }}>Mawar</option>
                <option value="Air Payau" {{ $kader->posyandu == 'Air Payau' ? 'selected' : '' }}>Air Payau</option>
            </select>
        </div>
        <button class="btn btn-success">Update</button>
        <a href="{{ route('kader.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection