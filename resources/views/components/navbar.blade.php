<!-- Horizonatal menu-->
<div class="main-navbar hor-menu sticky">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="ti-home"></i>Dashboard</a>
            </li>
            @role('admin')
                <li class="nav-item @if(request()->routeIs('admin.member.*') || request()->routeIs('admin.team.*') || request()->routeIs('admin.project.*')) active @endif">
                    <a class="nav-link with-sub" href=""><i class="ti-user"></i>Users</a>
                    <ul class="nav-sub">
                        <li class="nav-sub-item {{ request()->routeIs('admin.member.*') ? 'active' : '' }}">
                            <a class="nav-sub-link" href="{{ route('admin.member.index') }}">Members</a>
                        </li>
                        <li class="nav-sub-item {{ request()->routeIs('admin.team.*') ? 'active' : '' }}">
                            <a class="nav-sub-link" href="{{ route('admin.team.index') }}">Teams</a>
                        </li>
                        <li class="nav-sub-item {{ request()->routeIs('admin.project.*') ? 'active' : '' }}">
                            <a class="nav-sub-link" href="{{ route('admin.project.index') }}">Projects</a>
                        </li>
                    </ul>
                </li>
            @endrole
        </ul>
    </div>
</div>
<!--End  Horizonatal menu-->
