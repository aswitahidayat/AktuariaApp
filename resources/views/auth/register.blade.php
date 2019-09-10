<div id="signup-box" class="signup-box widget-box no-border" style="position: absolute; width: 600px; left: 0; right: 0; margin-left: auto; margin-right: auto; ">
    <div class="widget-body">
        <div class="widget-main">
            <h4 class="header green lighter bigger">
                <i class="ace-icon fa fa-users blue"></i>
                New Registration
            </h4>
            <form>
                <div class="row">
                    <div class="col-xs-6">
                        <p> <strong> Enter your personal details : </strong></p>
                        <fieldset>
                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email"/>
                                            <i class="ace-icon fa fa-envelope"></i>
                                        </span>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Username" />
                                            <i class="ace-icon fa fa-user"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Password" />
                                            <i class="ace-icon fa fa-lock"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="password" class="form-control" placeholder="Repeat password" />
                                            <i class="ace-icon fa fa-retweet"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Identity Type" />
                                            <i class="ace-icon fa fa-credit-card"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Identity Number" />
                                            <i class="ace-icon fa fa-credit-card"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Phone" />
                                            <i class="ace-icon fa fa-mobile-phone"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Birth Place" />
                                            <i class="ace-icon fa fa-compass"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="Birth Date" />
                                            <i class="ace-icon fa fa-calendar"></i>
                                        </span>
                            </label>

                            <label class="block clearfix">
                                        <span class="block input-icon input-icon-right">
                                            <input type="text" class="form-control" placeholder="NPWP" />
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
                                    <input id="compname" type="text" class="form-control{{ $errors->has('compname') ? ' is-invalid' : '' }}" placeholder="Company Name" name="compname" value="{{ old('compname') }}" required autocomplete="compname"/>
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
                                    <input type="text" class="form-control" placeholder="Company Type" />
                                    <i class="ace-icon fa fa-user"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="NPWP" />
                                    <i class="ace-icon fa fa-barcode"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Address" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Provinsi" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Kota/Kabupaten" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Kecamatan" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Kelurahan" />
                                    <i class="ace-icon fa fa-street-view"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Kode Pos" />
                                    <i class="ace-icon fa fa-archive"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Phone" />
                                    <i class="ace-icon fa fa-phone-square"></i>
                                </span>
                            </label>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input id="compemail" type="email" class="form-control{{ $errors->has('compemail') ? ' is-invalid' : '' }}" placeholder="Company Email" name="compemail" value="{{ old('email') }}" required autocomplete="email"/>
                                    <i class="ace-icon fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('compemail'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('compemail') }}</strong>
                                    </span>
                                @endif
                            </label>
                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Company Fax" />
                                    <i class="ace-icon fa fa-fax"></i>
                                </span>
                            </label>

                            <label class="block clearfix">
                                <span class="block input-icon input-icon-right">
                                    <input type="text" class="form-control" placeholder="Company Web" />
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

                            <button type="button" class="width-65 pull-right btn btn-sm btn-success">
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