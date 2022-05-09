<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8" />
        <title>CyberBeet</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- App favicon -->
        <link href="{{ asset('plugins/images/favicon.ico') }}"  rel="shortcut icon" />

        <!--Morris Chart-->
        {{-- <link href="{{ asset('plugins/libs/morris-js/morris.css') }}" rel="stylesheet" /> --}}

        <!-- App css -->
        <link href="{{ asset('plugins/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="slimscroll-menu">

                    <!-- User box -->
                    <div class="user-box text-center">
                        <p class="text-muted">Cyber Beet</p>
                        <ul class="list-inline">
                        </ul>
                    </div>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul class="metismenu" id="side-menu">

                            <li class="menu-title">Navigation</li>

                            <li>
                                <router-link tag="a" to="/">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Dashboard </span>
                                </router-link>
                            </li>

                            <li>
                                <router-link tag="a" to="/task">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Task </span>
                                </router-link>
                            </li>

                            <li>
                                <router-link tag="a" to="/project">
                                    <i class="mdi mdi-view-dashboard"></i>
                                    <span> Project </span>
                                </router-link>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">
                        <router-view></router-view>
                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                               2022 &copy; CyberBeet <a href="#"></a>
                            </div>
                            <div class="col-md-6">
                                <div class="text-md-right footer-links d-none d-sm-block">
                                    <a href="javascript:void(0);">About Us</a>
                                    <a href="javascript:void(0);">Help</a>
                                    <a href="javascript:void(0);">Contact Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        <!-- Vendor js -->
		<script src="{{ asset('plugins/js/vendor.min.js') }}"></script>

        <!-- knob plugin -->
		<script src="{{ asset('plugins/libs/jquery-knob/jquery.knob.min.js') }}"></script>

        <!--Morris Chart-->
		{{-- <script src="{{ asset('plugins/libs/morris-js/morris.min.js') }}"></script>
		<script src="{{ asset('plugins/libs/raphael/raphael.min.js') }}"></script> --}}

        <!-- Dashboard init js-->
		<script src="{{ asset('plugins/js/pages/dashboard.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('plugins/js/app.min.js') }}"></script>

		<script src="/js/app.js"></script>

    </body>

</html>
