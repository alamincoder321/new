@extends('layouts.app')
@section('dashboard')
    active
@endsection


@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-left page-title">Welcome !</h4>
            <ol class="breadcrumb pull-right">
                <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <a href="{{route('totalorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$sell}}</span>
                        Total Sales
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('totalorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-purple"><i class="ion-ios7-cart"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{count($orders)}}</span>
                        Total Invoice
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('totaldue')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$due-$takedue}}</span>
                        Total Due
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('totalexpense')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-primary"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$expense+$salary}}</span>
                        Total Expense
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="row">
        <a href="{{route('todayorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$tsell}}</span>
                        Today Sales
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('todayorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-purple"><i class="ion-ios7-cart"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{count($torders)}}</span>
                        Today Invoice
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('totaldue')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$tdue-$totakedue}}</span>
                        Today Due
                    </div>
                </div>
            </div>
        </a>
        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="mini-stat clearfix bx-shadow">
                <span class="mini-stat-icon bg-primary"><i class="ion-social-usd"></i></span>
                <div class="mini-stat-info text-right text-muted">
                    <span class="counter">{{$tsalary + $texpense}}</span>
                    Today Expense
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <a href="{{route('monthorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-info"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$msell}}</span>
                        Monthly Sales
                    </div>
                </div>
            </div>
        </a>
        <a href="{{route('monthorder')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-purple"><i class="ion-ios7-cart"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{count($morders)}}</span>
                        Monthly Invoice
                    </div>
                </div>
            </div>
        </a>

        <a href="{{route('totaldue')}}">
            <div class="col-md-6 col-sm-6 col-lg-3">
                <div class="mini-stat clearfix bx-shadow">
                    <span class="mini-stat-icon bg-success"><i class="ion-social-usd"></i></span>
                    <div class="mini-stat-info text-right text-muted">
                        <span class="counter">{{$mdue-$mtakedue}}</span>
                        Monthly Due
                    </div>
                </div>
            </div>
        </a>

        <div class="col-md-6 col-sm-6 col-lg-3">
            <div class="mini-stat clearfix bx-shadow">
                <span class="mini-stat-icon bg-primary"><i class="ion-social-usd"></i></span>
                <div class="mini-stat-info text-right text-muted">
                    <span class="counter">{{$mexpense+$msalary}}</span>
                    Monthly Expense
                </div>
            </div>
        </div>
    </div>

{{-- <hr/>
    <div class="row">
        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="mini-stat clearfix bx-shadow">
                <span class="mini-stat-icon bg-inverse"><i class="ion-social-usd"></i></span>
                <div class="mini-stat-info text-right text-muted">
                    <span class="counter">{{$msell-$mexpense-$mdue-}}</span>
                    Monthly Profit
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-lg-6">
            <div class="mini-stat clearfix bx-shadow">
                <span class="mini-stat-icon bg-inverse"><i class="ion-social-usd"></i></span>
                <div class="mini-stat-info text-right text-muted">
                    <span class="counter">{{$msell}}</span>
                    Yearly Profit
                </div>
            </div>
        </div>
    </div> --}}

@endsection
