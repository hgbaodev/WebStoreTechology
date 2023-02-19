<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helper/format.php');
?>

<?php
    class category
    {
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_category($catName){
            $catName = $this->fm->validation($catName);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            } else {
                $query = "insert into tbl_category(catName) values('$catName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert category Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No insert Success</span>";
                    return $alert;
                }
            }
        }

        public function show_category(){
            $query = "Select * from tbl_category order by catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatbyid($id){
            $query = "Select * from tbl_category where catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }
          
        public function update_category($catname,$id){
            $catName = $this->fm->validation($catname);
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)){
                $alert = "<span class='error'>Category must be not empty</span>";
                return $alert;
            } else {
                $query = "update tbl_category set catName = '$catName' where catId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Update category Successfully</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>No update Success</span>";
                    return $alert;
                }
            }
        }

        public function delete_category($id){
            $query = "delete from tbl_category where catId = '$id'";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Delete category Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>No delete Success</span>";
                    return $alert;
            }
        }
    }
?>