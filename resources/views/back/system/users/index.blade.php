@extends('layouts.pos.app')

@section('content')
<header class="container-fluid pt-3">
    <h1 class="color-primary header1 mb-3 font-weight-700">List User</h1>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="table-container mb-12">
                <div class="table-responsive">
                    <table class="table my-0" id="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>NIP</th>
                                <th>Gender</th>
                                <th>Jabatan</th>
                                <th>Grup</th>
                                <th>No. Hp</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mb-2">
            <hr class="divider">
            <div class="d-flex justify-content-between">
                <div class="input-group form-group mr-5 search-button-input">
                    <input type="text" class="form-control form-control-sm border-right-0" placeholder="Cari Grup" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-custom search-button px-3" type="button" id="button-addon2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div>
                    <button class="btn btn-custom blue px-3 ml-3">
                        <i class="fas fa-redo mr-2"></i>
                        Refresh
                    </button>
                    <button class="btn btn-custom red px-3 ml-3">
                        <i class="fas fa-times-circle mr-2"></i>
                        Keluar
                    </button>
                    {{-- <button class="btn btn-custom red px-3 ml-3">
                        <i class="fas fa-eraser mr-2"></i>
                        Hapus Baris
                    </button> --}}
                    <a id="export-excel" class="text-decoration-none" target="_blank" href="{{ route('back.system.users.export') }}">
                        <button class="btn btn-custom green px-3 ml-3">
                            <i class="fas fa-file-excel mr-2"></i>
                            File Excel
                        </button>
                    </a>
                    <a target="_blank" class="text-decoration-none" href="{{ route('back.system.users.pdf') }}">
                        <button class="btn btn-custom green px-3 ml-3">
                            <i class="fas fa-print mr-2"></i>
                            Print
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal --}}
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
<link rel="stylesheet" href="{{ asset('back_assets/dist/css/pages/system/users/index.css') }}">
@endpush

@push('js')
<script src="{{ asset('back_assets/dist/js/script.js') }}"></script>
<script>
    var table;
    table = $('#table').DataTable({
        "initComplete": function(settings, json) {
            $('#table_filter').remove();
            $('#table_length').remove();
            $('#table_paginate').remove();
        },
        "responsive": false,
        "pagingType": "simple_numbers",
        "autoWidth": true,
        "scrollX": true,
        "scrollCollapse": true,
        "bInfo": false,
        "columnDefs": [
            { "width": '50px', "targets": 0 },
            { "width": '200px', "targets": 1 },
            { "width": '200px', "targets": 2 },
            { "width": '200px', "targets": 3 },
            { "width": '200px', "targets": 4 },
            { "width": '200px', "targets": 5 },
            { "width": '200px', "targets": 6 },
            { "width": '200px', "targets": 7 },
            { "width": '200px', "targets": 8 },
            { "width": '200px', "targets": 9 },
            { "width": '200px', "targets": 10 },
            { "width": '200px', "targets": 11 },
        ],
        "fixedColumns": true,
        'pageLength': 10,
        "lengthMenu": [10, 25, 50, 100],
        "processing": true,
        "language": {
            "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>'
        },
        "serverSide": true,
        "searching": true,
        "ajax": {
            "headers": {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            "url": "{{ route('api.back.system.users') }}",
            "dataType": "json",
            "type": "POST"
        },
        "columns": [
            {
                "data": "no",
                "className": "text-center align-middle"
            },
            {
                "data": "username",
                "className": "align-middle"
            },
            {
                "data": "nama",
                "className": "align-middle"
            },
            {
                "data": "status",
                "className": "align-middle"
            },
            {
                "data": "gender",
                "className": "align-middle"
            },
            {
                "data": "no_induk",
                "className": "align-middle"
            },
            {
                "data": "jabatan",
                "className": "align-middle"
            },
            {
                "data": "grup",
                "className": "align-middle"
            },
            {
                "data": "no_hp",
                "className": "align-middle"
            },
            {
                "data": "no_telepon",
                "className": "align-middle"
            },
            {
                "data": "alamat",
                "className": "align-middle"
            },
            {
                "data": "actions",
                "orderable": false,
                "className": "text-center align-middle"
            }
        ]
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
            success: function (html) {
                $('#modal-title').text(title)
                $('#modal-body').html(html)
            }
        })
    })

    $('body').on('click', '#btn-save', function () {
        $('#form-validation').submit()
    })
</script>
@endpush
