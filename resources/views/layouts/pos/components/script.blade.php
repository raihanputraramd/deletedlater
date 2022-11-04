{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- End Jquery --}}

{{-- Bootstrap 4 --}}
<script src="{{ asset('/back_assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
{{-- End Bootstrap 4 --}}


{{-- Sweetalert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
{{-- End Sweetalert --}}

{{-- Data Tables --}}
<script src="{{ asset('/back_assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/back_assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/back_assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/back_assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
{{-- End Data tables --}}

{{-- Select 2 --}}
<script src="{{ asset('/back_assets/plugins/select2/js/select2.full.min.js') }}"></script>
{{-- End Select 2 --}}

{{-- BS custom file input --}}
<script src="{{ asset('/back_assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
{{-- End BS custom file input --}}

{{-- Daterangepicker --}}
<script src="{{ asset('/back_assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/back_assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
{{-- End Daterangepicker --}}

{{-- Validation --}}
<script src="{{ asset('back_assets/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('back_assets/plugins/jquery-validation/additional-methods.min.js') }}"></script>
{{-- End Validation --}}

{{-- Admin LTE --}}
<script src="{{ asset('back_assets/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('back_assets/dist/js/script.js') }}"></script>
{{-- End Admin LTE --}}

{{-- Custom js --}}
<script src="{{ asset('back_assets/dist/js/common/scripts.js') }}"></script>
{{-- End Custom js --}}

<script>
  $(function() {
    $('.select2').select2({
      placeholder: $(this).data('placeholder') !== null ? $(this).data('placeholder') : '',
    });
    $('.select2-input').select2({
      tags: true,
    });
    $('.select2-multiple').select2({
      placeholder: $(this).data('placeholder'),
    });
    $('.select2-multiple-input').select2({
      placeholder: $(this).data('placeholder'),
      tags: true,
    });
    $('.data-tables').DataTable();
      bsCustomFileInput.init();
  });

  @if(session('success'))
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'success',
      title: '{{ session('success') }}'
    })
  @endif

  @if(session('error'))
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
      onOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })

    Toast.fire({
      icon: 'error',
      title: '{{ session('error') }}'
    })
  @endif
</script>
