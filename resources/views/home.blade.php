@extends('layouts.master')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
<main class="col bg-faded py-3 flex-grow-1">
    <div class="container-xl">
        <div class="container bootstrap snippets bootdey">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="mini-stat clearfix bg-mine rounded">
                        <span class="mini-stat-icon fg-mine">{{ $urlCount }}</span>
                        <div class="mini-stat-info">
                            <h5>Hashed URL</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="mini-stat clearfix bg-thousand rounded">
                        <span class="mini-stat-icon fg-thousand">{{ $all['active_url'] }}</span>
                        <div class="mini-stat-info">
                            <h5>Active Hashed URL</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="mini-stat clearfix bg-unlimited rounded">
                        <span class="mini-stat-icon fg-unlimited">{{ $all['deactive_url'] }}</span>
                        <div class="mini-stat-info">
                           <h5>Deactive Hashed URL</h5>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</main>
@endsection