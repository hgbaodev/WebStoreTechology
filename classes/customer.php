<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helper/format.php');
?>

<?php
class customer
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insert_customer($data){
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
        $email = mysqli_real_escape_string($this->db->link, $data['address']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""){
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $check = "Select * from tbl_customer where email = '$email'";
            $checkEmail = $this->db->select($check);
            if($checkEmail){
                $alert = "<span class='error'>Email must be not exists database ! Places</span>";
                return $alert;
            } else {
                $query = "INSERT INTO `tbl_customer`(`name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert account customer Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Insert no account customer Successfully</span>";
                    return $alert;
                }
            }
        }
    }

    public function login_customer($data){
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

        if($email == "" || $password == ""){
            $alert = "<span class='error'>Fields must be not empty</span>";
            return $alert;
        } else {
            $query = "select * from tbl_customer where email = '$email' and password = '$password'";
            $result = $this->db->select($query);
            if($result){
                $value = $result->fetch_assoc();
                Session::set("customer_login", true);
                Session::set("customer_id", $value['id']);
                Session::set("customer_name",$value['name']);
                header("Location: order.php");
            } else {
                $alert = "<span class='error'>Email or passowrd not match</span>";
                return $alert;
            }
        }
    }

    public function getCustomer($id)
    {
        $query = "select * from tbl_customer where id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>