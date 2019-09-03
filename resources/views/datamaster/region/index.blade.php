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
                    <a href="#">Setup Region</a>
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
                    Setup Region Type
                </h1>
            </div>
            <div class="tabbable">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active">
                        <a data-toggle="tab" href="#province">
                            <i class="green ace-icon fa fa-globe bigger-120"></i>
                            <strong>Province</strong>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#district">
                            <i class="green ace-icon fa fa-globe bigger-120"></i>
                            <strong>District</strong>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#subdistrict">
                            <i class="green ace-icon fa fa-globe bigger-120"></i>
                            <strong>Sub District</strong>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#village">
                            <i class="green ace-icon fa fa-globe bigger-120"></i>
                            <strong>Village</strong>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#zipcode">
                            <i class="green ace-icon fa fa-globe bigger-120"></i>
                            <strong>Zip Code</strong>
                        </a>
                    </li>

                </ul>

                <div class="tab-content">
                    <!-- BEGIN TAB PROVINCE-->
                    @include('datamaster.region.province.index') 
                    <!-- END TAB PROVINCE-->

                    <!-- BEGIN TAB DISTRICT-->
                    @include('datamaster.region.district.index') 
                    <!-- END TAB DISTRICT-->

                    <!-- BEGIN TAB SUBDISTRICT-->
                    @include('datamaster.region.subdistrict.index') 
                    <!-- END TAB SUBDISTRICT-->
                    
                    <!-- BEGIN TAB VILLAGE-->
                    @include('datamaster.region.village.index')
                    
                    <!-- END TAB VILLAGE-->
                    <!-- BEGIN TAB ZIPCODE-->
                    @include('datamaster.region.zipcode.index')
                    
                    <!-- END TAB ZIPCODE-->
                </div>
            </div>
        </div>
    </div>
</div>

@section('page-script')
<script type="text/javascript">
    $('#search').on('keyup',function(){
        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('search')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });
    })
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    $('.selectpicker').selectpicker(
        {
            liveSearchPlaceholder: 'Placeholder text'
        }
    );
</script>
@stop
@endsection
