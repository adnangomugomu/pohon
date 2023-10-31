@extends('template.backend')

@section('title', $title)
@section('header', $header)

@section('style')
    <style>
        #grafik_laporan {
            width: 100%;
            height: 400px;
        }
    </style>
@endsection

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
                            <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1">{{ $total_laporan }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4 mb-4">
            <div class="col-md-12">
                <div class="card bd-0">
                    <div class="card-header tx-medium bd-0 tx-white bg-indigo">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Grafik Jumlah Laporan</div>
                            <div style="width: 200px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="filter_bulan" class="form-control js_select2" onchange="load_grafik_laporan();">
                                            @foreach ($bulan as $val => $dt)
                                                <option {{ date('m') == $dt ? 'selected' : '' }} value="{{ $dt }}">{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <select id="filter_tahun" class="form-control js_select2" onchange="load_grafik_laporan();">
                                            @foreach ($tahun as $dt)
                                                <option {{ date('Y') == $dt ? 'selected' : '' }} value="{{ $dt }}">{{ $dt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body bd bd-t-0 rounded-bottom">
                        <div id="grafik_laporan"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js" type="text/javascript"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/full-screen.js"></script>

    <script>
        $(document).ready(function() {
            $('.js_select2').select2({
                width: '100%',
            })
            load_grafik_laporan();
        });

        function load_grafik_laporan() {
            var tahun = $('#filter_tahun').val();
            var bulan = $('#filter_bulan').val();
            var nm_bulan = $('#filter_bulan').find(':selected').text();

            $.ajax({
                type: "POST",
                url: "{{ route('admin.grafik_laporan') }}",
                data: {
                    bulan: bulan,
                    tahun: tahun,
                },
                dataType: "JSON",
                success: function(res) {
                    if (res.status == 'success') {

                        Highcharts.chart('grafik_laporan', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                text: nm_bulan + " " + tahun,
                            },
                            xAxis: {
                                categories: res.grafik.kategori
                            },
                            yAxis: {
                                title: {
                                    text: 'Laporan'
                                },
                                labels: {
                                    formatter: function() {
                                        var value = this.value;
                                        var suffix = '';
                                        if (value >= 1000000000) {
                                            value = value / 1000000000;
                                            suffix = 'M';
                                        } else if (value >= 1000000) {
                                            value = value / 1000000;
                                            suffix = 'JT';
                                        } else if (value >= 1000) {
                                            value = value / 1000;
                                            suffix = 'RB';
                                        }
                                        return value + ' ' + suffix;
                                    }
                                }
                            },
                            series: [{
                                name: 'Laporan',
                                data: res.grafik.series,
                                colorByPoint: true,
                                dataLabels: {
                                    enabled: true,
                                    inside: true,
                                    formatter: function() {
                                        return Highcharts.numberFormat(this.y, 0, ',', '.');
                                    }
                                }
                            }]
                        });

                    }
                }
            });
        }
    </script>
@endsection
