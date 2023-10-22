@extends('template.backend')

@section('title', $title)
@section('header', $header)

@section('konten')
    <div class="br-pagebody">
        <div class="row">
            <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
                <div class="bg-teal rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-people tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total User</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{ $total_user }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
                <div class="bg-primary rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-android-cloud-done tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Data Pohon</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{ $total_pohon }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4 mg-t-20 mg-xl-t-0">
                <div class="bg-info rounded overflow-hidden">
                    <div class="pd-25 d-flex align-items-center">
                        <i class="ion ion-ios-paper-outline tx-60 lh-0 tx-white op-7"></i>
                        <div class="mg-l-20">
                            <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Laporan</p>
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">100</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="br-section-wrapper">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusamus rerum necessitatibus illum fuga aspernatur excepturi tempore minus saepe amet odit, dolore omnis alias dignissimos assumenda ut dicta quaerat, aliquam dolorum!
        </div> --}}
    </div>
@endsection
