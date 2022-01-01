<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-black" style="position: fixed; height: 100vh;">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        <div class="m-3"></div>
        <a href="/home" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline ms-5"><img src="/images/face-mask.png" height="75px" width="75px"></span>
        </a>
        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
            <li class="nav-item m-2">
                <a href="/admin" class="nav-link align-middle px-0">
                    <i class="fa fa-fw fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="m-2">
                <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                    <i class="fa fa-fw fa-arrows-v"></i> Guidelines <i class="fa fa-fw fa-caret-down"></i> </a>
                <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="/admin/users" class="nav-link px-0 ms-4"> <span class="d-none d-sm-inline">View all users</span> </a>
                    </li>
                    <li>
                        <a href="/admin/users?source=add_user" class="nav-link px-0 ms-4"> <span class="d-none d-sm-inline">Add user</span></a>
                    </li>
                </ul>
            </li>

        </ul>
        <hr>
        <div class="dropdown pb-4">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                <span style="font-size: 36px"><i class="fa fa-user"></i></span>

                <span class="d-none d-sm-inline mx-1"><?php echo \app\core\App::$app->user->firstname ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser2">
                <li><a class="dropdown-item" href="/profile">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="/logout">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>