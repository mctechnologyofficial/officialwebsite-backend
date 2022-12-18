<!-- Horizonatal menu-->
<div class="main-navbar hor-menu sticky">
    <div class="container">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}"><i class="ti-home"></i>Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link with-sub" href=""><i class="ti-wallet"></i>Users</a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{ route('admin.member.index') }}">Members</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!--End  Horizonatal menu-->
