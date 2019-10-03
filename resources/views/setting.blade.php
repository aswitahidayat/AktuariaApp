@extends('layouts.app')

@section('content')
<div class="main-content">
    <div class="main-content-inner">
       <div class="breadcrumbs ace-save-state" id="breadcrumbs">
           <ul class="breadcrumb">
               <li>
                   <i class="ace-icon fa fa-cogs cogs-icon"></i>
                   <a href="#">Setting</a>
               </li>
   
               <li>
                   <a href="#">Change Password</a>
               </li>
           </ul>
       </div>
       <div class="page-content">
           <div class="page-header">
                <h1>
                    <small>
                        Setting
                    </small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Change Password
                </h1>
           </div>
   
           <form id="formChangePassword" action="javascript:void(0);">
               <div class="row">
                   <div class="col-sm-6">
                       <div class="form-group">
                           <label class="col-sm-4 control-label no-padding-right">Old Password:</label>
                           <div class="col-sm-8 pb-20">
                               <input type="password" class="form-control" id="password" name="password" required>
                           </div>
                       </div>
                       <div class="form-group">
                            <label class="col-sm-4 control-label no-padding-right">New Password:</label>
                            <div class="col-sm-8 pb-20">
                                <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                            </div>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-offset-4 col-sm-8 pb-20">
                               <button type="submit" class="btn btn-primary btn-sm">Change</button>
                           </div>
                       </div>
                   </div>
               </div>
   
           </form>
           
           <br>
       </div>
    </div>
</div>
<script>
    $(function () {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $( "#formChangePassword" ).submit(function( e ) {
            $.ajax({
                type: "POST",
                data: $('#formChangePassword').serialize(),
                url: "{{ route('changepassword') }}",
                success: function (data) {
                    debugger;
                    // table.draw();
                    if(data.success == 1){
                        alert("Password change successfully.");
                    } else{
                        alert("Password change Fail.");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })
    })
</script>
@endsection

