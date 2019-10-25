@extends('layouts.app')

@section('content')
<div class="main-content">
 <div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-cogs cogs-icon"></i>
                <a href="#">Data Master</a>
            </li>

            <li>
                <a href="#">Setup Partner</a>
            </li>
        </ul>
    </div>
    <div class="page-content">
        <div class="page-header">
             <h1>
                 <small>
                     Data Master
                 </small>
                 <i class="ace-icon fa fa-angle-double-right"></i>
                 Setup Partner
             </h1>
        </div>

        <form id="formSearchPartner" action="javascript:void(0);">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label no-padding-right">Partner Name:</label>
                        <div class="col-sm-8 pb-20">
                            <input type="text" class="form-control" id="search_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8 pb-20">
                            <a href="#" id="createPartner" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Partner</a>
                            <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        
        <br>
        <table id="tablePartner" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th width="23px">No</th>
                    <th width="103px">Action</th>
                    <th>Partner Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
 </div>
</div>

<!-- modal registration form -->
@include('transaction.companyPartner.companyPartnerForm') 
<!-- End modal registration form -->
@endsection

@section('js')
@include('transaction.companyPartner.companyPartnerScript') 

@endsection
