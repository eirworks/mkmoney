@extends('layouts.frontend')

@section('title')
    Selamat datang di {{ config('app.name') }}
@endsection

@section('content')
    <header class="bg-primary text-white pb-5">
        <div class="text-center h1 pt-5 pb-5">Solusi Keuangan untuk UMKM</div>
        <div class="text-center h4 fw-light">
            Kelola keuangan bisnis anda dengan mudah, dimanapun, kapanpun.
        </div>
    </header>
    <div class="container">
        @guest
        <div class="text-center my-5">
            <a href="{{ route('auth::register') }}" class="btn btn-outline-primary btn-lg">Mulai Sekarang</a>
        </div>
        <div class="text-center">
            <a href="{{ route('auth::login') }}">Sudah punya akun?</a>
        </div>
        @else
            <div class="text-center my-5">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg">Ke Dasbor</a>
            </div>
        @endguest

        <hr class="my-5 bg-light">

{{--        <div class="row justify-content-center mt-5">--}}
{{--            <div class="col-md-6">--}}
{{--                <div class="h2 text-center">Pemilik Bisnis Suka dengan {{ config('app.name') }}</div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row justify-content-center my-3">--}}
{{--            <div class="col-md-4">--}}
{{--                <div class="card my-3">--}}
{{--                    <div class="card-body">--}}
{{--                        Saya suka dengan {{ config('app.name') }} karena--}}
{{--                        sangat mudah digunakan.--}}
{{--                        <div class="mt-3 fw-bold">Sherina T. &mdash; Sunset Cafe, Bali</div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card my-3">--}}
{{--                    <div class="card-body">--}}
{{--                        Saya bisa mengecek kondisi keuangan toko saya tanpa perlu datang--}}
{{--                        ke toko.--}}
{{--                        <div class="mt-3 fw-bold">Billy W. &mdash; Toko Bintang Lima, Surabaya</div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-2 align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
                            <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0zM1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5zM4 15h3v-5H4v5zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3zm3 0h-2v3h2v-3z"/>
                        </svg>
                    </div>
                    <div class="col-9">
                        <div class="h3">Kelola Bisnis</div>
                        <div>
                            Kelola semua bisnis anda, baik itu toko, kafe, restoran. Besar atau kecil
                            tidak ada masalah.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-2 align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                            <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                            <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>
                    </div>
                    <div class="col-9">
                        <div class="h3">Dimanapun, Kapanpun</div>
                        <div>
                            Anda bisa mengelola bisnis anda dimanapun, baik melalui PC, handphone, atau tablet,
                            selama masih terhubung dengan internet.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-3">
                <div class="row">
                    <div class="col-2 align-middle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                    </div>
                    <div class="col-9">
                        <div class="h3">Lihat Bisnis Anda Berkembang</div>
                        <div>
                            Lihat perkembangan bisnis anda melalui laporan dan grafik statistik.
                            Lihat pengeluaran dan pemasukan terbesar, dan ambil kebijakan bisnis
                            yang sesuai.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

