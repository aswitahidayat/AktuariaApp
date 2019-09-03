@if(isset($data))
    {!! Form::model($data,['method'=>'put','id'=>'frm']) !!}
@else
    {!! Form::open(['id'=>'frm']) !!}
@endif
<div class="modal-header">
    <h5 class="modal-title">{{isset($data)?'Edit':'New'}} Customer</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="form-group row required">
        {!! Form::label("name","Name",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {!! Form::text("name",null,["class"=>"form-control".($errors->has('name')?" is-invalid":""),'placeholder'=>'Name','id'=>'focus']) !!}
            <span id="error-name" class="invalid-feedback"></span>
        </div>
    </div>
    <div class="form-group row">
        {!! Form::label("gender","Gender",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {!! Form::select("gender",['Male'=>'Male','Female'=>'Female'],null,["class"=>"form-control"]) !!}
        </div>
    </div>
    <div class="form-group row required">
        {!! Form::label("email","Email",["class"=>"col-form-label col-md-3"]) !!}
        <div class="col-md-9">
            {!! Form::text("email",null,["class"=>"form-control".($errors->has('email')?" is-invalid":""),'placeholder'=>'Email']) !!}
            <span id="error-email" class="invalid-feedback"></span>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal"> Close</button>
    {!! Form::submit("Save",["class"=>"btn btn-primary"])!!}
</div>
{!! Form::close() !!}
<!--  -->
<div class="modal fade" id="AddUserTypeModal" tabindex="-1" role="dialog" aria-labelledby="AddUserTypeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title blue lighter bigger bolder" id="AddUserTypeModalLabel"><i class="ace-icon fa fa-user cyan"></i> | New User Type</h4>
            </div>
            <div class="modal-body">
                <form method="POST" class="form-horizontal" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label bolder">User Type:</label>
                        <input type="text" class="form-control" id="usertypename" name="usertypename">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Description:</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label bolder">Status:</label>
                        <div class="radio">
                            <label>
                                <input name="usertypestatus" type="radio" class="ace" />
                                <span class="lbl"> Active</span>
                            </label>
                            <label>
                                <input name="usertypestatus" type="radio" class="ace" />
                                <span class="lbl"> Inactive</span>
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="ace-icon fa fa-undo bigger-110"></i>Cancel</button>
                <button type="button" class="btn btn-primary"><i class="ace-icon fa fa-save bigger-110"></i>Save</button>
            </div>
        </form>
    </div>
</div>
</div>
