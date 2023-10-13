@extends('layouts.home')

@section('content')
    <header class="header-2">
        <div class="page-header min-vh-75 relative" style="background-image: url('{{ asset('Assets/img/bg2.jpg') }}')">
            <span class="mask bg-gradient-primary opacity-4"></span>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 text-center mx-auto">
                        <h1 class="text-white pt-3 mt-n5">Selamat Datang.</h1>
                        <p class="lead text-white mt-3">Pneumonia Infeksi yang menimbulkan peradangan pada kantung udara
                            di salah
                            satu atau kedua paru-paru. <br />
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="card card-body blur shadow-blur mx-3 mx-md-4 mt-n6">

        <section class="pt-3 pb-4" id="count-stats">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 mx-auto py-3">
                        <div class="row">
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"><span id="state1" countTo="450">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Jumlah Yang Terjangkit</h5>
                                    <p class="text-sm font-weight-normal">Angka kejadian pneumonia lebih sering terjadi
                                        di negara berkembang.</p>
                                </div>
                                <hr class="vertical dark">
                            </div>
                            <div class="col-md-6 position-relative">
                                <div class="p-3 text-center">
                                    <h1 class="text-gradient text-primary"> <span id="state2" countTo="250">0</span>+
                                    </h1>
                                    <h5 class="mt-3">Konsultasi</h5>
                                    <p class="text-sm font-weight-normal">Jumlah Konsultasi Menggunakan Applikasi</p>
                                </div>
                                <hr class="vertical dark">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-sm-7" id="download-soft-ui">
            <div class="bg-gradient-dark position-relative m-3 border-radius-xl overflow-hidden">
                <img src="{{ asset('Assets/img/shapes/waves-white.svg') }}" alt="pattern-lines"
                    class="position-absolute start-0 top-md-0 w-100 opacity-2">
                <div class="container py-7 postion-relative z-index-2 position-relative">
                    <div class="row">
                        <div class="col-md-7 mx-auto text-center">
                            <h3 class="text-white mb-0">Apakah anda menyukai ini</h3>
                            <h3 class="text-white">Deteksi Pneumonia</h3>
                            <p class="text-white mb-5">Apakah Anda akan melanjutkan berkonsultasi untuk mengetahui anda
                                terjangkit Pneumonia</p>
                            <a href="{{ route('basiskasus.konsultasi') }}"
                                class="btn btn-primary btn-lg mb-3 mb-sm-0">Konsultasi</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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
