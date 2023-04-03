<ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
    @php
        $routeName = \Request::route()->getName();
    @endphp
    <li class="nav-item  @if($routeName == 'main_dashboard') active @endif">
        <a class="d-flex align-items-center" href="{{route('main_dashboard')}}">
            <i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span>
        </a>
    </li>
    <li class="navigation-header"><span>Master Menus</span></li>
    <li class="@if($routeName == 'real_estate.index' || $routeName == 'real_estate.create' || $routeName == 'real_estate.edit') active @endif nav-item">
        <a class="d-flex align-items-center" href="{{route('real_estate.index')}}">
            <i data-feather='layers'></i><span class="menu-item text-truncate" data-i18n="Collapsed Real Estate">Real Estate</span>
        </a>
    </li>
</ul>
