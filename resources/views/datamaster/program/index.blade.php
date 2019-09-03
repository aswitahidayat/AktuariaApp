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
                        <a href="#">Setup Order Program</a>
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
                        Setup Order Program
                    </h1>
                </div>

                <div class="nav-search" id="nav-search">

								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
                                    <a href="#" data-toggle="modal" data-target="#AddProgramModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Order Program</a>
								</span>

                </div>
                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Order Program Name</th>
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
    <div class="modal fade" id="AddProgramModal" tabindex="-1" role="dialog" aria-labelledby="AddProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="AddProgramModalLabel"><i class="ace-icon fa fa-television cyan"></i> | New Order Program</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label bolder">Order Service Name:</label>
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
