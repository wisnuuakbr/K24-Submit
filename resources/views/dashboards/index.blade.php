@extends('layouts.master')
@section('breadcrumb')
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="page-title mb-0">Home</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Home</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="p-3 text-center">
                    <h1>Selamat Datang</h1>
                </div>
                {{-- <div class="ml-3 mr-3">
                    <div class="bg-white p-3 mini-stats-desc rounded">
                        <h5 class="float-right mt-0">1758</h5>
                        <h6 class="mt-0 mb-3">Orders</h6>
                        <p class="text-muted mb-0">Sed ut perspiciatis unde iste</p>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
