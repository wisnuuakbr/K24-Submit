<head>
    <link href="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Tambah Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="dataForm">
                    @csrf
                    {{-- <input type="hidden" id="token" value="{{ csrf_token() }}"> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama Lengkap<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" required id="nama"
                                    placeholder="Masukkan nama lengkap">
                            </div>
                            <div class="form-group">
                                <label for="email">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required id="email"
                                    placeholder="Masukkan email">
                            </div>
                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input type="number" class="form-control" name="no_ktp" id="no_ktp" placeholder="Masukkan no ktp">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input type="number" class="form-control" name="no_hp" id="no_hp" placeholder="Masukkan no handphone">
                            </div>
                            <div class="form-group">
                                <label for="foto_path">Foto Diri</label>
                                    <input type="file" name="foto_path" id="foto_path" class="filestyle" data-buttonname="btn-secondary">
                                    <small class="form-text text-muted"><i>*Max size 1MB</i></small>
                            </div>
                            <small class="form-text">*NB : <em><span class="text-danger">*</span> (field must be
                                    filled)</em>
                            </small>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Role</label>
                                <select id="role" name="role" class="form-control select2">
                                    {{-- <option value="">Pilih</option> --}}
                                    <option value="admin">Admin</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="mm/dd/yyyy" name="tanggal_lahir" id="tanggal_lahir">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select2">
                                    <option value="">Pilih</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password">Password<span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required id="password"
                                    placeholder="Masukkan password">
                            </div>
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password<span
                                        class="text-danger">*</span></label></label>
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Masukkan ulang password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                            TUTUP</button>
                        <button type="button" class="btn btn-success" id="save"><i class="fa fa-check"></i>
                            SIMPAN</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>
{{-- script --}}
@include('components.users.script')
<script>
    //button create post event
    $('body').on('click', '#btn-create-post', function() {
        //open modal
        $('#modal-create').modal('show');
    });

    $(document).ready(function () {
        // Initial check on role change
        checkRole();

        // Check role on role change
        $('#role').change(function () {
            checkRole();
        });

        function checkRole() {
            var selectedRole = $('#role').val();

            // If the selected role is admin, hide the fields
            if (selectedRole === 'admin') {
                $('#no_ktp, #no_hp, #tanggal_lahir, #jenis_kelamin, #foto_path').closest('.form-group').hide();
            } else {
                $('#no_ktp, #no_hp, #tanggal_lahir, #jenis_kelamin, #foto_path').closest('.form-group').show();
            }
        }
    });

    // datepicker
    $("#tanggal_lahir").datepicker({
        dateFormat: 'mm/dd/yy', // Sesuaikan dengan format tanggal
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0" // Pilihan tahun, misalnya -100: +0 artinya dari tahun sekarang sampai 100 tahun ke belakang
    });

    //action create post
    $('#save').click(function(e) {
        e.preventDefault();

        var form = $('#dataForm')[0];
        var formData = new FormData(form);

        // define variable
        var token = $('meta[name="csrf-token"]').attr('content');
        var nama = $('#nama').val();
        var email = $('#email').val();
        var no_ktp = $('#no_ktp').val();
        var no_hp = $('#no_hp').val();
        var foto_path = $('#foto_path').val();
        var role = $('#role').val();
        var tanggal_lahir = $('#tanggal_lahir').val();
        var jenis_kelamin = $('#jenis_kelamin').val();
        var password = $('#password').val();
        var passwordConfirmation = $('#password-confirm').val();
        // ajax
        $.ajax({
            url: `users/store`,
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            // data: {
            //     "nama": nama,
            //     "email": email,
            //     "no_ktp": no_ktp,
            //     "no_hp": no_hp,
            //     "foto_path": foto_path,
            //     "role": role,
            //     "tanggal_lahir": tanggal_lahir,
            //     "jenis_kelamin": jenis_kelamin,
            //     "password": password,
            //     "password_confirmation": passwordConfirmation,
            //     "_token": token
            // },
            success: function(response) {
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Success',
                    text: 'Data berhasil ditambah!',
                    showConfirmButton: false,
                    timer: 3000
                });
                setTimeout(function() { // wait for 1 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 1000);

                //close modal
                $('#modal-create').modal('hide');
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
