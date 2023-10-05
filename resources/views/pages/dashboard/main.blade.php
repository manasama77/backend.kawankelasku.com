@extends('layouts.backend')

@section('gaya')
@endsection

@section('aku_isi_mas')
    <h1 class="h3 mb-4 font-weight-bold">{{ $title }}</h1>

    <div class="row">

        <div class="col-xl-3 col-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Member</div>
                            <div class="h5 mb-0 font-weight-bold">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bahasa_jawa')
@endsection
