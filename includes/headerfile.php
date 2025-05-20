<div id="header" class="app-header">
    <!-- BEGIN desktop-toggler -->
    <div class="desktop-toggler">
        <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-collapsed" data-dismiss-class="app-sidebar-toggled" data-toggle-target=".app">
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <!-- END desktop-toggler -->

    <!-- BEGIN mobile-toggler -->
    <div class="mobile-toggler">
        <button type="button" class="menu-toggler" data-toggle-class="app-sidebar-mobile-toggled" data-toggle-target=".app">
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
    </div>
    <!-- END mobile-toggler -->

    <!-- BEGIN brand -->
    <div class="brand">
        <a href="index-2.html" class="brand-logo w-100">
            <iconify-icon icon="lets-icons:time-progress-duotone" class="fs-24px me-2 text-theme"></iconify-icon>
            <span class="brand-text fw-500 fs-14px">Admin</span>
        </a>
    </div>
    <!-- END brand -->

    <!-- BEGIN menu -->
    <div class="menu">
        <div class="menu-item dropdown dropdown-mobile-full">
            <a href="#" data-bs-toggle="dropdown" data-bs-display="static" class="menu-link d-flex align-items-center">
                <div class="menu-img online me-sm-2 ms-lg-0 ms-n2">
                    <img src="assets/img/user/profile.jpg" alt="Profile" class="" />
                </div>
                <div class="menu-text d-sm-block d-none">
                    <span class="d-block"><span><span class="__cf_email__" data-cfemail="5a0f091f08141b171f1a1d171b131674191517">[email&#160;protected]</span></span></span>
                </div>
            </a>
            <div class="dropdown-menu dropdown-menu-end me-lg-3 fs-10px fade">
                <h6 class="dropdown-header">USER OPTIONS</h6>
                <!--<a class="dropdown-item" href="Update-Password">Update Password</a>-->
                <a class="dropdown-item" href="Logout">LOG OUT</a>
            </div>
        </div>
    </div>
    <!-- END menu -->

    <!-- BEGIN menu-search-float -->
    <form class="menu-search-float" method="POST" name="header_search_form">
        <div class="menu-search-container">
            <div class="menu-search-icon"><i class="bi bi-search"></i></div>
            <div class="menu-search-input">
                <input type="text" class="form-control" placeholder="Search something..." />
            </div>
            <div class="menu-search-icon">
                <a href="#" data-toggle-class="app-header-menu-search-toggled" data-toggle-target=".app"><i class="bi bi-x-lg"></i></a>
            </div>
        </div>
    </form>
    <!-- END menu-search-float -->
</div>