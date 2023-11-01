<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Detail Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <input type="hidden" id="user_id">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama<span class="text-danger">*</span></label>
                            <input type="text" name="nama" class="form-control nama" id="nama"
                                placeholder="Masukkan Nama" readonly/>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                        </div>
                        <div class="form-group">
                            <label>Email<span class="text-danger">*</span></label>
                            <input type="text" name="email" class="form-control icon email" id="email"
                                placeholder="Type something" readonly/>
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                        </div>
                        <div class="form-group">
                            <label for="no_ktp">No KTP</label>
                            <input type="number" class="form-control no_ktp" name="no_ktp" id="no_ktp" placeholder="Masukkan no ktp" readonly>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <input type="number" class="form-control no_hp" name="no_hp" id="no_hp" placeholder="Masukkan no handphone" readonly>
                        </div>
                        <div class="form-group">
                            <label for="foto_path">Foto Diri</label>
                            <img id="user-photo" class="img-fluid" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Role</label>
                            <select id="role" name="role" class="form-control role" disabled>
                                {{-- <option value="">Pilih</option> --}}
                                <option value="admin">Admin</option>
                                <option value="member">Member</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <div class="input-group">
                                <input type="text" class="form-control tanggal_lahir" placeholder="mm/dd/yyyy" name="tanggal_lahir" id="tanggal_lahir" readonly>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control jenis_kelamin" disabled>
                                <option value="">Pilih</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{{-- script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    // fetch data
    $('body').on('click', '#btn-view-post', function() {
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
                var photoUrl = "{{ asset('storage/user_photo/') }}" + '/' + response.data.foto_path;
                $('#user-photo').attr('src', photoUrl);
                //open modal
                $('#modal-view').modal('show');
            }
        });
    });
</script>
