<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href=" {{ asset('backend/images/favicon.ico') }}">

    <title>Handicrafts Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href=" {{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href=" {{ asset('backend/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href=" {{ asset('backend/css/skin_color.css') }}">

    <link rel="stylesheet" type="text/css" href=" {{ asset('backend/css/toaster.css') }}">
    <style>
        .breadcrumb {

            background-color: #e9ecef00 !important;
        }
    </style>
</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">

        @include('admin.body.header')

        <!-- Left side column. contains the logo and sidebar -->

        @include('admin.body.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">



            @yield('admin')



        </div>
        <!-- /.content-wrapper -->

        @include('admin.body.footer')



        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- Vendor JS -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}"></script>
    {{-- <script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script> --}}
    <script src="{{ asset('../assets/vendor_components/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('../backend/js/pages/data-table.js') }}"></script>


    <!-- /// Tgas Input Script -->
    <script src="{{ asset('../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>

    <!-- // CK EDITOR  -->
    <script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('../assets/js/sweetalert2') }}"></script>
    <script src="{{ asset('../assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
    <script src="{{ asset('backend/js/pages/editor.js') }}"></script>



    <!-- Handicrafts Admin App -->
    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

    <script type="text/javascript " src="{{ asset('backend/js/toaster.min.js') }}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script type="text/javascript">
        $(function() {
            $(document).on('click', '#delete', function(e) {
                e.preventDefauilt();
                var link = $(this).attr("href");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            });
        });
    </script> --}}
    <script type="text/javascript">
        function openModel(route, id) {
            Swal.fire({
                title: 'Are you sure to delete this record?',
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: 'darkred',
                confirmButtonText: 'Yes delete it',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    // function() {
                    $.ajax({
                        url: '16',
                        type: 'DELETE',
                        DataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {

                            Swal.fire({
                                title: `ldkfjalkdjflak`,
                                icon: "success",
                            })
                        },
                        error: function(error) {
                            Swal.fire({
                                title: `ldkfjalkdjflak`,
                                icon: "error",
                            })
                        }
                    });
                    // });
                    // return fetch(`/${route}/${id}`)
                    //     .then(response => {
                    //         console.log(response);
                    //         // if (!response.ok) {
                    //         //     throw new Error(response.statusText)
                    //         // }
                    //         // return response.json()
                    //     })
                    //     .catch(error => {
                    //         // Swal.showValidationMessage(
                    //         //     `Request failed: ${error}`
                    //         // )
                    //     })
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                // if (result.isConfirmed) {
                //     Swal.fire({
                //         title: `${result.value.login}'s avatar`,
                //         imageUrl: result.value.avatar_url
                //     })
                // }
            })
        }
    </script>
    @stack('script')
</body>

</html>
