@extends('layouts.backend')

@section('gaya')
@endsection

@section('aku_isi_mas')
    <h1 class="h3 mb-4 font-weight-bold">{{ $title }}</h1>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    Admin Profile
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2 mb-4 mb-md-0">
                            <img src="" alt="" class="img-thumbnail rounded mb-2">
                            <a href="#" class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                data-target="#edit_profile_modal">
                                <i class="fa fa-edit"></i> Edit Profile
                            </a>
                            <a href="#" class="btn btn-sm btn-block btn-primary" data-toggle="modal"
                                data-target="#changePasswordModal">
                                <i class="fa fa-lock"></i> Ubah Password
                            </a>
                        </div>
                        <div class="col-md-10">
                            <table class="table">
                                <tr>
                                    <th>Email</th>
                                    <td>{{ session('email') }}</td>
                                </tr>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ session('full_name') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="form_edit_profile">
        <div class="modal fade" id="edit_profile_modal" tabindex="-1" role="dialog" aria-labelledby="label_edit_profile"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="label_edit_profile">Edit Profile</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="full_name">Nama</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required />
                            <div class="input-validation-error"></div>
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
@endsection

@section('bahasa_jawa')
    <script>
        let form_edit_profile = $('#form_edit_profile')
        let full_name = $('#full_name')

        $('#form_edit_profile').validate({
            errorElement: 'span',
            errorElementClass: 'input-validation-error',
            errorClass: 'text-danger',

            submitHandler: function(form, event) {
                event.preventDefault()

                $.ajax({
                    url: `{{ route('profile.edit') }}`,
                    method: 'post',
                    dataType: 'json',
                    data: {
                        full_name: full_name.val(),
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
                    if (e.success === true) {
                        return Swal.fire({
                            icon: 'success',
                            title: `${e.message}`,
                            toast: true,
                            timer: 2000,
                            position: 'top-end',
                            showConfirmButton: false,
                        }).then(() => {
                            $('#changePasswordModal').modal('hide')
                            window.location.reload()
                        })
                    }

                    return Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: `${e.message}`,
                    })

                })

                return false
            }
        })
    </script>
@endsection
