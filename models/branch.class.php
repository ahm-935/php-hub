<?php
class Branch {
    public $id;
    public $branch_name;
    public $manager_name;
    public $email;
    public $phone_number;
    public $location;
    public $status;

    public function __construct($_id = null, $_branch_name = "", $_manager_name = "", $_email = "", $_phone_number = "", $_location = "", $_status = "Pending") {
        $this->id = $_id;
        $this->branch_name = $_branch_name;
        $this->manager_name = $_manager_name;
        $this->email = $_email;
        $this->phone_number = $_phone_number;
        $this->location = $_location;
        $this->status = $_status;
    }

   
    public function create() {  
        global $db;
        $sql = "INSERT INTO branches (branch_name, manager_name, email, phone_number, location, status) 
                VALUES ('$this->branch_name', '$this->manager_name', '$this->email', '$this->phone_number', '$this->location', '$this->status')";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    static public function readAll() {
        global $db;
        $sql = "SELECT * FROM branches ORDER BY id DESC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    static public function readById($_id) {
        global $db;
        $id = intval($_id);
        $sql = "SELECT * FROM branches WHERE id = $id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }

    
    public function update() {
        global $db;
        $sql = "UPDATE branches SET 
                branch_name = '$this->branch_name', 
                manager_name = '$this->manager_name', 
                email = '$this->email', 
                phone_number = '$this->phone_number', 
                location = '$this->location', 
                status = '$this->status' 
                WHERE id = ".intval($this->id);      
        $db->query($sql);
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    static public function delete($_id) {
        global $db;
        $id = intval($_id);
        $db->query("DELETE FROM branches WHERE id = $id");
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
}
?>