@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-money cogs-icon"></i>
                    <a href="#">Transaction</a>
                </li>

                <li>
                    <a href="#">Perhitungan</a>
                </li>
            </ul>
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>
                    <small>
                        Transaction
                    </small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Perhitungan
                </h1>
            </div>

            <form id="formSearchOrder" action="javascript:void(0);">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right">Perhitungan:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="search_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 pb-20">
                                <a href="#" id="createOrder" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Order</a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
            <a class="pull-right" href="{{asset('template.csv')}}" >Template Upload Employe</a>
            {{-- <div class="nav-search" id="nav-search">
                <span class="input-icon">
                    <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                    <i class="ace-icon fa fa-search nav-search-icon"></i>
                    <a href="#" data-toggle="modal" data-target="#AddOrderModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Order/SPK</a>
                </span>
            </div> --}}
            <div class="row" style="margin-top: 33px;">&nbsp;</div>
            <div class="row">
                <table id="tableOrder" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Actions</th>
                            <th>Nomor Order</th>
                            <th>Program</th>
                            <th>Last Year Period</th>
                            <th>Staus</th>
                        </tr>
                    </thead>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    @include('transaction.order.orderForm')

    @include('transaction.order.orderView')

    @include('transaction.order.orderAssumptionForm')
    
    @include('transaction.perhitungan.perhitunganScript') 

@endsection
