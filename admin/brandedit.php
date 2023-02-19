<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php'?>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

$brand = new brand();


if(isset($_GET['brandId'])){
    $brandId = $_GET['brandId'];
} else {
    echo "<script>window.location = 'brandlist.php'</script>";
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $brandName = $_POST['brandName'];
    $updateBrand = $brand->update_brand($brandName,$brandId);
}

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
                    
                <div class="block copyblock"> 
                <?php
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php
                    $get_brand_name = $brand->getbrandbyid($brandId);
                    if($get_brand_name){
                        while($result = $get_brand_name->fetch_assoc()){

                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" placeholder="Sửa thương hiệu sản phẩm" class="medium" name="brandName" value="<?=$result['brandName']?>" />
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