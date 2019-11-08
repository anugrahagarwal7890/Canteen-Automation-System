<?php
$tab = isset($tab) ? $tab : "";
$page = isset($page) ? $page : "";

$dashboard="";
$user_management="";
$users="";
if ($tab=='dashboard')
{
    $dashboard = "active";
}else if($tab=='user management')
{
    $user_management = "active";
    if ($page == "users")
    {
        $users = "active";
    }
}

?>

<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" style="margin-top: auto">
            <div class="pull-left image">
                <img src="<?= ANUGRAH_ASSESTS ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$this->session->userdata("active_admin_data")['name']?></p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">ABACUS NAVIGATION</li>
            <li class="<?=$dashboard ?>">
                <a href="<?= ANUGRAH_URL . "dashboard/index" ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview <?= $user_management ?>">
                <a href="#">
                    <i class="fa fa-user"></i> <span>User Management</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?= $users ?>"><a href="<?= ANUGRAH_URL . 'users/index' ?>"><i class="fa fa-users"></i>Student Details</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
