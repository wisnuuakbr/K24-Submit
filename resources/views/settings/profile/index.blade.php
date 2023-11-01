@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a href="javascript:void(0)" class="btn btn-info float-right mb-3" id="btn-create-post"><i
                            class="typcn typcn-plus"></i>
                        Tambah Data</a>
                    <h3 class="mt-0 header-title">List User</h3>
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="thead-default">
                                <tr>
                                    <th class="text-center">NO.</th>
                                    <th class="text-center">NAMA</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">ROLE</th>
                                    <th class="text-center">Foto</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
