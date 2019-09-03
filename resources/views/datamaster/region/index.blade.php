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
                    <div id="province" class="tab-pane fade in active">
                        <div class="page-header">
                            <h1>
                                <small>
                                    Setup Region Type
                                </small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Setup Province
                            </h1>
                        </div>

                        <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddProvinceModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Province</a>
								</span>

                        </div>
                        <div class="row" style="margin-top: 34px;">&nbsp;</div>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Province Name</th>
                                    <th width="17%">BPS Code</th>
                                    <th width="17%">Status</th>
                                    <th width="13%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>
                                            {{$data->usertype_nm}}
                                        </td>
                                        <td>[BPS CODE]</td>
                                        <td>
                                            @if($data->usertype_status == '1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>

                                                <a class="green" href="#">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TAB PROVINCE-->
                    <!-- BEGIN TAB DISTRICT-->
                    <div id="district" class="tab-pane fade">
                        <div class="page-header">
                            <h1>
                                <small>
                                    Setup Region Type
                                </small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Setup District
                            </h1>
                        </div>

                        <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddDistrictModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add District</a>
								</span>

                        </div>
                        <div class="row" style="margin-top: 34px;">&nbsp;</div>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Province Name</th>
                                    <th>District Name</th>
                                    <th width="17%">BPS Code</th>
                                    <th width="17%">Status</th>
                                    <th width="13%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>
                                            {{$data->usertype_nm}}
                                        </td>
                                        <td>[DISTRICT NAME]</td>
                                        <td>[BPS CODE]</td>
                                        <td>
                                            @if($data->usertype_status == '1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>

                                                <a class="green" href="#">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TAB DISTRICT-->
                    <!-- BEGIN TAB SUBDISTRICT-->
                    <div id="subdistrict" class="tab-pane fade">
                        <div class="page-header">
                            <h1>
                                <small>
                                    Setup Region Type
                                </small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Setup Sub District
                            </h1>
                        </div>

                        <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddSubDistrictModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Sub District</a>
								</span>

                        </div>
                        <div class="row" style="margin-top: 34px;">&nbsp;</div>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Province Name</th>
                                    <th>District Name</th>
                                    <th>Sub District Name</th>
                                    <th width="17%">BPS Code</th>
                                    <th width="17%">Status</th>
                                    <th width="13%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>
                                            {{$data->usertype_nm}}
                                        </td>
                                        <td>[DISTRICT NAME]</td>
                                        <td>[SUB DISTRICT NAME]</td>
                                        <td>[BPS CODE]</td>
                                        <td>
                                            @if($data->usertype_status == '1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>

                                                <a class="green" href="#">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TAB SUBDISTRICT-->
                    <!-- BEGIN TAB VILLAGE-->
                    <div id="village" class="tab-pane fade">
                        <div class="page-header">
                            <h1>
                                <small>
                                    Setup Region Type
                                </small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Setup Village
                            </h1>
                        </div>

                        <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddVillageModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Village</a>
								</span>

                        </div>
                        <div class="row" style="margin-top: 34px;">&nbsp;</div>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Province Name</th>
                                    <th>District Name</th>
                                    <th>Sub District Name</th>
                                    <th>Village Name</th>
                                    <th width="17%">BPS Code</th>
                                    <th width="17%">Status</th>
                                    <th width="13%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>
                                            {{$data->usertype_nm}}
                                        </td>
                                        <td>[DISTRICT NAME]</td>
                                        <td>[SUB DISTRICT NAME]</td>
                                        <td>[VILLAGE NAME]</td>
                                        <td>[BPS CODE]</td>
                                        <td>
                                            @if($data->usertype_status == '1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>

                                                <a class="green" href="#">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TAB VILLAGE-->
                    <!-- BEGIN TAB ZIPCODE-->
                    <div id="zipcode" class="tab-pane fade">
                        <div class="page-header">
                            <h1>
                                <small>
                                    Setup Region Type
                                </small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                Setup Zip Code
                            </h1>
                        </div>

                        <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddzipcodeModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Zip Code</a>
								</span>

                        </div>
                        <div class="row" style="margin-top: 34px;">&nbsp;</div>
                        <div class="row">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Province Name</th>
                                    <th>District Name</th>
                                    <th>Sub District Name</th>
                                    <th>Village Name</th>
                                    <th>Zip Code</th>
                                    <th width="17%">BPS Code</th>
                                    <th width="17%">Status</th>
                                    <th width="13%">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($datas as $data)
                                    <tr>
                                        <td>
                                            {{$data->usertype_nm}}
                                        </td>
                                        <td>[DISTRICT NAME]</td>
                                        <td>[SUB DISTRICT NAME]</td>
                                        <td>[VILLAGE NAME]</td>
                                        <td>[ZIP CODE]</td>
                                        <td>[BPS CODE]</td>
                                        <td>
                                            @if($data->usertype_status == '1')
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hidden-sm hidden-xs action-buttons">
                                                <a class="blue" href="#">
                                                    <i class="ace-icon fa fa-search-plus bigger-130"></i>
                                                </a>

                                                <a class="green" href="#">
                                                    <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                </a>

                                                <a class="red" href="#">
                                                    <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                </a>
                                            </div>

                                            <div class="hidden-md hidden-lg">
                                                <div class="inline pos-rel">
                                                    <button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                        <i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                        <li>
                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                    <span class="blue">
                                                                                        <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                    <span class="green">
                                                                                        <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                    <span class="red">
                                                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                    </span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- END TAB ZIPCODE-->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BEGIN MODAL PROVINCE -->
<div class="modal fade" id="AddProvinceModal" tabindex="-1" role="dialog" aria-labelledby="AddProvinceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddProvinceModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Province</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Province Name:</label>
                        <input type="text" class="form-control" id="province-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END PROVINCE MODAL -->
<!-- BEGIN MODAL DISTRICT -->
<div class="modal fade" id="AddDistrictModal" tabindex="-1" role="dialog" aria-labelledby="AddDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddDistrictModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New District</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="chosen-select form-control" id="province-name" data-placeholder="Choose a State...">
                            <option value="">  </option>
                            <option value="AL">Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">District Name:</label>
                        <input type="text" class="form-control" id="district-name">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END District MODAL -->
<!-- BEGIN MODAL SUBDISTRICT -->
<div class="modal fade" id="AddSubDistrictModal" tabindex="-1" role="dialog" aria-labelledby="AddSubDistrictModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddSubDistrictModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Sub District</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="chosen-select form-control" id="province-name" placeholder="Choose a Province...">
                            <option value="">  </option>
                            <option value="AL">Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <select class="chosen-select form-control" id="district-name" placeholder="Choose a District...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Sub District Name:</label>
                        <input type="text" class="form-control" id="subdistrict-name" placeholder="Sub District...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode" placeholder="BPSCODE...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END SUBDistrict MODAL -->
<!-- BEGIN MODAL VILLAGE -->
<div class="modal fade" id="AddVillageModal" tabindex="-1" role="dialog" aria-labelledby="AddVIllageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddVillageModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Village</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="chosen-select form-control" id="province-name" placeholder="Choose a Province...">
                            <option value="">  </option>
                            <option value="AL">Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <select class="chosen-select form-control" id="district-name" placeholder="Choose a District...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subdistrict-name" class="col-form-label bolder">Sub District Name:</label>
                        <select class="chosen-select form-control" id="subdistrict-name" placeholder="Choose a Sub District...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Village Name:</label>
                        <input type="text" class="form-control" id="subdistrict-name" placeholder="Village...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode" placeholder="BPSCODE...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END VILLAGE MODAL -->
<!-- BEGIN MODAL ZIPCODE -->
<div class="modal fade" id="AddzipcodeModal" tabindex="-1" role="dialog" aria-labelledby="AddzipcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddzipcodeModalLabel"><i class="ace-icon fa fa-globe cyan"></i> | New Village</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="province-name" class="col-form-label bolder">Province Name:</label>
                        <select class="chosen-select form-control" id="province-name" placeholder="Choose a Province...">
                            <option value="">  </option>
                            <option value="AL">Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="district-name" class="col-form-label bolder">District Name:</label>
                        <select class="chosen-select form-control" id="district-name" placeholder="Choose a District...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subdistrict-name" class="col-form-label bolder">Sub District Name:</label>
                        <select class="chosen-select form-control" id="subdistrict-name" placeholder="Choose a Sub District...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="village-name" class="col-form-label bolder">Village Name:</label>
                        <select class="chosen-select form-control" id="village-name" placeholder="Choose a Village...">
                            <option value="">  </option>
                            <option value="AL">Banda Aceh</option>
                            <option value="AK">Sumatera Utara</option>
                            <option value="AZ">Sumatera Barat</option>
                            <option value="AR">Riau</option>
                            <option value="CA">Kepulauan Riau</option>
                            <option value="CO">Jambi</option>
                            <option value="CT">Bengkulu</option>
                            <option value="DE">Sumatera Selatan</option>
                            <option value="FL">Kepulauan Bangka Belitung</option>
                            <option value="GA">Lampung</option>
                            <option value="HI">Banten</option>
                            <option value="ID">Jawa Barat</option>
                            <option value="IL">DKI Jakarta</option>
                            <option value="IN">Jawa Tengah</option>
                            <option value="IA">DI Yogyakarta</option>
                            <option value="KS">Jawa Timur</option>
                            <option value="KY">Bali</option>
                            <option value="LA">Nusa Tenggara Barat</option>
                            <option value="ME">Nusa Tenggara Timur</option>
                            <option value="MD">Kalimantan Utara</option>
                            <option value="MA">Kalimantan Barat</option>
                            <option value="MI">Kalimantan Tengah</option>
                            <option value="MN">Kalimantan Selatan</option>
                            <option value="MS">Kalimantan Timut</option>
                            <option value="MO">Gorontalo</option>
                            <option value="MT">Sulawesi Utara</option>
                            <option value="NE">Sulawesi Barat</option>
                            <option value="NV">Sulawesi Tengah</option>
                            <option value="NH">Sulawesi Tenggara</option>
                            <option value="NJ">Sulawesi Selatan</option>
                            <option value="NM">Maluku Utara</option>
                            <option value="NY">Maluku</option>
                            <option value="NC">Papua Barat</option>
                            <option value="ND">Papua</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">Zip Code:</label>
                        <input type="text" class="form-control" id="subdistrict-name" placeholder="Village...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">BPS Code:</label>
                        <input type="text" class="form-control" id="bpscode" placeholder="BPSCODE...">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="form-field-radio" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </div>
    </div>
</div>
<!-- END ZIPCODE MODAL -->

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
