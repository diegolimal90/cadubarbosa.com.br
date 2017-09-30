<?php
require_once '..\lib\Model.php';

class Login extends Model{
	
	protected $table = 'login';
	
	private $usr;
	private $senha;
	
	public function setParams($usr, $senha){
		
		$this->usr = $usr;
		$this->senha = $senha;
	}
	
	public function consultar(){
		$sql = "SELECT * FROM {$this->table} WHERE  usuario = ':usr'";
		$stmt = Db::prepare($sql);
		$stmt->bindParam(':usr', $this->usr);
		return $stmt->fetch();
	}
}
