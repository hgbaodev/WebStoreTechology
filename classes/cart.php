<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($quantity, $productId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $sId = session_id();

        $query = "select * from tbl_product where productId = '$productId'";
        $result = $this->db->select($query)->fetch_assoc();

        $image = $result['image'];
        $price = $result['price'];
        $productName = $result['productName'];

        $check_cart = $this->db->select("select * from tbl_cart where productId = '$productId' and sId = '$sId'");
        if($check_cart){
            $mgs = "Product already added";
            return $mgs;
        } else {
            $query = "insert into tbl_cart(productId,quantity,sId,image,price,productName) values('$productId','$quantity','$sId','$image','$price','$productName')";
            $query_insert = $this->db->insert($query);
            if ($query_insert) {
                header("Location: cart.php");
            } else {
                header("Location: 404.php");
            }
        }
    }

    public function show_cart(){
        $sId = session_id();
        $query = "select * from tbl_cart where sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function update_quantity_cart($quantity,$cartId){
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $query = "update tbl_cart set quantity = '$quantity' where cartId = '$cartId'";
        $result = $this->db->update($query);
        if($result){
            header("Location:cart.php");
        } else {
            header("Location:cart.php");
        }
    }

    public function del_cart($cartid){
        $query = "delete from tbl_cart where cartId = '$cartid'";
        $result = $this->db->delete($query);
        if($result){
            header("Location:cart.php");
        } 
    }

    public function check_cart(){
        $sId = session_id();
        $query = "Select * from tbl_cart where sId = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delele_cart_s(){
        $sId = session_id();
        $query = "delete from tbl_cart where sId = '$sId'";
        $result = $this->db->delete($query);
    }

    public function insertOrder($customerId){
        $sId = session_id();
        $query = "Select * from tbl_cart where sId = '$sId'";
        $result = $this->db->select($query);
        if($result){
            while($listorder = $result->fetch_assoc()){
                $productId = $listorder['productId'];
                $productName = $listorder['productName'];
                $quantity = $listorder['quantity'];
                $image = $listorder['image'];
                $price = $quantity * $listorder['price'];
                $sql = "INSERT INTO `tbl_order`( `productId`, `productName`, `customer_id`, `quantity`, `image`, `price`) VALUES ('$productId','$productName','$customerId','$quantity','$image','$price')";
                $check = $this->db->insert($sql);
            }
            if($check){
                $query = "delete from tbl_cart where sId = '$sId'";
                $del = $this->db->delete($query);
                return "Insert order successfully!";
            }
            
        } else {
            return "Cart empty";
        }
    }
}
?>