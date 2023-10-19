@extends('layouts.home')

@section('content')
    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('{{ asset('Assets/img/bg2.jpg') }}')">
            <span class="mask bg-gradient-primary opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-n5">Konsultasi Online</h1>
                        <p class="lead text-white mt-3">Silahkan dapat Mengisi Data Berikut. <br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">


        <form action="{{ route('similarity') }}" method="POST">
            @csrf
            <label>Pilih Basis Kasus:</label><br>
            <div class="form-check">
                @foreach ($dataGejala as $kasus)
                    <input type="checkbox" class="form-check-input" name="selected_gejala[]" id="flexCheckDefault"
                        value="{{ $kasus->id }}">
                    {{ $kasus->nama_gejala }}<br>
                @endforeach
                <div class="col-lg-4 mt-2">
                    <div class="input-group input-group-static mb-4">
                        <label>Deteksi</label>
                        <input class="form-control" placeholder="Pneumonia" name="deteksi" type="text">
                    </div>
                </div>
                <button type="submit" class="btn bg-gradient-primary btn-icon btn-sm mt-1">Proses Pilihan</button>
            </div>
        </form>


    </div>



    <!-- -------   START PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 ms-auto">
                    <h4 class="mb-1">Thank you for your support!</h4>
                    <p class="lead mb-0">We provide pneumonia consultation services</p>
                </div>
                <div class="col-lg-5 me-lg-auto my-lg-auto text-lg-end mt-5">
                    <a href="Javascript:void(0)" class="btn btn-twitter mb-0 me-2" target="_blank">
                        <i class="fab fa-twitter me-1"></i> Tweet
                    </a>
                    <a href="Javascript:void(0)" class="btn btn-facebook mb-0 me-2" target="_blank">
                        <i class="fab fa-facebook-square me-1"></i> Share
                    </a>
                    <a href="Javascript:void(0)" class="btn btn-pinterest mb-0 me-2" target="_blank">
                        <i class="fab fa-pinterest me-1"></i> Pin it
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- -------   END PRE-FOOTER 2 - simple social line w/ title & 3 buttons    -------- -->

    </div>
@endsection
