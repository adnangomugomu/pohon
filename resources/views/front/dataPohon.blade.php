@extends('template.front')
@section('title', $title)

@section('style2', 'style2')

@section('style')
    <style>
        .img_cover {
            width: 100%;
            height: 260px !important;
            object-fit: cover !important;
        }

        .min_350 {
            min-height: 350px !important;
        }

        .blog-header {
            background-image: url("{{ asset('img/front-bg3.jpeg') }}");
        }

        .pagination {
            justify-content: center !important;
        }
    </style>
@endsection

@section('header')
    <section id="main-banner-page" class="position-relative page-header blog-header parallax section-nav-smooth">
        <div class="overlay overlay-dark opacity-6 z-index-1"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="page-titles whitecolor text-center padding_top padding_bottom">
                        <h2 class="font-bold">Data Pohon</h2>
                        <h4 class="font-light pt-2">Data pohon dan informasi terkait dapat diintegrasikan dengan sistem pemetaan
                            geografis (GIS) untuk memvisualisasikan lokasi pohon secara interaktif pada peta. Ini membantu petugas dalam pemantauan
                            dan perencanaan yang lebih efektif</h4>
                    </div>
                </div>
            </div>
            <div class="bg-blue title-wrap">
                <div class="row">
                    <div class="col-lg-12 col-md-12 whitecolor">
                        <h3 class="float-left">Terbaru</h3>
                        <ul class="breadcrumb top10 bottom10 float-right">
                            <li class="breadcrumb-item hover-light"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item hover-light">Pohon</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('konten')
    <section id="our-blog" class="bglight padding_top padding_bottom_half">
        <div class="container">
            <div id="blog-measonry" class="cbp">
                @foreach ($pohon as $item)
                    <div class="cbp-item">
                        <div class="news_item shadow text-center text-md-left">
                            <a class="image" href="{{ route('front.pohon.detail', $item->id) }}">
                                <img src="{{ asset(!empty($item->foto->first()->foto) ? $item->foto->first()->foto : 'img/img-404.png') }}" alt="{{ $item->nama_indo }}" class="img-responsive img_cover">
                            </a>
                            <div class="news_desc news_desc_bg_blue min_350">
                                <h3 class="text-capitalize font-normal darkcolor"><a href="{{ route('front.pohon.detail', $item->id) }}">{{ Str::limit($item->nama_indo, 20, '...') }}</a></h3>
                                <ul class="meta-tags top20 bottom20">
                                    <li><a href="{{ route('front.pohon.detail', $item->id) }}"><i class="fas fa-calendar-alt"></i>{{ date('d F Y', strtotime($item->created_at)) }}</a></li>
                                </ul>
                                <p class="bottom35">{{ Str::limit($item->detail, 100, '...') }}</p>
                                <a href="{{ route('front.pohon.detail', $item->id) }}" class="button btn-yellow">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="row mt-4">
                <div class="col-sm-12 text-center">
                    {{ $pohon->onEachSide(0)->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
