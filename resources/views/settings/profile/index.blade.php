@extends('layouts.master')
@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <div class="card directory-card">
                        <div class="p-4 directory-content">
                            <div class="float-right info-icon p-1">
                                <a href="{{ route('profile.edit', Auth::user()) }}"><i class="mdi mdi-information-variant h5 text-primary"></i> <span class="font-16 text-muted">Info</span></a>
                            </div>
                            <div class="media">
                                <img class="mr-3 rounded-sm" src="{{ asset('storage/user_photo/' . Auth::user()->foto_path) }}" alt="Generic placeholder image" style="max-width: 200px; max-height: 200px;">
                                <div class="media-body text-white">
                                    <h3 class="mt-0 font-18 mb-1">{{ Auth::user()->nama }}</h3>
                                    <p class="text-white-50 m-b-5">{{ Auth::user()->email }}</p>
                                    <p class="text-white-50 m-b-5">{{ Auth::user()->no_hp }}</p>
                                    <p class="font-600">{{ strtoupper(Auth::user()->role) }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
