<?php
require_once 'lib/Model.php';

class Cadastro extends Model{
	
	protected $table = 'rolecao';
	
	private $nome;
	private $fone;
	private $cel;
	private $email;
	private $tam;
	private $cep;
	private $cidade;
	private $bairro;
	private $rua;
	private $comple;
	private $nm_animal;
	
	public function setParams($nome, $fone, $cel, $email, $tam, $cep, $cidade, $bairro, $rua, $comple, $nm_animal){
		$this->nome = $nome;
		$this->fone = $fone;
		$this->cel = $cel;
		$this->email = $email;
		$this->tam = $tam;
		$this->cep = $cep;
		$this->cidade = $cidade;
		$this->bairro = $bairro;
		$this->rua = $rua;
		$this->comple = $comple;
		$this->nm_animal = $nm_animal;
	}
	
	public function insert(){
		
		$sql = "INSERT INTO {$this->table} ( `nome`, `fone`, `cel`, `email`, `tam`, `cep`, `cidade`, `bairro`, `rua`, `complemento`, `nm_animal`) VALUES ( :nome, :fone, :cel, :email, :tam, :cep, :cidade, :bairro, :rua, :complemento, :nm_animal)";
		$stmt = Db::prepare($sql);
		$stmt->bindParam(':nome', $this->nome);
		$stmt->bindParam(':fone', $this->fone);
		$stmt->bindParam(':cel', $this->cel);
		$stmt->bindParam(':email', $this->email);
		$stmt->bindParam(':tam', $this->tam);
		$stmt->bindParam(':cep', $this->cep);
		$stmt->bindParam(':cidade', $this->cidade);
		$stmt->bindParam(':bairro', $this->bairro);
		$stmt->bindParam(':rua', $this->rua);
		$stmt->bindParam(':complemento', $this->comple);
		$stmt->bindParam(':nm_animal', $this->nm_animal);
		return $stmt->execute();
		
	}
	
	public function update($id){
		
		//script para atualizar pagina
	}
}