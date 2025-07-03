@extends('layout.app')

@section('title', 'Manajemen Kader')

@section('content')
<div class="container">
    <h4>Daftar Kader Posyandu</h4>
    <a href="{{ route('kader.create') }}" class="btn btn-primary mb-3">+ Tambah Kader</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Posyandu</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kaders as $kader)
            <tr>
                <td>{{ $kader->name }}</td>
                <td>{{ $kader->email }}</td>
                <td>{{ $kader->posyandu }}</td>
                <td>
                    <a href="{{ route('kader.edit', $kader->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kader.destroy', $kader->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus kader ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection