<?php
	
	function __autoload($class_name){
		require_once "Classes/{$class_name}.php";
	}
