@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Laporan Saldo Tunai</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="table-container mb-12">
                <table class="table my-0" id="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan Transaksi</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="form-group mb-12">
                <label for="">Mulai Tanggal</label>
                <input name="startDate" type="date" class="form-control form-control-sm" id="start" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            <div class="form-group mb-12">
                <label for="">Sampai Dengan Tanggal</label>
                <input name="endDate" type="date" class="form-control form-control-sm" id="end" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
            </div>

            {{-- <div class="form-group mb-12">
                <label for="">Petugas</label>
                <input type="text" class="form-control form-control-sm">
            </div> --}}

            <div class="d-flex mb-5">
                <button class="btn btn-custom accent btn-block mr-5" id="filter">
                    <i class="fas fa-eye mr-2"></i> Lihat Data
                </button>
                <button class="btn btn-custom blue px-3">
                    <i class="fas fa-redo"></i>
                </button>
            </div>

            <div class="form-group mb-12">
                <label for="">Saldo Awal</label>
                <input type="text" class="form-control form-control-sm" id="saldoAwal" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">Masuk</label>
                <input type="text" class="form-control form-control-sm" id="masuk" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">Keluar</label>
                <input type="text" class="form-control form-control-sm" id="keluar" readonly>
            </div>

            <div class="form-group mb-12">
                <label for="">Saldo Akhir</label>
                <input type="text" class="form-control form-control-sm" id="saldoAkhir" readonly>
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
                <form id="export-excel" target="_blank" action="{{ route('back.laporan.laporan-saldo-tunai.export') }}">
                    <input type="hidden" name="startDate" class="form-control" id="startDate">
                    <input type="hidden" name="endDate" class="form-control" id="endDate">
                    <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-file-excel mr-2"></i>
                        File Excel
                    </button>
                </form>
                <form id="page-pdf" action="{{ route('back.laporan.laporan-saldo-tunai.pdf') }}" method="GET" target="_blank">
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
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/laporan/laporan-saldo-tunai/index.css') }}">
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
        "autoWidth": false,
        "scrollX": true,
        "scrollCollapse": true,
        "columnDefs": [
            { "width": '15%', "targets": 0 },
            { "width": '20%', "targets": 2 },
            { "width": '20%', "targets": 3 },
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
            "url": "{{ route('api.back.laporan.saldo-tunai') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(d) {
                d.startDate = start;
                d.endDate = end;
            }
        },
        "columns": [
            {
                "data": "tanggal",
                "className": "align-middle"
            },
            {
                "data": "keterangan",
                "className": "align-middle"
            },
            {
                "data": "masuk",
                "className": "align-middle"
            },
            {
                "data": "keluar",
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

        table.clear().draw()
    })

    getTotal()
    function getTotal(tanggal = "hari") {
        $.ajax({
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            url: "{{ route('api.back.laporan.saldo-tunai.total') }}",
            dataType: "json",
            type: "POST",
            data: {
                "startDate": start,
                "endDate": end,
                "tanggal": tanggal
            },
            success: function (data) {
                $('#saldoAwal').val(data.saldoAwal)
                $('#masuk').val(data.masuk)
                $('#keluar').val(data.keluar)
                $('#saldoAkhir').val(data.saldoAkhir)
            }
        })
    }
</script>
@endpush
