<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>

<?php
    class brand
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);
            if(empty($brandName)){
                $alert = "<span class='error'>brand must be not empty</span>";
                return $alert;
            } else {
                $query = "insert into tbl_brand(brandName) values('$brandName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert brand Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No insert brand Success</span>";
                    return $alert;
                }
            }
        }

        public function show_brand(){
            $query = "Select * from tbl_brand order by brandId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getbrandbyid($id){
            $query = "Select * from tbl_brand where brandId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
          
        public function update_brand($brandName,$id){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>brand must be not empty</span>";
                return $alert;
            } else {
                $query = "update tbl_brand set brandName = '$brandName' where brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update brand Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No update Success</span>";
                    return $alert;
                }
            }
        }

        public function delete_brand($id){
            $query = "delete from tbl_brand where brandId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Delete brand Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>No delete Success</span>";
                    return $alert;
            }
        }
    }
?>