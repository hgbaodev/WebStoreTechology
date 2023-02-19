<?php
include 'include/header.php';
// include 'include/slider.php'
?>
<?php
if (isset($_GET['catId'])) {
	$catId = $_GET['catId'];
} else {
	echo "<script>window.location = '404.php'</script>";
}
?>

<div class="main">
	<div class="content">
		<div class="content_top">
			<div class="heading">
				<?php
				if (isset($catId)) {
					$getName = $cat->getcatbyid($catId);
					if (isset($getName)) {
						while ($name = $getName->fetch_assoc()) {

				?>
							<h3>Catefory:<?= $name['catName'] ?> </h3>
				<?php
						}
					} else {
						echo "<script>window.location = '404.php'</script>";
					}
				}
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="section group">
			<?php
			if (isset($catId)) {
				$getProductCat = $product->getCatgoryId($catId);
				if ($getProductCat) {
					while ($result = $getProductCat->fetch_assoc()) {

			?>
						<div class="grid_1_of_4 images_1_of_4">
							<a href="details.php?productId=<?=$result['productId']?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" /></a>
							<h2><?=$result['productName']?></h2>
							<p><?=$result['product_desc']?></p>
							<p><span class="price"><?php echo $result['price']." VND" ?></span></p>
							<div class="button"><span><a href="details.php?productId=<?=$result['productId']?>" class="details">Details</a></span></div>
						</div>

			<?php
					}
				}
			}
			?>

		</div>



	</div>
</div>
<?php
include 'include/footer.php';
?>