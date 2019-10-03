<div id="signup-box" class="signup-box widget-box no-border" style="position: absolute; width: 600px; left: 0; right: 0; margin-left: auto; margin-right: auto; ">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                New Registration
            </h4>
            <form id="formRegist" action="javascript:void(0);">
                <div class="row">
                    <div class="col-xs-6">
                        <p> <strong> Enter your personal details : </strong></p>
                        <fieldset>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usremail" name="usremail" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                                    <i class="ace-icon fa fa-envelope"></i>
                                </span>
                                <span id="email_err" class="invalid-feedback" role="alert" style="display: none">
                                    <small class="text-danger" > Email Exists</small>   
                                </span>
                                    
                            </label>

                            {{-- <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username" />
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                            </label> --}}

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrpassword" name="usrpassword" type="password" class="form-control" placeholder="Password" />
                                    <i class="ace-icon fa fa-lock"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrrepassword" name="usrrepassword" type="password" class="form-control" placeholder="Repeat password" />
                                    <i class="ace-icon fa fa-retweet"></i>
                                </span>
                                <span id="pass_err" class="invalid-feedback" role="alert" style="display: none">
                                    <small class="text-danger" >Passwords Don't Match</small>   
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <select class="chosen-select form-control" 
                                        id="usridentity_type" name="usridentity_type" placeholder="Identity Type" >
                                    </select>
                                        <i class="ace-icon fa fa-credit-card"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usridentity_number" name="usridentity_number" type="text" class="form-control" placeholder="Identity Number" />
                                    <i class="ace-icon fa fa-credit-card"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrphone" name="usrphone" type="text" class="form-control" placeholder="Phone" />
                                    <i class="ace-icon fa fa-mobile-phone"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrbirth_place" name="usrbirth_place" type="text" class="form-control" placeholder="Birth Place" />
                                    <i class="ace-icon fa fa-compass"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrbirth_date" name="usrbirth_date" type="date" class="form-control" placeholder="Birth Date" />
                                    <i class="ace-icon fa fa-calendar"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="usrnpwp" name="usrnpwp" type="text" class="form-control" placeholder="NPWP" />
                                    <i class="ace-icon fa fa-barcode"></i>
                                </span>
                            </label>

                        </fieldset>
                    </div>
                    <div class="col-xs-6">
                        <p><strong> Enter your company details : </strong></p>

                        <fieldset>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compname" name="compname" type="text" class="form-control" placeholder="Company Name" name="compname" required autocomplete="compname"/>
                                     <i class="ace-icon fa fa-building-o"></i>
                                </span>
                                @if ($errors->has('compname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('compname') }}</strong>
                                    </span>
                                @endif
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <select class="chosen-select form-control" 
                                        id="comptype" name="comptype" type="text" placeholder="Company Type" />
                                    <i class="ace-icon fa fa-user"></i>
                                    </select>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compnpwp" name="compnpwp" type="text" class="form-control" placeholder="NPWP" />
                                    <i class="ace-icon fa fa-barcode"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compaddress" name="compaddress" type="text" class="form-control" placeholder="Address" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    {{-- <input id="compprov" name="compprov" type="text" class="form-control" placeholder="Provinsi" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                     --}}
                                    <select class="chosen-select form-control" 
                                        id="compprov" name="compprov" placeholder="Provinsi" />
                                    </select>
                                    <i class="ace-icon fa fa-user"></i>
                                </span>

                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    {{-- <input id="compkota" name="compkota" type="text" class="form-control" placeholder="Kota/Kabupaten" />
                                    <i class="ace-icon fa fa-street-view"></i> --}}
                                    <select class="chosen-select form-control" 
                                        id="compkota" name="compkota" placeholder="Kota/Kabupaten" />
                                        <option value="" disabled selected>Kota/Kabupaten</option>

                                    </select>
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    {{-- <input id="compkec" name="compkec" type="text" class="form-control" placeholder="Kecamatan" />
                                    <i class="ace-icon fa fa-street-view"></i> --}}
                                    <select class="chosen-select form-control" 
                                        id="compkec" name="compkec" placeholder="Kecamatan" />
                                        <option value="" disabled selected>Kecamatan</option>
                                    </select>
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                            </label>

                            {{-- <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Kelurahan" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label> --}}

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    {{-- <input id="comppos" name="comppos" type="text" class="form-control" placeholder="Kode Pos" />
                                    <i class="ace-icon fa fa-archive"></i> --}}
                                    <select class="chosen-select form-control" 
                                        id="comppos" name="comppos" placeholder="Kode Pos" />
                                        <option value="" disabled selected>Kode Pos</option>
                                    </select>
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compphone" name="compphone" type="text" class="form-control" placeholder="Phone" />
                                    <i class="ace-icon fa fa-phone-square"></i>
                                </span>
                            </label>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compemail" name="compemail" type="email" class="form-control{{ $errors->has('compemail') ? ' is-invalid' : '' }}" placeholder="Company Email" name="compemail" value="{{ old('email') }}" required autocomplete="email"/>
                                    <i class="ace-icon fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('compemail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('compemail') }}</strong>
                                    </span>
                                @endif

                                <span id="email_err_com" class="invalid-feedback" role="alert" style="display: none">
                                    <small class="text-danger" > Email Exists</small>   
                                </span>
                            </label>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compfax" name="compfax" type="text" class="form-control" placeholder="Company Fax" />
                                    <i class="ace-icon fa fa-fax"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compweb" name="compweb" type="text" class="form-control" placeholder="Company Web" />
                                    <i class="ace-icon fa fa-globe"></i>
                                </span>
                            </label>
                        </fieldset>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <label class="block">
                            <input type="checkbox" class="ace" />
                            <span class="lbl">
                                I accept the
                                <a href="#">User Agreement</a>
                            </span>
                        </label>

                        <div class="space-24"></div>

                        <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="ace-icon fa fa-refresh"></i>
                                <span class="bigger-110">Reset</span>
                            </button>

                            <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                <span class="bigger-110">Register</span>

                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="space-6"></div>
                    

                <div class="space-6"></div>
                
            </form>
        </div>



        <div class="toolbar center">
            <a href="#" data-target="#login-box" class="back-to-login-link">
                <i class="ace-icon fa fa-arrow-left"></i>
                Back to login
            </a>
        </div>
    </div><!-- /.widget-body -->
</div>

<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#comptype').select2({
            placeholder: 'Company Type',
            ajax: {
                url: "{{ route('searchcompanypub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (com) {
                            return {
                            text: com.coytypehdr_name,
                            id: com.coytypehdr_id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#usridentity_type').select2({
            placeholder: 'Identity Type',
            ajax: {
                url: "{{ route('searchIdentitypub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (com) {
                            return {
                            text: com.typeid_name,
                            id: com.typeid_id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $('#compprov').select2({
            placeholder: 'Provinsi',
            ajax: {
                url: "{{ route('searchprovincepub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (prov) {
                            return {
                            text: prov.prov_name,
                            id: prov.prov_id
                            }
                        })
                    };
                },
                cache: true
            }
        });

        $( "#compprov" ).change(function() {
            setKota()
        });

        $( "#compkota" ).change(function() {
            setKecamatan()
        });

        $( "#compkec" ).change(function() {
            setKodePost();
        });

        $("#usremail").blur(function() {
            checkEmail();
        });
        
        $("#compemail").blur(function() {
            checkEmailCom();
        });

        $("#usrrepassword").blur(function() {
            checkPassword();
        });

        $( `#formRegist` ).submit(function() {
            submitFunction();
        });

    });    

    function setKota(){
        $('#compkota').select2({
            placeholder: 'Kota/Kabupaten',
            ajax: {
                url: "{{ route('searchdistrictpub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                        prov: $('#compprov').val(),
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (dis) {
                            return {
                            text: dis.dis_name,
                            id: dis.dis_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

    function setKecamatan(){
        $('#compkec').select2({
            placeholder: 'Kota/Kabupaten',
            ajax: {
                url: "{{ route('searchsubdistrictpub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                        prov: $('#compprov').val(),
                        dis: $('#compkota').val(),
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (subdis) {
                            return {
                            text: subdis.subdis_name,
                            id: subdis.subdis_id
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

    function setKodePost(){
        $('#comppos').select2({
            placeholder: 'Kode Post',
            ajax: {
                url: "{{ route('searchZipPub') }}",
                dataType: 'json',
                type: 'POST',
                data: function (params, page){
                    return{
                        name: params.term,
                        subdis: $('#compkec').val(),
                    }
                },
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (zip) {
                            return {
                            text: zip.zipcode,
                            id: zip.zipcode
                            }
                        })
                    };
                },
                cache: true
            }
        });
    }

    // function checkEmail(){
    //     if($("#usremail").val() != ""){
    //         $.ajax({
    //             data: {
    //                 email: $("#usremail").val(),
    //             },
    //             url: "{{ route('emailcheckerPub') }}",
    //             type: "POST",
    //             dataType: 'json',
    //             success: function (data) {
    //                 if(!data.success){
    //                     $( "#email_err" ).show();
    //                     $("#usremail").val('')
    //                 } else {
    //                     $( "#email_err" ).hide();
    //                 }
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //                 $(`#saveBtn${module}`).html('Save');
    //                 $(`#saveBtn${module}`).removeAttr("disabled");

    //             }
    //         });   
    //     }
    // }

    function checkEmailCom(){
        if($("#usremail").val() != ""){
            $.ajax({
                data: {
                    email: $("#usremail").val(),
                },
                url: "{{ route('emailcheckerPub') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(!data.success){
                        $( "#email_err" ).show();
                        $("#usremail").val('')
                    } else {
                        $( "#email_err" ).hide();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    $(`#saveBtn${module}`).html('Save');
                    $(`#saveBtn${module}`).removeAttr("disabled");

                }
            });   
        }
    }

    function checkPassword(){
        if( $("#usrpassword").val() !=  $("#usrrepassword").val()){            
            $("#usrrepassword").val("")
            $('#pass_err').show()
        } else{
            $('#pass_err').hide()
        }
    }

    function submitFunction(){
        $.ajax({
            data:  $("#formRegist").serialize(),
            url: "{{ route('registerPub') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                alert("Register Berhasil");
                location.reload();
            },
            error: function (data) {
                console.log('Error:', data);
                // $(`#saveBtn${module}`).html('Save');
                // $(`#saveBtn${module}`).removeAttr("disabled");

            }
        }); 
        
    }
    
</script>