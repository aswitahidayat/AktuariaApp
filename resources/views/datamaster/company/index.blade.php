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

                <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddUserTypeModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Company Type</a>
								</span>

                </div>
                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Company Type Name</th>
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
    </div>
    <div class="modal fade" id="AddUserTypeModal" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="AddUserTypeModalLabel"><i class="ace-icon fa fa-user cyan"></i> | New Company Type</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label bolder">Company Type:</label>
                            <input type="text" class="form-control" id="recipient-name">
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label bolder">Description:</label>
                            <textarea class="form-control" id="message-text"></textarea>
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

        <!-- modal registration form -->
        <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLasbel" id="AddUserTypeModasl">
            <div class="modal-dialog widget-body" role="dialog">
                <div class="position-relative">
                    <div id="login-box" class="login-box visible widget-box border-dark">
                        <div class="widget-body">
                            <div class="widget-main">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="header blue lighter bigger">
                                    <i class="ace-icon fa fa-building cyan"></i>
                                    New Company Type
                                </h4>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <!-- PAGE CONTENT BEGINS -->
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company Type </label>

                                            <div class="col-sm-9">
                                                <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Description </label>

                                            <div class="col-sm-9">
                                                <textarea class="col-xs-10 col-sm-5" id="form-field-8" placeholder="Default Text"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status </label>

                                            <div class="col-sm-9">
                                                <input type="text" id="form-field-1" placeholder="Username" class="col-xs-10 col-sm-5" />
                                            </div>
                                        </div>
                                        <div class="clearfix form-actions">
                                            <div class="col-md-offset-3 col-md-9">
                                                <button class="btn btn-info" type="button">
                                                    <i class="ace-icon fa fa-check bigger-110"></i>
                                                    Submit
                                                </button>

                                                &nbsp; &nbsp; &nbsp;
                                                <button class="btn" type="reset">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Reset
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End modal registration form -->
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
        </script>
    @stop
@endsection
