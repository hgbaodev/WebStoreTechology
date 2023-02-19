<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/category.php'; ?>
<?php include '../classes/brand.php'; ?>
<?php include '../classes/product.php'; ?>

<?php
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
} else {
    echo "<script>window.location = 'productlist.php'</script>";
}
$pd = new product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $updatetProduct = $pd->update_product($_POST, $_FILES, $productId);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
            <?php
            if (isset($updatetProduct)) {
                echo $updatetProduct;
            }
            ?>
            <?php
            $get_product = $pd->getproductbyid($productId);
            if($get_product){
                while($product = $get_product->fetch_assoc()){


            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input value="<?=$product['productName']?>" type="text" placeholder="Enter Product Name..." class="medium" name="productName" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="category">
                                <option>-----Select Category-----</option>
                                <?php
                                $category = new category();
                                $categoryList = $category->show_category();
                                if (isset($categoryList)) {
                                    while ($result = $categoryList->fetch_assoc()) {


                                ?>
                                        <option <?php if($result['catId']==$product['catId']) echo "selected" ?> value="<?= $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brand">
                                <option>-----Select Brand-----</option>
                                <?php
                                $brand = new brand();
                                $brandList = $brand->show_brand();
                                if (isset($brandList)) {
                                    while ($result = $brandList->fetch_assoc()) {

                                ?>
                                        <option <?php if($result['brandId']==$product['brandId']) echo "selected" ?> value="<?= $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="product_desc"> <?php echo $product['product_desc']?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input value="<?php echo $product['price']?>" name="price" type="text" placeholder="Enter Price..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <br>
                        <td>
							<img src="uploads/<?php echo $product['image'] ?>" alt="<?php echo $product['productName'] ?>" width="80">
                            </br>
                            <input name="image" type="file" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                if($product['type']==1){
                                    
                                ?>
                                <option selected value="1">Featured</option>
                                <option value="0">Non-Featured</option>
                                <?php
                                } else {

                                    ?>
                                <option value="1">Featured</option>
                                <option selected value="0">Non-Featured</option>
                                <?php
                            }   

                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php'; ?>