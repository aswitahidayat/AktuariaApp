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

                <div class="nav-search" id="nav-search">
                    <span class="input-icon">
                        <input type="text" placeholder="Search ..." class="nav-search-input" id="search" name="search" autocomplete="off" />
                        <i class="ace-icon fa fa-search nav-search-icon"></i>
                        <!--<a href="#" data-toggle="modal" data-target="#AddAgentModal" class="btn btn-info btn-sm"><i class="ace-icon fa fa-plus small"></i> Add Verifikasi Pembayaran</a>-->
                    </span>
                </div>
                <div class="row" style="margin-top: 33px;">&nbsp;</div>
                <div class="row">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Order Name</th>
                            <th>Program</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th width="13%">Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($datas as $data)
                        <tr>
                            <td>
                                {{$data->name}}
                            </td>
                            <td>
                                {{$data->email}}
                            </td>
                            <td>
                                [CUSTOMER]
                            </td>
                            <td>
                                @if($data->id == '1')
                                    Verified
                                @else
                                    Confirm
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
    </div>
    <div class="modal fade" id="AddAgentModal" tabindex="-1" role="dialog" aria-labelledby="AddAgentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title blue lighter bigger bolder" id="AddAgentModalLabel"><i class="ace-icon fa fa-user-secret cyan"></i> | Register Agent</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="agent-name" class="col-form-label bolder">Agent Name:</label>
                            <input type="text" class="form-control" id="agent-name">
                        </div>
                        <div class="form-group">
                            <label for="agent-email" class="col-form-label bolder">Agent Email:</label>
                            <input type="email" class="form-control" id="agent-email">
                        </div>
                        <div class="form-group">
                            <label for="type-identity" class="col-form-label bolder">Type Identity:</label>
                            <input type="text" class="form-control" id="type-identity">
                        </div>
                        <div class="form-group">
                            <label for="identity-number" class="col-form-label bolder">Identity Number:</label>
                            <input type="number" class="form-control" id="identity-number">
                        </div>
                        <div class="form-group">
                            <label for="agent-phone" class="col-form-label bolder">Agent Phone:</label>
                            <input type="number" class="form-control" id="agent-phone">
                        </div>
                        <div class="form-group">
                            <label for="birth-place" class="col-form-label bolder">Birth Place:</label>
                            <input type="text" class="form-control" id="birth-place">
                        </div>
                        <div class="form-group">
                            <label for="birth-date" class="col-form-label bolder">Birth Date:</label>
                            <input type="date" class="form-control" id="birth-date">
                        </div>
                        <div class="form-group">
                            <label for="npwp" class="col-form-label bolder">NPWP Number:</label>
                            <input type="number" class="form-control" id="npwp">
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
