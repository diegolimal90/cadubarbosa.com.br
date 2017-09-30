<?php
require_once 'lib/Model.php';

class Cadastro extends Model{
	
	protected $table = 'fiel';
	
	private $nome;
	private $email;
	private $cargo;
	private $whats;
	private $ende;
	private $sexo;
	private $dtNas; 
	private $batizado;
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setParams($nome, $email, $cargo, $whats, $end, $sexo, $dtNas, $batizado){
		$this->nome = $nome;
		$this->email = $email;
		$this->cargo = $cargo;
		$this->whats = $whats;
		$this->ende = $end;
		$this->sexo = $sexo;
		$this->dtNas = $dtNas; 
		$this->batizado = $batizado;
	}
	
	public function insert(){
		
		$sql = "INSERT INTO {$this->table} (nome, whatsapp, email, endereco, dt_nasc, sexo, batismo, cargo) values (:nome, :whats, :email, :ende, :dtNas, :sexo, :batizado, :cargo)";
		$stmt = Db::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':whats', $this->whats);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':ende', $this->ende);
		$stmt->bindParam(':dtNas', $this->dtNas);
		$stmt->bindParam(':sexo', $this->sexo);
		$stmt->bindParam(':batizado', $this->batizado);
		$stmt->bindParam(':cargo', $this->cargo);
		return $stmt->execute();
		
	}
	
	public function update($id){
		
		//script para atualizar pagina
	}
}