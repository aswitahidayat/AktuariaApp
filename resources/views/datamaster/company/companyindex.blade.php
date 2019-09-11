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
                    <a href="#">Setup Company Type</a>
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
                    Setup Company Type
                </h1>
            </div>

            <form id="formSearchCompanyType" action="javascript:void(0);">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right">Company Type Name:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="text" class="form-control" id="search_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-8 pb-20">
                                <a href="#" id="createCompanyType" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Company Type</a>
                                <button type="submit" class="btn btn-primary btn-sm"><i class="ace-icon fa fa-search bigger-110"></i>Find</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="row">
                <table id="tableCompanyType" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="23px">No</th>
                            <th width="180px">Actions</th>
                            <th>Company Type Name</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- modal registration form -->
@include('datamaster.company.form') 
<!-- End modal registration form -->

@include('datamaster.company.companyscript') 

@endsection
