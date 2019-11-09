<!-- Content Header (Page header) -->

<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3><?=$result['total_users']?></h3>
                    <p>Total Students</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="<?=ANUGRAH_URL."users"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-blue">
				<div class="inner">
					<h3><?=$result['total_food']?></h3>
					<p>Total Food Items</p>
				</div>
				<div class="icon">
					<i class="ion ion-android-favorite"></i>
				</div>
				<a href="<?=ANUGRAH_URL."food"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$result['not_confirm_cart']?></h3>
					<p>Payment Pending</p>
				</div>
				<div class="icon">
					<i class="ion ion-android-star"></i>
				</div>
				<a href="<?=ANUGRAH_URL."cart/index"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$result['confirm_cart']?></h3>
					<p>Total Orders</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<a href="<?=ANUGRAH_URL."cart/cart_with_payment"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$result['total_today_cart']?></h3>
					<p>Today Orders</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<a href="<?=ANUGRAH_URL."cart/today_cart"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$result['category']?></h3>
					<p>Food Category</p>
				</div>
				<div class="icon">
					<i class="ion ion-person"></i>
				</div>
				<a href="<?=ANUGRAH_URL."food/category"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
		<div class="col-lg-3 col-xs-6">
			<!-- small box -->
			<div class="small-box bg-aqua">
				<div class="inner">
					<h3><?=$result['feedback']?></h3>
					<p>Total Feedback</p>
				</div>
				<div class="icon">
					<i class="ion ion-feedback"></i>
				</div>
				<a href="<?=ANUGRAH_URL."feedback"?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
			</div>
		</div>
        <!-- ./col -->
<!--         ./col-->
    </div>
</section>
<!-- /.content -->
