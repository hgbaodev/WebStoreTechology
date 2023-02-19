<?php
	include 'include/header.php';
	// include 'include/slider.php'
?>

<?php
    $checkLogin = Session::get("customer_id");
    if($checkLogin != true){
        header("Location: index.php");
    }
?>

 <div class="main">
    <div class="content">
    	<h3>Order</h3>	
        <div class="container">
            <div class="d-flex justify-content-center">
                <a href="offlinepayment.php"><button>Offline payment</button></a>
                <a href="onlinepayment.php"><button>Online payment</button></a>
            </div>
        </div>
    </div>
 </div>

 <?php
	include 'include/footer.php';
?>

