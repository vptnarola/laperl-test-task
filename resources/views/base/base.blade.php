<!DOCTYPE html>
<html>
<head>
    <title>La Perl Tour</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('styles')

    <style type="text/css">
        .tour-table {
            border-bottom: none !important;
        }

        .tour-table th {
            border: none !important;
        }
        .title {
            font-size: 2rem;
            color: #000;
        }
        .title a{
            color: #000;
            text-decoration:none;
        }
        .tour-image {
            width: 50%;
        }

        .submit_btn, .submit_btn:hover{
            color: #fff;
            background-color: #000;
            border-color: #000;
            text-decoration: none;
        }

        .book_btn,.book_btn:hover{
            background: #000 !important;
            text-decoration: none;
        }
        .label, .label-success, .label-danger, .label-warning {
            display: inline;
            padding: 0.2em 0.6em 0.3em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }
        .label-success{
            color: #fff;
            background: #5cb85c;
        }
        .label-danger{
            color: #fff;
            background: #d9534f;
        }
        .label-warning{
            color: #fff;
            background: #f0ad4e;
        }

        .page-item.active .page-link {
            color: #fff;
            background-color: #000 !important;
            border-color: #000 !important;
        }



    </style>
    <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
     
    

</head>
<body>
    <br><br>
    <h1 class="text-center title"><b><a href="{{route('tour-listing')}}">La Perl Tour</a></b></h1>
    <br><br>

	@yield('content')
   
</body>
<script>
    const __url = "{{ url('') }}";
    const __public_url = "{{ public_path() }}";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //initialize sweet alert
    function sweet_alert(title = '', type = '', is_refresh_datatable = 0, datatable_object = '', is_redirect = 0, redirect_url = '') {
        Swal.fire({
            text: title,
            icon: type == 'success' ? "success" : 'error',
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function (result) {
            if (is_refresh_datatable == 1) {
                datatable_object.DataTable().ajax.reload(null, false);
            } else {
                if (is_redirect == 1) {
                    window.location.href = redirect_url;
                }
            }
        });
    }

    //initialize datatable
    function refresh_datatable(datatable_object){
        datatable_object.DataTable().ajax.reload(null, false);
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<script>
  @if(Session::has(config('global.general.msg_message')))
          toastr.options =
          {
            "closeButton" : true,
            "progressBar" : true
          }
        toastr.success("{{ session(config('global.general.msg_message')) }}");
  @endif

  @if(Session::has(config('global.general.msg_error')))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.error("{{ session(config('global.general.msg_error')) }}");
  @endif

    @if(Session::has(config('global.general.msg_info')))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.info("{{ session(config('global.general.msg_info')) }}");
    @endif

  @if(Session::has(config('global.general.msg_warning')))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
        toastr.warning("{{ session(config('global.general.msg_warning')) }}");
  @endif
</script>
@yield('scripts')
</html>