<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Admin Kawankelasku | {{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    @vite('resources/sbadmin2/sb-admin-2.css')

    <style>
        #accordionSidebar,
        .topbar {
            z-index: 1;
        }
    </style>

    @yield('gaya')
</head>


<body id="page-top">

    <div id="wrapper">

        @include('layouts.backend_sidebar')

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                @include('layouts.backend_topbar')

                <div class="container-fluid">
                    @yield('aku_isi_mas')
                </div>

            </div>

            @include('layouts.backend_footer')

        </div>
    </div>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <form id="form_change_password">
        <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
            aria-labelledby="labelChangePassword" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="labelChangePassword">Change Password</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password"
                                required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="new_password_confirmation">New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation"
                                name="new_password_confirmation" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Bootstrap core JavaScript-->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery_validation/jquery.validate.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"
        integrity="sha512-eYSzo+20ajZMRsjxB6L7eyqo5kuXuS2+wEbbOkpaur+sA2shQameiJiWEzCIDwJqaB0a4a6tCuEvCOBHUg3Skg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // define
        let form_change_password = $('#form_change_password')
        let current_password = $('#current_password')
        let new_password = $('#new_password')
        let new_password_confirmation = $('#new_password_confirmation')

        // form_change_password.on('submit', e => {
        //     e.preventDefault()
        // })

        $('#form_change_password').validate({
            errorElement: 'span',
            errorElementClass: 'input-validation-error',
            errorClass: 'text-danger',
            submitHandler: function(form, event) {
                event.preventDefault()

                $.ajax({
                    url: `{{ route('change_password') }}`,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        current_password: current_password.val(),
                        new_password: new_password.val(),
                        new_password_confirmation: new_password_confirmation.val(),
                    },
                    beforeSend: (xhr) => {
                        form_change_password.block({
                            message: `<i class="fas fa-spinner fa-spin"></i>`
                        })
                    },
                }).always(() => {
                    form_change_password.unblock()
                }).fail(e => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${e.message}`,
                    })
                }).done(e => {
                    console.log(typeof e)
                    if (e.success === false) {
                        return Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: `${e.message}`,
                        })
                    }

                    return Swal.fire({
                        icon: 'success',
                        title: `${e.message}`,
                        toast: true,
                        timer: 2000,
                        position: 'top-end',
                        showConfirmButton: false,
                    }).then(() => {
                        $('#changePasswordModal').modal('hide')
                    })

                })
            }
        })
    </script>

    @yield('bahasa_jawa')

</body>

</html>
