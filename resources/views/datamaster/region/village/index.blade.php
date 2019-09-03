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
@include('datamaster.region.village.form') 