<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>
<?php include_once '../helper/format.php'; ?>
<?php
$pd = new product();
$fm = new Format();
if(isset($_GET['productId'])){
	$productId = $_GET['productId'];
	$delproduct = $pd->delete_product($productId);
}
?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Post List</h2>
		<div class="block">
			<?php
			if(isset($delproduct)){
				echo $delproduct;
			}
			?>
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Product Name</th>
						<th>Product Price</th>
						<th>Product Image</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Type</th>
						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php

					$productList = $pd->show_product();
					if ($productList) {
						$i = 0;
						while ($result = $productList->fetch_assoc()) {
							$i++;
					?>
							<tr class="odd gradeX">
								<td><?php echo $i ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><?php echo $result['price'] ?></td>
								<td><img src="uploads/<?php echo $result['image'] ?>" alt="<?php echo $result['productName'] ?>" width="80"></td>
								<td class="center"><?php echo $result['catName'] ?></td>
								<td class="center"><?php echo $result['brandName'] ?></td>
								<td class="center"><?php echo $fm->textShorten($result['product_desc'],20) ?></td>
								<td class="center">
									<?php
									if ($result['type'] == 1) {
										echo "Feathred";
									} else {
										echo "Non Feathred";
									}
									?>
								</td>
								<td><a href="productedit.php?productId=<?=$result['productId']?>">Edit</a> || <a onclick="return confirm('You can delete <?=$result['productName']?>')" href="?productId=<?=$result['productId']?>">Delete</a></td>
							</tr>
					<?php
						}
					}
					?>

				</tbody>
			</table>

		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php'; ?>