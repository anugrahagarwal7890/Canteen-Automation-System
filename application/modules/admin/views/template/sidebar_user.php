<?php
$tab = isset($tab) ? $tab : "";
$page = isset($page) ? $page : "";

$dashboard=$materials ="";
$user_management = $users=$feedback=$year= "";
$cart_management=$cart=$today_cart=$cart_with_payment="";
$gallery="";
if ($tab=='dashboard')
{
	$dashboard = "active";
}else if($tab=='user management')
{
	$user_management = "active";
	if ($page == "users")
	{
		$users = "active";
	}else if ($page=='year')
	{
		$year="active";
	}
	elseif ($page=='today_cart')
	{
		$today_cart="active";
	}
}else if($tab=='cart_management')
{
	$cart_management="active";
	if ($page=='cart')
	{
		$cart='active';
	}
	elseif ($page=='today_cart')
	{
		$today_cart="active";
	}elseif ($page=='cart_with_payment')
	{
		$cart_with_payment="active";
	}
}else if($tab=='food')
{
	$materials="active";
}else if($tab=='feedback')
{
	$feedback="active";
}else if($tab=='gallery')
{
	$gallery="active";
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
			<li class="header">MAIN NAVIGATION</li>
			<li class="<?=$dashboard ?>">
				<a href="<?= ANUGRAH_URL . "dashboard/index" ?>">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>
			<li class="treeview <?= $user_management ?>">
				<a href="#">
					<i class="fa fa-user-circle-o"></i> <span>User Management</span>
					<span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= $users ?>"><a href="<?= ANUGRAH_URL . 'users/index' ?>"><i class="fa fa-circle-o"></i> Customer Details</a></li>
					<li class="<?= $year ?>"><a href="<?= ANUGRAH_URL . 'users/year' ?>"><i class="fa fa-circle-o"></i>Year</a></li>
				</ul>
			</li>

			<li class="<?=$materials?>">
				<a href="<?= ANUGRAH_URL . "food/index" ?>">
					<i class="fa fa-user-o"></i> <span>Materials</span>
				</a>
			</li>

			<li class="treeview <?= $cart_management ?>">
				<a href="#">
					<i class="fa fa-user-circle-o"></i> <span>Cart</span>
					<span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= $today_cart ?>"><a href="<?= ANUGRAH_URL . 'cart/today_cart' ?>"><i class="fa fa-circle-o"></i>Today Confirm Orders</a></li>
					<li class="<?= $cart_with_payment ?>"><a href="<?= ANUGRAH_URL . 'cart/cart_with_payment' ?>"><i class="fa fa-circle-o"></i>Confirm Order</a></li>
					<li class="<?= $cart ?>"><a href="<?= ANUGRAH_URL . 'cart/index' ?>"><i class="fa fa-circle-o"></i>Without Confirm Order</a></li>
				</ul>
			</li>

			<li class="<?=$feedback?>">
				<a href="<?= ANUGRAH_URL . "feedback/index" ?>">
					<i class="fa fa-user-o"></i> <span>Feedback</span>
				</a>
			</li>
			<li class="<?=$gallery?>">
				<a href="<?= ANUGRAH_URL . "gallery/index" ?>">
					<i class="fa fa-user-o"></i> <span>Gallery</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
