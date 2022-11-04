@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">List Modul</h1>
</header>

<section class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-container mb-12">
                <table class="table my-0" id="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nama Modul</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <hr class="divider">
            <div class="d-flex justify-content-between">
                <div class="input-group form-group mr-5 search-button-input">
                    <input type="text" class="form-control form-control-sm border-right-0" placeholder="Cari Modul" id="external_filter">
                    <div class="input-group-append">
                        <button class="btn btn-custom search-button px-3" type="button" id="button-addon2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <button id="btn-refresh" class="btn btn-custom blue px-3 ml-3">
                        <i class="fas fa-redo mr-2"></i>
                        Refresh
                    </button>
                    <a class="text-decoration-none" href="{{ route('back.home.index') }}">
                        <button class="btn btn-custom red px-3 ml-3">
                            <i class="fas fa-times-circle mr-2"></i>
                            Keluar
                        </button>
                    </a>
                    {{-- <button class="btn btn-custom red px-3 ml-3">
                        <i class="fas fa-eraser mr-2"></i>
                        Hapus Baris
                    </button> --}}
                    {{-- <button class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-file-excel mr-2"></i>
                        File Excel
                    </button>
                    <button data-toggle="modal" data-target="#modalPage" class="btn btn-custom green px-3 ml-3">
                        <i class="fas fa-print mr-2"></i>
                        Print
                    </button> --}}
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
                ..
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/system/modul/index.css') }}">
@endpush

@push('js')
<script>
    var table;
    table = $('#table').DataTable({
        "initComplete": function(settings, json) {
            $('#table_filter').remove();
        },
        "responsive": true,
        "pagingType": "simple_numbers",
        "paging": false,
        "autoWidth": false,
        "scrollX": true,
        "scrollCollapse": true,
        "columnDefs": [
            { "width": '50px', "targets": 0 },
            { "width": '200px', "targets": 1 },
            { "width": '60%', "targets": 2 },
        ],
        "fixedColumns": true,
        "scrollY": "400px",
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "order": [['2', 'desc']],
        "processing": true,
        "bInfo" : false,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        "serverSide": true,
        "searching": true,
        "ajax": {
            "headers": {'X-CSRF-TOKEN': '{{ csrf_token()}}'},
            "url": "{{ route('api.back.system.modul') }}",
            "dataType": "json",
            "type": "POST"
        },
        "columns": [
            {
                "data": "id",
                "className": "align-middle"
            },
            {
                "data": "nama",
                "className": "align-middle"
            },
            {
                "data": "keterangan",
                "className": "align-middle"
            },
            {
                "data": "actions",
                "className": "align-middle"
            },
        ]
    });

    $('#external_filter').off().keyup(function () {
        table.search(this.value).draw();
    })

    $('body').on('click', '.btn-page', function () {
        event.preventDefault()
        let url = $(this).attr('href')
        let title = $(this).data('title')

        $('#modalPage').modal('show')
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            success:  function (html) {
                $('#modal-title').text(title)
                $('#modal-body').html(html)
            }
        })
    })

    $('body').on('click', '#btn-save', function() {
        $('#form-validation').submit()
    })

    $('body').on('click', '#btn-refresh', function () {
        $('#table').DataTable().ajax.reload();
    })
</script>
@endpush
