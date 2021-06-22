@php use App\Helper\MyHelper; @endphp
<div class="navbar-custom">
    <div class="container-fluid ">
        <ul class="list-unstyled topnav-menu float-right mb-0">
            <li class="pt-2 ">
                <div class='time-frame' id = "time-frame">
                    <div id='date-part'></div>
                    <div id='time-part' style="font-size: 16px"></div>
                </div>
            </li>
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{asset('assets/images/app_thumbnail.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                        {{  MyHelper::decrypt(Session::get('FullName')) }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item notify-item" href="{{ URL::to('/logout') }}" id="btn_logout" >
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>


        </ul>


        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <!-- LOGO -->
                <div class="app-logo pl-2" style="width: 165px">
                    <a href="{{ env('MYHUB_URL') }}" class="logo logo-light text-left">
                        <img src="{{asset('assets/images/myhub-logo-white.png')}}" alt="MyHub Logo" height="60">
                    </a>

                </div>
            </li>
            <li>
                <div>
                    <h3 class="text-light pt-2 pl-2"><span>{{ env('APP_NAME') }}<span></h3>
               </div>
            </li>

        </ul>


    </div>
</div>
