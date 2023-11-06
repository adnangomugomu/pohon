@extends('template.front')
@section('title', $title)

@section('style1', 'style1')

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
    </style>
@endsection

@section('slider')
    <section id="main-banner-area" class="position-relative section-nav-smooth">
        <div id="revo_main_wrapper" class="rev_slider_wrapper fullwidthbanner-container m-0 p-0 bg-dark" data-alias="classic4export" data-source="gallery">
            <!-- START REVOLUTION SLIDER 5.4.1 fullwidth mode -->
            <div id="vertical-bullets" class="rev_slider fullwidthabanner white vertical-tpb" data-version="5.4.1">
                <ul>
                    <!-- SLIDE 1 -->
                    <li data-index="rs-01" data-transition="fade" data-slotamount="default" data-easein="Power100.easeIn" data-easeout="Power100.easeOut" data-masterspeed="2000" data-fsmasterspeed="1500" data-param1="01">
                        <!-- MAIN IMAGE -->
                        <div class="overlay overlay-blue opacity-10"></div>
                        <img src="{{ asset('img/front-bg1.jpeg') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-35','-35']" data-width="none" data-height="none" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="1000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h2 class="text-capitalize font-xlight whitecolor heading-title-small">PEMERINTAH KABUPATEN BOYOLALI</h2>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['20','20','20','20']" data-width="none" data-height="none" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="1000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight defaultcolor">DINAS LINGKUNGAN HIDUP</h1>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['95','95','90','90']" data-width="none" data-height="none" data-type="text" data-textAlign="['left','center','center','center']" data-responsive_offset="on" data-start="1500" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <p class="text-capitalize font-xlight whitecolor">Aplikasi Pendataan Pohon oleh Dinas Lingkungan Hidup adalah
                                <br>sebuah solusi perangkat lunak yang dirancang untuk membantu dinas lingkungan hidup di suatu daerah atau wilayah
                                <br>dalam mengelola informasi dan data terkait dengan pepohonan. Aplikasi ini bertujuan untuk meningkatkan pemantauan,
                                <br>pelestarian, dan pengelolaan pohon serta area hijau di lingkungan kota dengan lebih efektif dan efisien.
                            </p>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['170','170','160','170']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="2000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <button onclick="location.href='{{ route('front.pohon') }}'" class="btn button btn-white transition-3">Data Pohon</button>
                        </div>
                    </li>
                    <!-- SLIDE 2 -->
                    <li data-index="rs-03" data-transition="fade" data-slotamount="default" data-easein="Power100.easeIn" data-easeout="Power100.easeOut" data-masterspeed="2000" data-fsmasterspeed="1500" data-param1="03">
                        <!-- MAIN IMAGE -->
                        <div class="overlay overlay-blue opacity-10"></div>
                        <img src="{{ asset('img/front-bg2.jpeg') }}" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                        <!-- LAYER NR. 1 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-40','-40','-30','-30']" data-width="none" data-height="none" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="1000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h2 class="text-capitalize font-xlight whitecolor heading-title-small">Selamatkan Bumi Hjaukan Hutan</h2>
                        </div>
                        <!-- LAYER NR. 2 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['20','20','30','30']" data-width="none" data-height="none" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="1000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <h1 class="text-capitalize font-xlight defaultcolor">Bersama Kita Perbaiki Alam</h1>
                        </div>
                        <!-- LAYER NR. 3 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['95','95','90','90']" data-width="none" data-height="none" data-type="text" data-textAlign="['left','left','center','center']" data-responsive_offset="on" data-start="1500" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":2000,"to":"o:1;","delay":1500,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <p class="text-capitalize font-xlight whitecolor">Aplikasi ini dapat membuka kemungkinan kolaborasi dengan masyarakat setempat.
                                <br>Masyarakat dapat memberikan masukan dan melaporkan pohon
                                <br>yang memerlukan perawatan atau perlindungan.
                            </p>
                        </div>
                        <!-- LAYER NR. 4 -->
                        <div class="tp-caption tp-resizeme" data-x="['left','left','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['170','170','140','140']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-textAlign="['center','center','center','center']" data-responsive_offset="on" data-start="2000" data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":2000,"ease":"Power4.easeInOut"},{"delay":"wait","speed":1000,"to":"y:[100%];","mask":"x:inherit;y:inherit;s:inherit;e:inherit;","ease":"Power2.easeInOut"}]'>
                            <button onclick="location.href='{{ route('front.aduan') }}'" class="btn button btn-white transition-3">Aduan</button>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>
@endsection

@section('konten')
    <section id="our-blog" class="bglight padding_top padding_bottom_half">
        <div class="container">
            <h3 class="darkcolor bottom20">Data Pohon Terbaru</h3>
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
                    <a class="button btn-yellow" href="{{ route('front.pohon') }}">Selengkapnya</a>
                </div>
            </div>
        </div>
    </section>
@endsection
