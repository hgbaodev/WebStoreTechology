<?php
include_once 'lib/session.php';
Session::init();
?>

<?php
include_once 'lib/database.php';
include_once 'helper/format.php';
spl_autoload_register(function ($class) {
	include_once "classes/" . $class . ".php";
});
$db = new Database();
$fm = new Format();
$ct = new cart();
$us = new user();
$cat = new category();
$cs = new customer();
$product = new product();
?>

<?php
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
	<title>Web php</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="css/menu.css" rel="stylesheet" type="text/css" media="all" />
	<script src="js/jquerymain.js"></script>
	<script src="js/script.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<script type="text/javascript" src="js/nav.js"></script>
	<script type="text/javascript" src="js/move-top.js"></script>
	<script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/nav-hover.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
	<script type="text/javascript">
		$(document).ready(function($) {
			$('#dc_mega-menu-orange').dcMegaMenu({
				rowItems: '4',
				speed: 'fast',
				effect: 'fade'
			});
		});
	</script>
</head>

<body>
	<?php
	$id = Session::get('customer_id');
	?>
	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
				<div class="search_box">
					<form>
						<input type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input type="submit" value="SEARCH">
					</form>
				</div>
				<div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
							<span class="cart_title">Cart</span>
							<span class="no_product">
								<?php
								$check = $ct->check_cart();
								if ($check) {
									$sum = Session::get("sum");
									echo $sum . " VND | ";
									echo Session::get("qty");
								} else {
									echo "empty";
								}
								?>
							</span>
						</a>
					</div>
				</div>
				<?php
				$checkOut = $_GET['customer_id'];
				if(isset($checkOut)){
					$ct->delele_cart_s();
					Session::destroy();
				}
				?>

				<?php
				$checkLogin = Session::get("customer_login");
				if ($checkLogin == true) {
				?>
					<div class="login" id="logout"><a href="?customer_id=<?=Session::get("customer_id")?>">Logout</a></div>
				<?php
				} else {
				?>
					<div class="login"><a href="login.php">Login</a></div>
				<?php
					
				}
				?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="menu">
			<ul id="dc_mega-menu-orange" class="dc_mm-orange">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Products</a> </li>
				<li><a href="topbrands.php">Top Brands</a></li>
				<li><a href="cart.php">Cart</a></li>
				<li><a href="contact.php">Contact</a> </li>
				<li><a href="order.php">Order</a></li>
				<li><a href="profile.php<?php 
				if($id!=""){
					echo "?profileId=$id";
				}
				 ?>">Profile</a></li>
				<div class="clear"></div>
			</ul>
		</div>
<script type="text/javascript">

</script>
