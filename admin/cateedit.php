<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php'?>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

$cat = new category();


if(isset($_GET['catId'])){
    $cateId = $_GET['catId'];
} else {
    echo "<script>window.location = 'catlist.php'</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $catName = $_POST['catName'];
    $updateCat = $cat->update_category($catName,$cateId);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
                    
                <div class="block copyblock"> 
                <?php
                    if(isset($updateCat)){
                        echo $updateCat;
                    }
                ?>
                <?php
                    $get_cate_name = $cat->getcatbyid($cateId);
                    if($get_cate_name){
                        while($result = $get_cate_name->fetch_assoc()){

                      
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Sửa danh mục sản phẩm" class="medium" name="catName" value="<?=$result['catName']?>" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>

                    <?php 
                          }
                        }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>