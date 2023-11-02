@extends('layouts.master')
@section('content')
<head>
    <link href="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="text-right">
                    <a href="{{ route('profile.index') }}" class="btn btn-danger"><i class="typcn typcn-chevron-left"></i> Kembali</a>
                </div>
                <form action="{{ route('profile.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama<span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control nama" id="nama"
                                    placeholder="Masukkan Nama" value="{{ old('nama', $data->nama) }}"/>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name"></div>
                            </div>
                            <div class="form-group">
                                <label>Email<span class="text-danger">*</span></label>
                                <input type="text" name="email" class="form-control icon email" id="email"
                                    placeholder="Type something" value="{{ old('email', $data->email) }}" />
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-icon"></div>
                            </div>
                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input type="number" class="form-control no_ktp" name="no_ktp" id="no_ktp" placeholder="Masukkan no ktp" value="{{ old('no_ktp', $data->no_ktp) }}">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No Handphone</label>
                                <input type="number" class="form-control no_hp" name="no_hp" id="no_hp" placeholder="Masukkan no handphone" value="{{ old('no_hp', $data->no_hp) }}">
                            </div>
                            <div class="form-group">
                                <label for="foto_path">Foto Diri</label>
                                    <input type="file" name="foto_path" id="foto_path" class="filestyle foto_path" data-buttonname="btn-secondary">
                                    <small class="form-text text-muted"><i>*Max size 1MB</i></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir</label>
                                <div class="input-group">
                                    <input type="text" class="form-control tanggal_lahir" placeholder="mm/dd/yyyy" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', date('m/d/Y', strtotime($data->tanggal_lahir))) }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Jenis Kelamin</label>
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-control jenis_kelamin">
                                    <option value="">Pilih</option>
                                    <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                    <div class="text-right" style="text-align: right">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                            Reset</button>
                        <button type="submit" class="btn btn-success" id="update"><i class="fa fa-check"></i>
                            Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('style') }}/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('style') }}/assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
<script>
    // datepicker
    $(".tanggal_lahir").datepicker({
        dateFormat: 'mm/dd/yy', // Sesuaikan dengan format tanggal
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0" // Pilihan tahun, misalnya -100: +0 artinya dari tahun sekarang sampai 100 tahun ke belakang
    });
</script>
@endsection
