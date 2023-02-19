<?php
	include 'include/header.php';
	// include 'include/slider.php'
?>
<?php
if(isset($_GET['cartId'])){
	$cartid = $_GET['cartId'];
	$del_cart = $ct->del_cart($cartid);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
	$cartId = $_POST['cartId'];
	$quantity = $_POST['quantity'];
	if($quantity<=0){
		$del_cart = $ct->del_cart($cartId);
	}
	$update_quantity_cart = $ct->update_quantity_cart($quantity,$cartId);
}
?>

<?php
if(!$_GET['id']){
	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
					<?php
					if(isset($update_quantity_cart)){
						echo $update_quantity_cart;
					}
					?>
					<?php
					if(isset($del_cart)){
						echo $del_cart;
					}
					?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php
							$get_cart = $ct->show_cart();
							if($get_cart){
								$sub_total=0;
								$qty = 0;
								while($result = $get_cart->fetch_assoc()){
								$sub_total+=$result['quantity']*$result['price'];
								$qty += $result['quantity'];
							
							?>
							<tr>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $result['price']." VND" ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?=$result['cartId']?>"/>
										<input type="number" name="quantity" value="<?=$result['quantity']?>" min="0"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td><?php echo $result['quantity']*$result['price']." VND" ?></td>
								<td><a onclick="return confirm('You can delete <?=$result['cartId']?>')" href="?cartId=<?php echo $result['cartId'] ?>">Xóa</a></td>
							</tr>
						<?php
						}
					}
						?>
							
						</table>
						<table style="float:right;text-align:left;" width="40%">
							<?php
							$check = $ct->check_cart();
							if($check){

							?>
							<tr>
								<th>Sub Total : </th>
								<td><?php echo $sub_total." VND" ?></td>
								<?php
								Session::set("sum",$sub_total);
								Session::set("qty",$qty);
								?>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php echo $sub_total+$sub_total*0.1." VND"; ?></td>
							</tr>
					   </table>
					</div>
					<?php
							} else {
								echo "Cart Empty";
							}
					
					?>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="?customer_id=<?=Session::get("customer_id")?>"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'include/footer.php';
?>

