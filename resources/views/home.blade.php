@extends('layouts.app')

@section('content')
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Home</a>
            </li>
            <li class="active">Dashboard</li>
        </ul><!-- /.breadcrumb -->

    </div>
    <div class="page-content">
        <div>
            <div class="page-header">
                <h1>
                    Dashboard
                </h1>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <!-- CONTENT -->
                    <div class="alert alert-block alert-success">
                        <button type="button" class="close" data-dismiss="alert">
                            <i class="ace-icon fa fa-times"></i>
                        </button>

                        <i class="ace-icon fa fa-check green"></i>

                        Welcome to
                        <strong class="green">
                            .aktuaria.
                        </strong>,
                        {{Auth::user()->username}}.
                    </div>
                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </div>
@endsection
