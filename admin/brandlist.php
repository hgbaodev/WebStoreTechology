<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../classes/brand.php' ?>

<?php
$cat = new brand();
if (isset($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $deleteCat = $cat->delete_brand($deleteId);
}

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <?php
            if (isset($deleteCat)) {
                echo $deleteCat;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_cate = $cat->show_brand();
                    if ($show_cate) {
                        $i = 0;
                        while ($result = $show_cate->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['brandName'] ?></td>
                                <td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick="return confirm('Are you want to delete')" href="?deleteId=<?php echo $result['brandId'] ?>">Delete</a></td>
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