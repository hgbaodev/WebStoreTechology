<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');

$db = new Database();
$email = $_GET['email'];
$address = $_GET['address'];
$phone = $_GET['phone'];
$name = $_GET['name'];
if(isset($email)){
    $sql = "UPDATE `tbl_customer` SET `name`='$name',`address`='$address',`phone`='$phone' WHERE email = '$email'";
    $check = $db->update($sql);
    if($check){
        $alert = "Thay đổi thông tin thành công";
        echo $alert;
    } else {
        echo "Thay đổi không thành công";
    }
}