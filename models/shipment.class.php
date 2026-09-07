<?php
class Shipment {
    public $id;
    public $shipment_no;
    public $sender_name;
    public $receiver_name;
    public $destination;
    public $status;
    public $date;
    public $rider_id; 

    public function __construct($_id = null, $_shipment_no = "", $_sender_name = "", $_receiver_name = "", $_destination = "", $_status = "Pending", $_date = "", $_rider_id = null) {
        $this->id = $_id;
        $this->shipment_no = $_shipment_no;
        $this->sender_name = $_sender_name;
        $this->receiver_name = $_receiver_name;
        $this->destination = $_destination;
        $this->status = $_status;
        $this->date = $_date ? $_date : date('Y-m-d');
        $this->rider_id = $_rider_id;
    }

    
    public function create() {  
        global $db;
        $rider_val = $this->rider_id ? intval($this->rider_id) : "NULL";
        
        $sql = "INSERT INTO shipments (shipment_no, sender_name, receiver_name, destination, status, date, rider_id) 
                VALUES ('$this->shipment_no', '$this->sender_name', '$this->receiver_name', '$this->destination', '$this->status', '$this->date', $rider_val)";
        $db->query($sql);

        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }

    
    static public function readAll() {
        global $db;
        $sql = "SELECT s.*, r.name AS rider_name 
                FROM shipments s 
                LEFT JOIN riders r ON s.rider_id = r.id 
                ORDER BY s.id DESC";
        $result = $db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    
    static public function delete($_id) {
        global $db;
        $id = intval($_id);
        $db->query("DELETE FROM shipments WHERE id = $id");
        
        if($db->error){
            return $db->error;
        }else{
            return true;
        }
    }
}
?>