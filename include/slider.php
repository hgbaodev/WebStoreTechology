<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<div class="listview_1_of_2 images_1_of_2"">
					<?php
					$get_iphone = $product->get_iphone();
					if ($get_iphone) {
						while ($iphone = $get_iphone->fetch_assoc()) {
					?>
				<div class=" listimg listimg_2_of_1"">
				<a href="preview.html"> <img src="../admin/uploads/<?php echo $iphone['image'] ?>" alt="" /></a>
			</div>
			<div class="text list_2_of_1">
				<h2>Iphone</h2>
				<p><?php echo $iphone['product_desc'] ?></p>
				<div class="button"><span><a href="../details.php?productId=<?php echo $iphone['productId'] ?>">Add to cart</a></span></div>
		<?php
						}
					}
		?>
			</div>
		</div>
		<div class="listview_1_of_2 images_1_of_2"">
					<?php
					$get_dell = $product->get_dell();
					if ($get_dell) {
						while ($dell = $get_dell->fetch_assoc()) {
					?>
				<div class=" listimg listimg_2_of_1"">
				<a href="preview.html"> <img src="../admin/uploads/<?php echo $dell['image'] ?>" alt="" /></a>
			</div>
			<div class="text list_2_of_1">
				<h2>Dell</h2>
				<p><?php echo $dell['product_desc'] ?></p>
				<div class="button"><span><a href="../details.php?productId=<?php echo $dell['productId'] ?>">Add to cart</a></span></div>
		<?php
						}
					}
		?>
			</div>
		</div>
	</div>
	<div class="section group">
		<div class="listview_1_of_2 images_1_of_2">
			<?php
					$get_huwai = $product->get_huwai();
					if ($get_huwai) {
						while ($huwai = $get_huwai->fetch_assoc()) {
					?>
				<div class=" listimg listimg_2_of_1"">
				<a href="preview.html"> <img src="../admin/uploads/<?php echo $huwai['image'] ?>" alt="" /></a>
			</div>
			<div class="text list_2_of_1">
				<h2>huwai</h2>
				<p><?php echo $huwai['product_desc'] ?></p>
				<div class="button"><span><a href="../details.php?productId=<?php echo $huwai['productId'] ?>">Add to cart</a></span></div>
		<?php
						}
					}
		?>
			</div>
		</div>
		<div class="listview_1_of_2 images_1_of_2">
		<?php
					$get_asus = $product->get_asus();
					if ($get_asus) {
						while ($asus = $get_asus->fetch_assoc()) {
					?>
				<div class=" listimg listimg_2_of_1"">
				<a href="preview.html"> <img src="../admin/uploads/<?php echo $asus['image'] ?>" alt="" /></a>
			</div>
			<div class="text list_2_of_1">
				<h2>Asus</h2>
				<p><?php echo $asus['product_desc'] ?></p>
				<div class="button"><span><a href="../details.php?productId=<?php echo $asus['productId'] ?>">Add to cart</a></span></div>
		<?php
						}
					}
		?>
			</div>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div class="header_bottom_right_images">
	<!-- FlexSlider -->

	<section class="slider">
		<div class="flexslider">
			<ul class="slides">
				<li><img src="images/1.jpg" alt="" /></li>
				<li><img src="images/2.jpg" alt="" /></li>
				<li><img src="images/3.jpg" alt="" /></li>
				<li><img src="images/4.jpg" alt="" /></li>
			</ul>
		</div>
	</section>
	<!-- FlexSlider -->
</div>
<div class="clear"></div>
</div>