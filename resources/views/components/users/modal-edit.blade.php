<head>
    <link href="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Edit Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="dataFormEdit">
                    <input type="hidden" id="token" value="{{ csrf_token() }}">
                    <input type="hidden" id="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama<span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control nama" id="nama"
                                    placeholder="Masukkan Nama" />
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                            </div>
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control icon email" id="email"
                                    placeholder="Type something" />
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                            </div>
                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input type="number" class="form-control no_ktp" name="no_ktp" id="no_ktp" placeholder="Masukkan no ktp">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input type="number" class="form-control no_hp" name="no_hp" id="no_hp" placeholder="Masukkan no handphone">
                            </div>
                            <div class="form-group">
                                <label for="foto_path">Foto Diri</label>
                                    <input type="file" name="foto_path" id="foto_path" class="filestyle foto_path" data-buttonname="btn-secondary">
                                    <small class="form-text text-muted"><i>*Max size 1MB</i></small>
                            </div>
                            <small class="form-text">*NB : <em><span class="text-danger">*</span> (field must be
                                    filled)</em>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select id="role" name="role" class="form-control role">
                                    {{-- <option value="">Pilih</option> --}}
                                    <option value="admin">Admin</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" class="form-control tanggal_lahir" placeholder="mm/dd/yyyy" name="tanggal_lahir" id="tanggal_lahir">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control password" name="password" id="password"
                                    placeholder="Enter new password">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label></label>
                                <input id="password-confirm" type="password" class="form-control password-confirm"
                                    name="password_confirmation" autocomplete="new-password"
                                    placeholder="Enter confirm password">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                    TUTUP</button>
                <button type="button" class="btn btn-success" id="update"><i class="fa fa-check"></i>
                    SIMPAN</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{{-- script --}}
@include('components.users.script')
{{-- <script src="{{ asset('style') }}/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script> --}}
<script type="text/javascript">
    // fetch data
    $('body').on('click', '#btn-edit-post', function() {
        var user_id = $(this).data('id');
        //fetch detail post with ajax
        $.ajax({
            url: `users/show/${user_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                // format date
                var originalDate = response.data.tanggal_lahir;
                var convertedDate = new Date(originalDate);
                const formattedDate = new Intl.DateTimeFormat("en-US", {
                    year: "numeric",
                    month: "2-digit",
                    day: "2-digit"
                }).format(convertedDate);

                //fill data to form
                $('#user_id').val(response.data.id);
                $('.nama').val(response.data.nama);
                $('.email').val(response.data.email);
                $('.role').val(response.data.role).trigger('change');
                $('.no_ktp').val(response.data.no_ktp);
                $('.no_hp').val(response.data.no_hp);
                $('.tanggal_lahir').val(formattedDate);
                $('.jenis_kelamin').val(response.data.jenis_kelamin);
                // $('.foto_path').val(response.data.foto_path);
                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    // checkrole function
    $(document).ready(function () {
        // Initial check on role change
        checkRole();
        // Check role on role change
        $('.role').change(function () {
            checkRole();
        });
        function checkRole() {
            var selectedRole = $('.role').val();

            // If the selected role is admin, hide the fields
            if (selectedRole === 'admin') {
                $('.no_ktp, .no_hp, .tanggal_lahir, .jenis_kelamin, .foto_path').closest('.form-group').hide();
            } else {
                $('.no_ktp, .no_hp, .tanggal_lahir, .jenis_kelamin, .foto_path').closest('.form-group').show();
            }
        }
    });

    // datepicker
    $(".tanggal_lahir").datepicker({
        dateFormat: 'mm/dd/yy', // Sesuaikan dengan format tanggal
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0" // Pilihan tahun, misalnya -100: +0 artinya dari tahun sekarang sampai 100 tahun ke belakang
    });

    //action update
    $('#update').click(function(e) {
        e.preventDefault();

        // var form = $('#dataFormEdit')[0];
        // var formData = new FormData(form);
        // define variable
        var token = document.getElementById('token').value;
        var user_id = $('#user_id').val();
        var nama = $('.nama').val();
        var email = $('.email').val();
        var role = $('.role').val();
        var no_hp = $('.no_hp').val();
        var no_ktp = $('.no_ktp').val();
        var tanggal_lahir = $('.tanggal_lahir').val();
        var jenis_kelamin = $('.jenis_kelamin').val();
        var foto_path = $('.foto_path').val();
        var password = $('.password').val();
        var passwordConfirmation = $('.password-confirm').val();
        // ajax
        $.ajax({
            url: `users/update/${user_id}`,
            type: "PUT",
            cache: false,
            data: {
                "nama": nama,
                "email": email,
                "no_ktp": no_ktp,
                "no_hp": no_hp,
                "foto_path": foto_path,
                "role": role,
                "tanggal_lahir": tanggal_lahir,
                "jenis_kelamin": jenis_kelamin,
                "password": password,
                "password_confirmation": passwordConfirmation,
                "_token": token
            },
            success: function(response) {
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    text: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function() { // wait for 1 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 1000);

                //close modal
                $('#modal-edit').modal('hide');
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Cek kembali form anda!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        });
    });
</script>
