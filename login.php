<?php
	include 'include/header.php';
	// include 'include/slider.php'
?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insetcustomer = $cs->insert_customer($_POST);
    }
?>


<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $logincustomer = $cs->login_customer($_POST);
    }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php
			if(isset($logincustomer)){
				echo $logincustomer;
			}
			?>
        	<form action="" method="post">
                	<input name="email" type="text" placeholder="Username">
                    <input name="password" type="password" placeholder="Password">
					<p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <input type="submit" name="login" value="Sign in">
				</form>
				</div>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
			if(isset($insetcustomer)){
				echo $insetcustomer;
			}
			?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
							<div>
							<input type="text" name="name" placeholder="Enter name" >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter city">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter zipcode">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter email">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter address">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="Hà Nội">Hà Nội</option>         
							<option value="Hồ Chí Minh">Hồ Chí Minh</option>         
							<option value="Bình Đinh">Bình Đinh</option>         
							<option value="Đà Lạt">Đà Lạt</option>         
							
		         </select>
				 </div>		        
		           <div>
		          <input type="text" name="phone" placeholder="Enter phone">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter password">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

 <?php
	include 'include/footer.php';
?>
