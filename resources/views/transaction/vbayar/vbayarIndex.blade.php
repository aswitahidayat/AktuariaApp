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
                        <a href="#">Verifikasi Pembayaran</a>
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
                        Verifikasi Pembayaran
                    </h1>
                </div>

                <form id="formSearchVb" action="javascript:void(0);">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-sm-4 control-label no-padding-right">Order Number:</label>
                                <div class="col-sm-8 pb-20">
                                    <input type="text" class="form-control" id="search_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8 pb-20">
                                    <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                                </div>
                            </div>
                        </div>
                    </div>
    
                </form>
                {{-- <div class="nav-search" id="nav-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                        <!--<a href="#" data-toggle="modal" data-target="#AddAgentModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Verifikasi Pembayaran</a>-->
                    </span>
                </div> --}}
                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="tableVb" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Actions</th>
                            <th>Nomor Order</th>
                            <th>Program</th>
                        </tr>
                        </thead>

                        <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @include('transaction.vbayar.vbForm')
    @include('transaction.vbayar.vbScript')

    
@endsection
