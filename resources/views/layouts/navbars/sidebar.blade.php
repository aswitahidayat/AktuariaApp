<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try{ace.settings.loadState('sidebar')}catch(e){}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div><!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="">
            <a href="{{url('/home')}}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-cogs"></i>
                <span class="menu-text">
					Data Master
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{url('usertype')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        <span class="menu-text">Setup User</span>
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('identity.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setup Identity
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('company.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setup Company
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('region.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setup Region
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('service.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setup Service
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('program.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Setup Program
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-money"></i>
                <span class="menu-text"> Transaction </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="">
                    <a href="{{route('agent.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Register Agent
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="{{route('order.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Order / SPK
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="{{route('vbayar.index')}}">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Verifikasi Pembayaran
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Perhitungan
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
