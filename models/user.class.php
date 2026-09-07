<?php
class User {
    public $id;
    public $name;
    public $email;
    private $password;
    public $role_id;
    
    public function __construct($_id, $_name, $_email, $_password = null, $_role_id = null) {
        $this->id = $_id;
        $this->name = $_name;
        $this->email = $_email;
        $this->password = $_password;
        $this->role_id = $_role_id;
    }
   
    public function create() {  
        global $db;
      
        $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role_id) 
                VALUES ('$this->name', '$this->email', '$hashed_password', ".intval($this->role_id).")";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
    public function update() {
        global $db;
        $sql = "UPDATE users SET 
                name = '$this->name', 
                email = '$this->email', 
                role_id = ".intval($this->role_id)." 
                WHERE id = ".intval($this->id);      
        $db->query($sql); 
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
    
    static public function readAll($_pg = 1, $_limit = 3) {
        global $db;
        $offset = ($_pg - 1) * $_limit;
        $sql = "SELECT * FROM users ORDER BY id DESC LIMIT $_limit OFFSET $offset";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    static public function readById($_id) {
        global $db;
        $id = intval($_id);
        $sql = "SELECT * FROM users WHERE id = $id";
        $result = $db->query($sql);
        return $result->fetch_assoc();
    }
    
    static public function delete($_id) {
        global $db;
        $id = intval($_id);
        $db->query("DELETE FROM users WHERE id = $id");
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
     static public function getPageNo($_no_of_rows) {
        global $db;
        $sql = "SELECT COUNT(id) as total FROM users";
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        // return $row;
        return ceil($row['total'] / $_no_of_rows);
        // return $result->fetch_assoc()['total'];
    }
}


?>