<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Les moissons admin</title>


    <!-- Custom fonts for this template-->
    <link href="../assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/css/sb-admin-2.css" rel="stylesheet">


</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav  text-white sidebar sidebar-dark accordion" id="accordionSidebar" style="
    background-color: #000000;"
    >

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?=  BASE_PATH.'back/'; ?>">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Les Moiss' Admin </sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->


        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            gestion
        </div>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion pastille</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="dropdown-item" href="">Gestion Commande</a>
                </div>
            </div>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion caroussel</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion carte resto</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion formule</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion bar / cave</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion navigation</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed"   href=""   >

                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion evènements</span>
            </a>
        </li>


        <hr class="sidebar-divider">
        <li class="nav-item">
            <a class="nav-link collapsed" href=""  >
                <i class="fas fa-fw fa-wrench"></i>
                <span>Gestion newsletter</span>
            </a>
        </li>


        <hr class="sidebar-divider">



        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item ">
            <a class="nav-link collapsed" href="" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Gestion abonnés</span>
            </a>
<!--            <div id="collapsePages" class="collapse show" aria-labelledby="headingPages"-->
<!--                 data-parent="#accordionSidebar">-->
<!--                <div class="bg-white py-2 collapse-inner rounded">-->
<!--                    <h6 class="collapse-header">Login Screens:</h6>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_newsletter_new')}}">Gestion Newsletter</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_membre')}}">Gestion Membre</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_avis')}}">Gestion Avis</a>-->
<!--                    <a class="collapse-item" href="{{path('app_admin_crud_contact')}}">Gestion Contact</a>-->
<!--                    <div class="collapse-divider"></div>-->
<!--                    <h6 class="collapse-header">autres:</h6>-->
<!--                    <a class="collapse-item active" href="{{path('admin_crud_slider_new')}}">Gestion slider</a>-->
<!--                </div>-->
<!--            </div>-->
        </li>



        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="
    background-color: #000000;"
            >

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Search -->


                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link " href="<?=  BASE_PATH; ?>" role="button">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">Voir le site</span>
                            <img class="img-profile rounded-circle"
                                 src="">
                        </a>

                    </li>
                </ul>
            </nav>
            <!-- End of Topbar -->
            <div class="container col-3 ">

                <div class="alert  text-center">

                </div>


            </div>


            <div class="container-fluid">

                <?php if (isset($_SESSION['messages'])) :  ?>

                    <?php foreach ($_SESSION['messages'] as $type => $messages) : ?>
                        <?php foreach ($messages as $message) : ?>
                            <div class=" w-25 rounded  text-center ml-5  alert alert-<?= $type ?>"><h3><?= $message ?></h3></div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <?php unset($_SESSION['messages']); ?>
                <?php endif; ?>
                <!-- Page Heading -->









