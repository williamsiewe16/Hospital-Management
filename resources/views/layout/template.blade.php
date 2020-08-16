<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="/assets/img/favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href ="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href ="/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href ="/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-datetimepicker.min.css">
    <!--[if lt IE 9]>
    <script src="/assets/js/html5shiv.min.js"></script>
    <script src="/assets/js/respond.min.js"></script>
    <![endif]-->
    @yield("title")
</head>
<body>
<div class="main-wrapper">

    <!--************************************* TopBar ************************************************************************************-->
    <div class="header" id="topbar">
        <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
        <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
        <div class="header-left">
            <a href="/machines" class="logo">
                <img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Hospital Management</span>
            </a>
        </div>

        <ul class="nav user-menu float-right">
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                    <span>Admin</span>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="/logout">Logout</a>
                </div>
            </li>
        </ul>
        <div class="dropdown mobile-user-menu float-right">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="/logout">Logout</a>
            </div>
        </div>
    </div>
    <!--************************************************************************************************************************************-->

    <!--************************************* SideBar ************************************************************************************-->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">Main</li>
                    <li class="active">
                        <a href="/machines"><i class="fa fa-cogs"></i> <span>Machines</span></a>
                    </li>
                    <li>
                        <a href="/maintainers"><i class="fa fa-user"></i> <span>Maintenanciers</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!--************************************************************************************************************************************-->


    <div class="page-wrapper">
        @yield("contenu")
        <!-- <div class="notification-box" replace="~{../templates/dashboard/fragments/notifications :: notifications}"></div> -->
    </div>

    <!-- DeleteModel -->
    <div id="deleteModal" class="modal fade delete-modal" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                @yield("deleteModalContent")
            </div>
        </div>
    </div>
    <!-- DeleteModel -->

</div>


   <script src= "/assets/js/jquery-3.2.1.min.js"></script>
   <script src="/assets/js/popper.min.js"></script>
   <script src="/assets/js/bootstrap.min.js"></script>
   <script src="/assets/js/jquery.slimscroll.js"></script>
   <script src="/assets/js/select2.min.js"></script>
   <script src="/assets/js/jquery.dataTables.min.js"></script>
   <script src="/assets/js/dataTables.bootstrap4.min.js"></script>
   <script src="/assets/js/moment.min.js"></script>
   <script src="/assets/js/bootstrap-datetimepicker.min.js"></script>
   <script src="/assets/js/app.js"></script>
   <script src="/assets/js/main.js"></script>
   <script src="/assets/js/sweetalert.min.js"></script>
</body>
</html>
