<li class="">
    <a href="{{url('/home')}}">
        <i class="menu-icon fa fa-tachometer"></i>
        <span class="menu-text"> Dashboard </span>
    </a>

    <b class="arrow"></b>
</li>
@if (Auth::user()->user_type == '1')

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

            <li class="">
                <a href="{{route('mortalita.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Setup Mortalita
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="{{route('benefit.index')}}">
                    <i class="menu-icon fa fa-caret-right"></i>
                    Setup Benefit
                </a>

                <b class="arrow"></b>
            </li>
        </ul>
    </li>
@endif

<li class="">
    <a href="#" class="dropdown-toggle">
        <i class="menu-icon fa fa-money"></i>
        <span class="menu-text"> Transaction </span>

        <b class="arrow fa fa-angle-down"></b>
    </a>

    <b class="arrow"></b>

    <ul class="submenu">

        @if (Auth::user()->user_type == '1')

        <li class="">
            <a href="{{route('agent.index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Register Agent
            </a>

            <b class="arrow"></b>
        </li>
        @endif

        @if (Auth::user()->user_type == '1' || Auth::user()->user_type == '3')
        <li class="">
            <a href="{{route('order.index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Order / SPK
            </a>

            <b class="arrow"></b>
        </li>
        @endif

        @if (Auth::user()->user_type == '1')
        <li class="">
            <a href="{{route('vbayar.index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Verifikasi Pembayaran
            </a>

            <b class="arrow"></b>
        </li>
        @endif

        @if (Auth::user()->user_type == '1' || Auth::user()->user_type == '2')
        <li class="">
            <a href="{{route('perhitungan.index')}}">
                <i class="menu-icon fa fa-caret-right"></i>
                Perhitungan
            </a>

            <b class="arrow"></b>
        </li>
        @endif
        
    </ul>
</li>