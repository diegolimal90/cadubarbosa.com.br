<?php
require_once 'defines.php';

class Db{
	
	private static $instance;
	
	public static function getInstance(){
		
		if(!isset(self::$instance)){
			
			try{
				self::$instance = new PDO('mysql:host='.HOST.';dbname='.DBNAME, USER, PASS);
			} catch(PDOException $msg){
				return $msg->getMessage();
			}
		}
		
		return self::$instance;
	}
	
	public static function prepare($sql){
		return self::getInstance()->prepare($sql);
	}
	
	public static function query($sql){
		return self::getInstance()->query($sql);
	}
	
}