@extends('layouts.auth')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="mb-4 text-center">
                    <h4 class="title">Register your Account</h4>
                    <p class="text-muted">Get started with our app, just create an account and enjoy the
                        experience.
                    </p>
                </div>
                <form class="form-horizontal m-t-10" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control  @error('nama') is-invalid @enderror" name="nama"
                            value="{{ old('nama') }}" id="nama" placeholder="Masukkan nama lengkap">
                        @error('nama')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" id="email" placeholder="Masukkan email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_hp">No Handphone</label>
                        <input type="number" class="form-control  @error('no_hp') is-invalid @enderror" name="no_hp"
                            value="{{ old('no_hp') }}" id="no_hp" placeholder="Masukkan no handphone">
                        @error('no_hp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tanggal_lahir">Tanggal Lahir</label>
                        <div class="input-group">
                            <input type="text" class="form-control @error('tanggal_lahir') is-invalid @enderror" placeholder="mm/dd/yyyy" name="tanggal_lahir" id="tanggal_lahir">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        @error('tanggal_lahir')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin" class="form-control select2 @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">Pilih</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="no_ktp">No KTP</label>
                        <input type="number" class="form-control  @error('no_ktp') is-invalid @enderror" name="no_ktp"
                            value="{{ old('no_ktp') }}" id="no_ktp" placeholder="Masukkan no ktp">
                        @error('no_ktp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="foto_path">Foto</label>
                        <div class="form-group">
                            <input type="file" name="foto_path" class="filestyle @error('foto_path') is-invalid @enderror" data-buttonname="btn-secondary">
                        </div>
                        @error('foto_path')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                         id="password" placeholder="Masukkan Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                         autocomplete="new-password" placeholder="Masukkan Password">
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-block btn-info w-md waves-effect waves-light"
                                type="submit">Register</button>
                        </div>
                    </div>
                    <p class="text-center">Already have an account ? <a href="{{ route('login') }}"
                            class="font-600 text-info font-weight-bold"> Sign In </a> </p>
                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12">
                            <p class="font-14 text-center text-muted mb-0">By registering you agree to the <a href="#"
                                    class="text-info">Terms of Use</a></p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(function() {
            $("#tanggal_lahir").datepicker({
                dateFormat: 'mm/dd/yy', // Sesuaikan dengan format tanggal
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0" // Pilihan tahun, misalnya -100: +0 artinya dari tahun sekarang sampai 100 tahun ke belakang
            });
        });
    </script>
    @include('layouts.footer')
@endsection

