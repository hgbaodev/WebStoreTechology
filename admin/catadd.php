﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

$cat = new category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$catName = $_POST['catName'];
	
    $result = $cat->insert_category($catName);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm danh mục</h2>
                    
                <div class="block copyblock"> 
                <?php
                    if(isset($result)){
                        echo $result;
                    }
                    ?>
                 <form action="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Làm ơn thêm danh mục sản phẩm" class="medium" name="catName"/>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>