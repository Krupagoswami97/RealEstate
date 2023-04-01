@extends('layout.app')
@php
    use App\Models\RealEstate;
    $RealEstateCount = RealEstate::withTrashed()->count();
    // $RealEstateTrashCount = RealEstate::where('deleted_at','!=',"Null")->count();

@endphp

@section('title') Dashboard @endsection

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/css/plugins/charts/chart-apex.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('theme/app-assets/vendors/css/charts/apexcharts.css') }}">
<style>

    .custom-bl{
        padding-top: 1mm;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .custom-bl:hover{
        overflow: visible;
        white-space: normal;
        height:auto;
        z-index: 5;
    }
    .card-body a {
        color: #625f6e !important;
        text-decoration: none;
    }

</style>
@endsection

@section('sidebar') @include('sidebar.main') @endsection

@section('content')
<!-- Total record of real estate table --->
<section id="dashboard-analytics">
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('real_estate.index') }}">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <h3 class="fw-bolder mb-75">{{$RealEstateCount}}</h3>
                                <span>Total Real Estate</span>
                            </div>
                            <div class="avatar bg-light-success p-50">
                                <span class="avatar-content">
                                    <i data-feather="globe" class="font-medium-4"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')

@endsection
