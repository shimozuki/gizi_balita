@extends('layout.app-cetak')

@section('title', 'SPKBalita | Rekapan Status Gizi Balita')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid"></div>
    </div>
    <section class="content">
        <div class="container-fluid">

            {{-- TAB NAVIGATION --}}
            <ul class="nav nav-tabs" id="posyanduTab" role="tablist">
                @foreach ($listPosyandu as $index => $nama)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $index }}"
                        data-toggle="tab" href="#content-{{ $index }}" role="tab">
                        {{ $nama }}
                    </a>
                </li>
                @endforeach
            </ul>

            {{-- TAB CONTENT --}}
            <div class="tab-content pt-3" id="posyanduTabContent">
                @foreach ($listPosyandu as $index => $nama)
                @php $data = $rekapanPerPosyandu[$nama]; @endphp
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content-{{ $index }}" role="tabpanel">
                    @if ($data)
                    <div class="card card-primary mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Rekapan Status Gizi Balita - Posyandu {{ $nama }}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Nama Balita</th>
                                        <th class="text-center">Umur</th>
                                        <th>Nama Ayah</th>
                                        <th class="text-center">Status Gizi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data['balitas'] as $balita)
                                    @php
                                    $namaBalita = $balita->orangtua->nama_balita;
                                    $nilai = $data['nilaiV'][$namaBalita];
                                    @endphp
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $namaBalita }}</td>
                                        <td class="text-center">{{ $balita->umur }}</td>
                                        <td>{{ $balita->orangtua->user->name }}</td>
                                        <td class="text-center">
                                            @if ($nilai <= 0.25)
                                                Gizi Buruk
                                                @elseif ($nilai <=0.74)
                                                Gizi Kurang
                                                @else
                                                Gizi Baik
                                                @endif
                                                </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @else
                    <p class="text-center text-muted">Tidak ada data untuk posyandu {{ $nama }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('addon-style')
<!-- Bootstrap 4 CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
@endpush

@push('addon-script')
<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Otomatis print
    setTimeout(() => window.print(), 3000);
</script>
@endpush