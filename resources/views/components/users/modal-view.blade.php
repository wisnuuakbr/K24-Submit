<div class="modal fade" id="modal-view" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">Detail Data Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="token" value="{{ csrf_token() }}">
                <input type="hidden" id="user_id">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            <p class="nama"></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p class="email"></p>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <p class="tanggal_lahir"></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <p class="jenis_kelamin"></p>
                        </div>
                        <div class="form-group">
                            <label for="no_ktp">No KTP</label>
                            <p class="no_ktp"></p>
                        </div>
                        <div class="form-group">
                            <label for="foto_path">Foto Diri</label>
                            <img id="user-photo" class="img-fluid" style="width: 200px; height: 200px;">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Role</label>
                            <p class="role"></p>
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No Handphone</label>
                            <p class="no_hp"></p>
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
                $('.nama').text(response.data.nama);
                $('.email').text(response.data.email);
                $('.role').text(response.data.role).trigger('change');
                $('.no_ktp').text(response.data.no_ktp);
                $('.no_hp').text(response.data.no_hp);
                $('.tanggal_lahir').text(formattedDate);
                $('.jenis_kelamin').text(response.data.jenis_kelamin);
                var photoUrl = "{{ asset('storage/user_photo/') }}" + '/' + response.data.foto_path;
                $('#user-photo').attr('src', photoUrl);
                //open modal
                $('#modal-view').modal('show');
            }
        });
    });
</script>
