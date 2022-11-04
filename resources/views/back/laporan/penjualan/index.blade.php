@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Laporan Penjualan</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="table-container mb-12">
                <div class="table-responsive">
                    <table class="table my-0" id="table">
                        <thead>
                            <tr>
                                <th>No Faktur</th>
                                <th>Item</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Harga</th>
                                <th>Banyak</th>
                                <th>Disc</th>
                                <th>Total</th>
                                <th>Pelanggan</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
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

            <div class="d-flex mb-4">
                <button class="btn btn-custom accent btn-block mr-5" id="filter">
                    <i class="fas fa-eye mr-2"></i> Lihat
                </button>
                <button class="btn btn-custom blue px-3">
                    <i class="fas fa-redo"></i>
                </button>
            </div>

            <div class="form-group mb-12">
                <label for="">Disc. Item</label>
                <input type="text" class="form-control form-control-sm" id="diskonItem" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">Sub Total</label>
                <input type="text" class="form-control form-control-sm" id="subTotal" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">Potongan</label>
                <input type="text" class="form-control form-control-sm" id="potongan" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">PPN</label>
                <input type="text" class="form-control form-control-sm" id="ppn" readonly>
            </div>

            <div class="form-group mb-3">
                <label for="">Total</label>
                <input type="text" class="form-control form-control-sm" id="total" readonly>
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
                <form action="{{ route('back.laporan.penjualan.export') }}" method="GET" target="_blank">
                    <input type="hidden" name="startDate" class="form-control" id="startDateEx">
                    <input type="hidden" name="endDate" class="form-control" id="endDateEx">
                    <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-file-excel mr-2"></i>
                        File Excel
                    </button>
                </form>
                <form id="page-pdf" action="{{ route('back.laporan.penjualan.pdf') }}" method="GET" target="_blank">
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
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/laporan/laporan-penjualan/index.css') }}">
@endpush

@push('js')
<script>
    let start = '';
    let end = '';
    let table;
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
            { "width": '150px', "targets": 7 },
            { "width": '150px', "targets": 8 },
        ],
        "fixedColumns": true,
        "scrollY": "720px",
        "lengthMenu": [10, 25, 50, 100],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        "serverSide": true,
        "searching": false,
        "ajax": {
            "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "url": "{{ route('api.back.laporan.penjualan') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {
                d.startDate = start;
                d.endDate = end;
            }
        },
        "columns": [
            {
                "data": "no_faktur",
                "className": "align-middle"
            },
            {
                "data": "barang",
                "className": "align-middle"
            },
            {
                "data": "kode",
                "className": "align-middle"
            },
            {
                "data": "tanggal",
                "className": "align-middle"
            },
            {
                "data": "harga",
                "className": "align-middle"
            },
            {
                "data": "banyak",
                "className": "align-middle"
            },
            {
                "data": "diskon",
                "className": "align-middle"
            },
            {
                "data": "total",
                "className": "align-middle"
            },
            {
                "data": "pelanggan",
                "className": "align-middle"
            },
        ]
    })

    $('#filter').on('click', function(e){
        e.preventDefault()
        start = $('#start').val()
        end = $('#end').val()
        getTotal("tanggal")

        $('#startDate').val(start)
        $('#endDate').val(end)
        $('#startDateEx').val(start)
        $('#endDateEx').val(end)

        table.clear().draw()
    })

    getTotal()
    function getTotal(tanggal = "hari") {
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('api.back.laporan.penjualan.total') }}",
            dataType: "json",
            type: "POST",
            data: {
                "startDate": start,
                "endDate": end,
                "tanggal": tanggal
            },
            success: function (data) {
                $('#diskonItem').val(data.diskonItem)
                $('#subTotal').val(data.subTotal)
                $('#potongan').val(data.potongan)
                $('#ppn').val(data.ppn)
                $('#total').val(data.total)
            }
        })
    }
</script>
@endpush
