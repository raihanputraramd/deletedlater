@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">Kartu Stok</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-9">
            <div class="table-container mb-12">
                <table class="table my-0" id="table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Masuk</th>
                            <th>Keluar</th>
                            <th>Sisa</th>
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

            <div class="d-flex mb-4">
                <button class="btn btn-custom accent btn-block mr-5" id="filter">
                    <i class="fas fa-eye mr-2"></i> Lihat Data
                </button>
                <button class="btn btn-custom blue px-3">
                    <i class="fas fa-redo"></i>
                </button>
            </div>

            {{-- <div class="form-group mb-12">
                <label for="">Saldo Awal</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Masuk</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Keluar</label>
                <input type="text" class="form-control form-control-sm">
            </div>

            <div class="form-group mb-12">
                <label for="">Stok Sisa</label>
                <input type="text" class="form-control form-control-sm">
            </div> --}}

            <a target="_blank" data-title="Tambah Kartu Stok" class="btn-page text-decoration-none" href="{{ route('back.laporan.kartu-stok.create') }}">
                <button class="btn btn-custom green btn-block ">
                    <i class="fas fa-plus mr-2"></i> Tambah Data
                </button>
            </a>
        </div>

        <div class="col-lg-12 mb-2">
            <hr class="divider">
            <div class="d-flex justify-content-end">
                {{-- <div class="footer-barang-search-container">
                    <div class="form-group footer-barang-input">
                        <input type="text" class="form-control form-control-sm" placeholder="Barang">
                    </div>
                    <div class="form-group mx-3">
                        <input type="text" class="form-control form-control-sm" placeholder="Kode">
                    </div>
                    <button class="btn btn-custom blue px-3 d-block"><i class="fas fa-search mr-2"></i> Barang</button>
                </div> --}}
                <div class="d-flex">
                    <a class="text-decoration-none" href="{{ route('back.home.index') }}">
                        <button class="btn btn-custom red px-3 ml-3">
                            <i class="fas fa-times-circle mr-2"></i>
                            Keluar
                        </button>
                    </a>
                    <form action="{{ route('back.laporan.kartu-stok.export') }}" method="GET" target="_blank">
                        <input type="hidden" name="startDate" class="form-control" id="startDateEx">
                        <input type="hidden" name="endDate" class="form-control" id="endDateEx">
                        <button class="btn btn-custom green px-3 ml-3">
                            <i class="fas fa-file-excel mr-2"></i>
                            File Excel
                        </button>
                    </form>
                    <form id="page-pdf" action="{{ route('back.laporan.kartu-stok.pdf') }}" method="GET" target="_blank">
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
    </div>
</section>

<div class="modal fade" id="modalPage" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalPageLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header p-2">
                <h2 class="header2 color-black font-weight-bold mb-0" id="modal-title"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="modal-body">
                ...
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/laporan/kartu-stok/index.css') }}">
@endpush

@push('js')
<script>
    let start = '';
    let end = '';
    var table;
    table = $('#table').DataTable({
        "initComplete": function(settings, json) {
            $('#table_filter').remove();
        },
        "responsive": false,
        "pagingType": "simple_numbers",
        "paging": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollCollapse": true,
        "columnDefs": [
            { "width": '120px', "targets": 0 },
            { "width": '350px', "targets": 1 },
            { "width": '150px', "targets": 2 },
            { "width": '150px', "targets": 3 },
            { "width": '150px', "targets": 4 },
        ],
        "fixedColumns": true,
        "scrollY": "720px",
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "order": [['4', 'desc']],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        "serverSide": true,
        "ajax": {
            "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "url":  "{{ route('api.back.laporan.kartu-stok') }}",
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
            {
                "data": "sisa",
                "className": "align-middle"
            },
        ]
    });

    $('body').on('click', '.btn-page', function() {
        event.preventDefault()
        let url = $(this).attr('href')
        let title = $(this).data('title')

        $('#modalPage').modal('show')
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success: function(html) {
                $('#modal-title').text(title)
                $('#modal-body').html(html)
            }
        })
    })

    $('body').on('click', '#btn-save', function() {
        $('#form-validation').submit()
    })

    $('#filter').on('click', function(e){
        e.preventDefault()
        start = $('#start').val()
        end = $('#end').val()

        $('#startDate').val(start)
        $('#endDate').val(end)
        $('#startDateEx').val(start)
        $('#endDateEx').val(end)

        table.clear().draw()
    })
</script>
@endpush
