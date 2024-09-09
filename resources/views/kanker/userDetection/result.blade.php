@extends('layouts.home')

@section('content')
<div class="container mt-5">
    <h1>Hasil Deteksi Kanker</h1>
    <p>Total Bobot Deteksi: <strong>{{ $totalWeight }}</strong></p>

    @if ($totalWeight > 10)
    <p>Hasil deteksi menunjukkan potensi gejala serius. Kami sarankan untuk berkonsultasi dengan dokter.</p>
    @else
    <p>Hasil deteksi menunjukkan risiko rendah. Tetap jaga kesehatan Anda dan lakukan pengecekan rutin.</p>
    @endif

    <a href="{{ route('user.detection.start') }}" class="btn btn-primary">Mulai Deteksi Ulang</a>
</div>
@endsection