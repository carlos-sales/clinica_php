<?php 
include_once "conexao.php";

if (isset($_GET['idM']) ) {
	
	if ($_GET['tipo']=='D') {

		try{

			$stmt = $conn->prepare("DELETE FROM area WHERE idMedico='".$_GET['idM']."' AND idEspecialidade='".$_GET['idE']."' ");

			if($stmt->execute()){
				header('location:../index.php');
			}

		}catch(PDOException $e){
			echo 'ERROR: ' . $e->getMessage();
		}

	} else {

		$idm = $_GET['idM'];
		$nome = $_GET['tNome'];
		$crm = $_GET['tCrm'];
		$tel = $_GET['tTelefone'];
		$esp = array_filter($_GET['item']);
		
		try{

			$stmt = $conn->prepare("UPDATE medico SET nome='".$nome."', crm='".$crm."', telefone='".$tel."' WHERE idMedico='".$idm."'");

			$stmt->execute();

			try{


				foreach ($esp as $key => $value){

					$stmt = $conn->prepare("INSERT INTO area (idMedico, idEspecialidade) VALUES ('".$idm."', '".$value."')");

					$stmt->execute();

				}

			}catch(PDOException $e){
				echo 'ERROR: ' . $e->getMessage();
			}
			
			header('location:../index.php');
			
		}catch(PDOException $e){
			echo 'ERROR: ' . $e->getMessage();
		}
	}
	
} else if ( isset($_GET['tNome']) ) {

	try{

		$nome = $_GET['tNome'];
		$crm = $_GET['tCrm'];
		$tel = $_GET['tTelefone'];
		$esp = array_filter($_GET['item']);

		$stmt = $conn->prepare("INSERT INTO medico (nome, crm, telefone) VALUES ('".$nome."','".$crm."','".$tel."')");

		if($stmt->execute()){


		    foreach ($esp as $key => $value) {
		    
		    	$stmt = $conn->prepare("INSERT INTO area (idMedico, idEspecialidade) VALUES ( (SELECT MAX(idMedico) FROM medico), '".$value."') ");

		      	$stmt->execute();
		    }	

			header('location:../index.php');
		}
		
	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}

} else {

	try{

		if (isset($_GET['pesq'])) {
			$data = $conn->query("SELECT m.idMedico, m.nome, m.crm, m.telefone, e.idEspecialidade, e.especialidade FROM medico m INNER JOIN especialidade e INNER JOIN area a WHERE m.idMedico = a.idMedico AND e.idEspecialidade = a.idEspecialidade AND m.idMedico in ( SELECT m.idMedico FROM medico m INNER JOIN especialidade e WHERE m.nome LIKE '%".$_GET['pesq']."%' OR m.crm LIKE '%".$_GET['pesq']."%' OR e.especialidade LIKE '%".$_GET['pesq']."%') AND e.idEspecialidade IN ( SELECT e.idEspecialidade FROM medico m INNER JOIN especialidade e WHERE m.nome LIKE '%".$_GET['pesq']."%' OR m.crm LIKE '%".$_GET['pesq']."%' OR e.especialidade LIKE '%".$_GET['pesq']."%') ORDER BY nome, especialidade");
		} else{
			$data = $conn->query("SELECT m.idMedico, m.nome, m.crm, m.telefone, e.idEspecialidade, e.especialidade FROM medico m INNER JOIN especialidade e INNER JOIN area a WHERE m.idMedico = a.idMedico AND e.idEspecialidade = a.idEspecialidade ORDER BY nome, especialidade");
		}

		//pegando o resultado da consulta
		$result = $data->fetchAll(PDO::FETCH_ASSOC);

	}catch(PDOException $e){
		echo 'ERROR: ' . $e->getMessage();
	}

}

?>