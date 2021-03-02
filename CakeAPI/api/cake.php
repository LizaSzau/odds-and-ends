<?php
class Cake{
  
    private $conn;
    private $table_name = 'cakes';
  
    public $id;
    public $name;
	public $price;
    public $confectioner;
    public $vegan;
    public $lactose_free;
    public $description;
    public $created_at;
	
	public $order;
	public $desc = '';
	
	private $required_fields = array('name', 'price', 'updated_at');
	private $message;
	private $json_result;
	private $prev_id;
	private $next_id;
	
    public function __construct($db){ $this->conn = $db; }
	public function getMessage(){ return $this->message; }
	public function getJsonResult(){ return $this->json_result; }
	public function getPrevID(){ return $this->prev_id; }
	public function getNextID(){ return $this->next_id; }
	public function getOrder(){ return $this->order; }
	public function getDesc(){ return $this->desc; }
	
	public function create(){
	  
		$query = 'INSERT INTO '.$this->table_name.' SET 
				  name = :name, 
				  price = :price,
				  confectioner = :confectioner, 
				  vegan = :vegan,
				  lactose_free = :lactose_free,
				  description = :description,
				  created_at = :created_at
				  ';
	 
		$stmt = $this->conn->prepare($query);
	  
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':confectioner', $this->confectioner);
		$stmt->bindParam(':vegan', $this->vegan);
		$stmt->bindParam(':lactose_free', $this->lactose_free);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':created_at', $this->created_at);
	
		if($stmt->execute()){
			$this->message = 'A torta felvitele sikerült.';
			return true;
		}
		
		//var_dump($stmt->errorInfo());
		$this->message = 'Váratlan hiba lépett fel a rögzítés közben.';
		return false;
	}
	
	public function update(){
	  
		$query = 'UPDATE '.$this->table_name.' SET 
				  name = :name, 
				  price = :price,
				  confectioner = :confectioner, 
				  vegan = :vegan,
				  lactose_free = :lactose_free,
				  description = :description,
				  created_at = :created_at
				  WHERE id = :id
				  ';
	 
		$stmt = $this->conn->prepare($query);
	  
		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':name', $this->name);
		$stmt->bindParam(':price', $this->price);
		$stmt->bindParam(':confectioner', $this->confectioner);
		$stmt->bindParam(':vegan', $this->vegan);
		$stmt->bindParam(':lactose_free', $this->lactose_free);
		$stmt->bindParam(':description', $this->description);
		$stmt->bindParam(':created_at', $this->created_at);
	
		if($stmt->execute()){
			$this->message = 'A torta módosítása sikerült.';
			return true;
		}
		
		//var_dump($stmt->errorInfo());
		$this->message = 'Váratlan hiba lépett fel a rögzítés közben.';
		return false;
	}
	
	
	public function delete() {
		$query = 'DELETE FROM '.$this->table_name.' WHERE id = :id';
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			$this->message = 'A torta törlésre került :(';
			return true;
		}
		
		$this->message = 'Váratlan hiba lépett fel a rögzítés közben.';
		return false;
	}
	
	public function view() {
		if (!in_array($this->order, $this->required_fields)) $this->order = 'updated_at';
		
		if (empty($this->id)) {
			$query = 'SELECT * FROM '.$this->table_name.' ORDER BY '.$this->order.' '.$this->desc.' LIMIT 1';
			$stmt = $this->conn->prepare($query);
			
			if($stmt->execute()){
				$row = $stmt->fetch();
				$this->id = $row['id'];
			} else {
				$this->message = 'Váratlan hiba lépett fel.';
				return false;				
			}
		}
		
		if (!in_array($this->order, $this->required_fields)) $this->order = 'updated_at';

		$query = 'SELECT * FROM '.$this->table_name.' WHERE id = '.$this->id.' ORDER BY '.$this->order.' '.$this->desc.' LIMIT 1';
		$stmt = $this->conn->prepare($query);
		
		if($stmt->execute()){
			$this->message = 'A torta adatai.';
			$this->json_result = json_encode($stmt->fetch());
			$this->set_prev_next_index();
			return true;
		}
		
		$this->message = 'Váratlan hiba lépett fel.';
		return false;
	}
	
	public function isEntityExist() {
		$query = 'SELECT id FROM '.$this->table_name.' WHERE id = :id';
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $this->id);
		
		if($stmt->execute()){
			if ($stmt->rowCount() == 1) return true;
		}
		
		$this->message = 'Nincs ilyen azonosítójú torta.';
		return false;
	}

	private function set_prev_next_index() {
		$query = 'SELECT * FROM '.$this->table_name.' ORDER BY '.$this->order.' '.$this->desc;
		$stmt = $this->conn->prepare($query);
		
		$i = 0;
	
		if($stmt->execute()){
			$all = $stmt->fetchAll();
			
			foreach ($all as $row) {
				if ($row['id'] == $this->id) break;
				$i++;
			}
			
			if ($i != 0) $this->prev_id = $all[$i - 1]['id'];
			if ($i < count($all) - 1) $this->next_id = $all[$i + 1]['id'];
			return true;
		}
	}
}