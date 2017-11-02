<?php
require_once 'Db.class.php';

class Model extends Db{
	
	protected $table;
	
	public function insert(){
		
	}
	public function update($id){
		
	}
	public function find($id){
		$sql = "SELECT * FROM {$this->table} WHERE id = :id";
		$stmt = Db::prepare($sql);
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
	public function findAll(){
		$sql = "SELECT * FROM ".$this->table;
		$stmt = Db::query($sql);
		return $stmt->fetch();
	}
	public function delete($id){
		$sql = "DELETE FROM {$this->table} WHERE id = :id";
		$stmt = Db::prepare($sql);
		$stmt->bindParams(':id', $id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch();
	}
}