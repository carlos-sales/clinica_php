<?php 

include_once "conexao.php";

if (!isset($_POST['especialidade']) ){
	try{

	  	$data = $conn->query("SELECT * FROM especialidade ORDER BY especialidade");

		//pegando o resultado da consulta
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}

} else {

	$esp = $_POST['especialidade'];
	try{
		$stmt = $conn->prepare("INSERT INTO especialidade (especialidade) VALUES ('".$esp."')");

		if($stmt->execute()){
        	header('location:../index.php');
		}
	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}
}


 ?>