<?php
include 'include/header.php';
// include 'include/slider.php'
?>

<?php
if (isset($_GET['productId'])) {
	$productId = $_GET['productId'];
} else {
	echo "<script>window.location = '404.php'</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	$quantity = $_POST['quantity'];
	$AddtoCard = $ct->add_to_cart($quantity, $productId);
}
?>

<div class="main">
	<div class="content">
		<div class="section group">
			<?php
			$get_product_detail = $product->getproduct_detail($productId);
			($get_product_detail);
			if ($get_product_detail) {
				while ($result_detail = $get_product_detail->fetch_assoc()) {

			?>
					<div class="cont-desc span_1_of_2">

						<div class="grid images_3_of_2">
							<img src="admin/uploads/<?php echo $result_detail['image'] ?>" alt="" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result_detail['productName'] ?></h2>
							<p><?php echo $result_detail['product_desc'] ?></p>
							<div class="price">
								<p>Price: <span><?php echo $result_detail['price'] . " VND" ?></span></p>
								<p>Category: <span><?php echo $result_detail['catName'] ?></span></p>
								<p>Brand:<span><?php echo $result_detail['brandName'] ?></span></p>
							</div>
							<div class="">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1" />
									<input type="submit" class="buysubmit" name="submit" value="Buy Now" />
								</form>
								<span style="color:red;font-size:18px;">
									<?php
									if (isset($AddtoCard)) {
										echo $AddtoCard;
									}
									?>
								</span>
							</div>
						</div>
				<?php
				}
			}
				?>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
				</div>

					</div>
					<div class="rightsidebar span_3_of_1">
						<h2>CATEGORIES</h2>
						<ul>
							<?php
							$show_category = $cat->show_category();
							if (isset($show_category)) {
								while ($result = $show_category->fetch_assoc()) {

							?>
									<li><a href="productbycat.php?catId=<?=$result['catId']?>"><?php echo $result['catName'] ?></a></li>
							<?php
								}
							}

							?>
						</ul>
					</div>
		</div>
	</div>
</div>

<?php
include 'include/footer.php';
?>