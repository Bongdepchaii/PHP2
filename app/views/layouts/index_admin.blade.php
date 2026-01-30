<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="flexilecode" />
    <title>@yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="/assets/images/LogoTBS.png" />
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/vendors.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/vendors/css/daterangepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/assets/css/theme.min.css" />
    <!-- @stack('styles') -->
</head>

<body>
    @include('layouts.includes.slidebar_admin')
    @include('layouts.includes.header_admin')
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ page-header ] start -->
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Bảng điều khiển</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
                        <li class="breadcrumb-item">Bảng điều khiển</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Quay lại</span>
                            </a>
                        </div>
                        <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                            <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                                <span class="reportrange-picker-field"></span>
                            </div>
                            <div class="dropdown filter-dropdown">
                                <a class="btn btn-md btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                    data-bs-auto-close="outside">
                                    <i class="feather-filter me-2"></i>
                                    <span>Bộ lọc</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Role"
                                                checked="checked" />
                                            <label class="custom-control-label c-pointer" for="Role">Role</label>
                                        </div>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Team"
                                                checked="checked" />
                                            <label class="custom-control-label c-pointer" for="Team">Team</label>
                                        </div>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Email"
                                                checked="checked" />
                                            <label class="custom-control-label c-pointer" for="Email">Email</label>
                                        </div>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Member"
                                                checked="checked" />
                                            <label class="custom-control-label c-pointer" for="Member">Member</label>
                                        </div>
                                    </div>
                                    <div class="dropdown-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="Recommendation"
                                                checked="checked" />
                                            <label class="custom-control-label c-pointer"
                                                for="Recommendation">Recommendation</label>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather-plus me-3"></i>
                                        <span>Create New</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather-filter me-3"></i>
                                        <span>Manage Filter</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- [ page-header ] end -->
            <!-- [ Main Content ] start -->
            @yield('content')
            <!-- [ Main Content ] end -->
        </div>
        <!-- [ Footer ] start -->
        @include('layouts.includes.footer_admin')
        <!-- [ Footer ] end -->
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    @include('layouts.includes.setting_theme_admin')
    @stack('modals')
    <script src="/assets/vendors/js/vendors.min.js"></script>
    <script src="/assets/vendors/js/daterangepicker.min.js"></script>
    <script src="/assets/vendors/js/apexcharts.min.js"></script>
    <script src="/assets/vendors/js/circle-progress.min.js"></script>
    <script src="/assets/js/common-init.min.js"></script>
    <script src="/assets/js/dashboard-init.min.js"></script>
    <script src="/assets/js/theme-customizer-init.min.js"></script>
    @stack('scripts')
</body>

</html>