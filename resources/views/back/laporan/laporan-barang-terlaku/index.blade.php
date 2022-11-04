@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Laporan Barang Terlaku</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="table-container mb-12">
                <table class="table my-0" id="table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Item</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>Banyak</th>
                            <th>Diskon</th>
                            <th>Laba Rugi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3">
            <img class="footer-image-preview mb-12" src="{{ asset('back_assets/img/public/item-placeholder.jpg') }}" alt="" height="200" width="342">

            <div class="form-group mb-12">
                <label for="">Mulai Tanggal</label>
                <input type="date" class="form-control form-control-sm" id="start" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="form-group mb-12">
                <label for="">Sampai Dengan Tanggal</label>
                <input type="date" class="form-control form-control-sm" id="end" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            {{-- <div class="form-group mb-12">
                <label for="">Petugas</label>
                <input type="text" class="form-control form-control-sm">
            </div> --}}

            <div class="d-flex mb-5">
                <button class="btn btn-custom accent btn-block mr-5" id="filter">
                    <i class="fas fa-eye mr-2"></i> Lihat
                </button>
                <button class="btn btn-custom blue px-3">
                    <i class="fas fa-redo"></i>
                </button>
            </div>

            <div class="form-group mb-3">
                <label for="">Laba Rugi</label>
                <input type="text" class="form-control form-control-sm">
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <hr class="divider">
            <div class="d-flex justify-content-end">
                <a class="text-decoration-none" href="{{ route('back.home.index') }}">
                    <button class="btn btn-custom red px-3 ml-3">
                        <i class="fas fa-times-circle mr-2"></i>
                        Keluar
                    </button>
                </a>
                <form id="export-excel" target="_blank" action="{{ route('back.laporan.laporan-barang-terlaku.export') }}">
                    <input type="hidden" name="startDate" class="form-control" id="startDate">
                    <input type="hidden" name="endDate" class="form-control" id="endDate">
                    <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-file-excel mr-2"></i>
                        File Excel
                    </button>
                </form>
                <form id="page-pdf" action="{{ route('back.laporan.laporan-barang-terlaku.pdf') }}" method="GET" target="_blank">
                    <input type="hidden" name="startDate" class="form-control" id="startDate">
                    <input type="hidden" name="endDate" class="form-control" id="endDate">
                    <button type="submit" class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-print mr-2"></i>
                        Print
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/laporan/laporan-barang-terlaku/index.css') }}">
@endpush

@push('js')
<script>
    let start = '';
    let end = '';
    var table;
    table = $('#table').DataTable({
        "responsive": false,
        "pagingType": "simple_numbers",
        "paging": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollCollapse": true,
        "columnDefs": [
            { "width": '150px', "targets": 0 },
            { "width": '250px', "targets": 1 },
            { "width": '150px', "targets": 2 },
            { "width": '150px', "targets": 3 },
            { "width": '150px', "targets": 4 },
            { "width": '150px', "targets": 5 },
            { "width": '150px', "targets": 6 },
        ],
        "fixedColumns": true,
        "scrollY": "485px",
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "order": [['4', 'desc']],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        "serverSide": true,
        "searching": false,
        "ajax": {
            "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "url": "{{ route('api.back.laporan.laporan-barang-terlaku') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {
                d.startDate = start;
                d.endDate = end;
            }
        },
        "columns": [
            {
                "data": "kode",
                "className": "align-middle"
            },
            {
                "data": "nama",
                "className": "align-middle"
            },
            {
                "data": "harga_beli",
                "className": "align-middle"
            },
            {
                "data": "harga_jual",
                "className": "align-middle"
            },
            {
                "data": "total",
                "className": "align-middle"
            },
            {
                "data": "totalDiskon",
                "className": "align-middle"
            },
            {
                "data": "labaRugi",
                "className": "align-middle"
            },
        ]
    });

    $('#filter').on('click', function(e){
        e.preventDefault()
        start = $('#start').val()
        end = $('#end').val()

        $('#startDate').val(start)
        $('#endDate').val(end)

        table.clear().draw()
    })
</script>
@endpush
