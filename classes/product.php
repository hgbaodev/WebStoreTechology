<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>

<?php
    class product
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data,$files){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            //Kiem tra hinh anh va lay hinh anh cho vao folder upload
            $permited = array('ipg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower((end($div)));
            $unique_image = substr(md5(time()), 0 , 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;


            if($productName == "" || $brand == "" || $category == "" || $type == "" || $price == "" || $file_name == "" || $product_desc == ""){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            } else {
                $query = "insert into tbl_product(productName,brandId,catId,product_desc,price,type,image) values('$productName','$brand','$category','$product_desc','$price','$type','$unique_image')";
                $result = $this->db->insert($query);
                if($result){
                    move_uploaded_file($file_temp,$uploaded_image);
                    $alert = "<span class='success'>Insert product Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No insert product Success</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = "Select tbl_product.*,tbl_category.catName,tbl_brand.brandName from tbl_product 
            join tbl_category on tbl_product.catId = tbl_category.catId join tbl_brand on tbl_product.brandId = tbl_brand.brandId order by productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyid($id){
            $query = "Select * from tbl_product where productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
          
        public function update_product($data,$files,$id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);

            //Kiem tra hinh anh va lay hinh anh cho vao folder upload
            $permited = array('ipg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower((end($div)));
            // $file_current = strtolower((current($div)));
            $unique_image = substr(md5(time()), 0 , 10).'.'.$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $brand == "" || $category == "" || $type == "" || $price == ""|| $product_desc == ""){
                $alert = "<span class='error'>product must be not empty</span>";
                return $alert;
            } else {
                //Neu nguoi dung chon anh
                if(!empty($file_name)){
                    if($file_size>20480){
                        $alert = "<span class='error'>Image size should be less then 2MB</span>";
                        return $alert;
                    } else if(in_array($file_ext, $permited)==false){
                        $alert = "<span class='error'>You can upload only:".implode('.',$permited)."</span>";
                        return $alert;
                    }
                    $query = "update tbl_product set
                    productName = '$productName',
                    brandId = '$brand',
                    catId = '$category',
                    product_desc = '$product_desc',
                    type = '$type',
                    price = '$price',
                    image = '$unique_image'
                    where productId = '$id'";

                } else {
                // Neu nguoi dung khong chon anh
                $query = "update tbl_product set
                productName = '$productName',
                brandId = '$brand',
                catId = '$category',
                product_desc = '$product_desc',
                type = '$type',
                price = '$price'
                where productId = '$id'";
                }
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update product Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No update Success</span>";
                    return $alert;
                }
            }
        }

        public function delete_product($id){
            $query = "delete from tbl_product where productId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Delete product Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>No delete Success</span>";
                    return $alert;
            }
        }
        //END BACKEND
        public function getproduct_feathered(){
            $query = "Select * from tbl_product where type = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new(){
            $query = "Select * from tbl_product order by productId desc limit 4";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_detail($id){
            $query = "Select tbl_product.*,tbl_category.catName,tbl_brand.brandName 
            from tbl_product join tbl_category on tbl_product.catId = tbl_category.catId join tbl_brand on tbl_product.brandId = tbl_brand.brandId 
            where tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_iphone(){
            $query = "Select * from tbl_product where brandId = '7' order by productId desc limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_dell(){
            $query = "Select * from tbl_product where brandId = '1' order by productId desc limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_huwai(){
            $query = "Select * from tbl_product where brandId = '5' order by productId desc limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_asus(){
            $query = "Select * from tbl_product where brandId = '2' order by productId desc limit 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getCatgoryId($id){
            $query = "Select tbl_product.*,tbl_category.catName,tbl_brand.brandName 
            from tbl_product join tbl_category on tbl_product.catId = tbl_category.catId join tbl_brand on tbl_product.brandId = tbl_brand.brandId 
            where tbl_category.catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>