<?php
class Rider {
    public $id;
    public $name;
    public $phone;
    public $vehicle;
    public $total_delivery;
    public $status;

    public function __construct($_id = null, $_name = "", $_phone = "", $_vehicle = "", $_total_delivery = 0, $_status = "Active") {
        $this->id = $_id;
        $this->name = $_name;
        $this->phone = $_phone;
        $this->vehicle = $_vehicle;
        $this->total_delivery = $_total_delivery;
        $this->status = $_status;
    }

    // ১. নতুন রাইডার তৈরি (Create)
    public function create() {  
        global $db;
        $sql = "INSERT INTO riders (name, phone, vehicle, total_delivery, status) 
                VALUES ('$this->name', '$this->phone', '$this->vehicle', ".intval($this->total_delivery).", '$this->status')";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    // ২. সব রাইডার একসাথে দেখা (Read All)
    static public function readAll() {
        global $db;
        $sql = "SELECT * FROM riders ORDER BY id DESC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // ৩. রাইডার ডিলিট করা (Delete)
    static public function delete($_id) {
        global $db;
        $id = intval($_id);
        $db->query("DELETE FROM riders WHERE id = $id");
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
}
?>