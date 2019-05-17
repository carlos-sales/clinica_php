<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Clínica</title>

	<link rel="stylesheet" href="_css/bootstrap.css">
	<link rel="stylesheet" href="_css/style.css">
</head>
<body>

	<div class="container-fluid">

		<div class="jumbotron">
			<h1>Minha Clínica de Especialidades</h1>
		</div>
		
		<a href="cadespecialidade.php"><button class="btn btn-success btn-sm float-sm-right">Add Especialidade</button></a>
		<a href="cadmedico.php"><button class="btn btn-success btn-sm float-sm-right">Add Médico</button></a>
		<?php if (isset($_GET['pesq'])) { ?>
			<a href="index.php"><button class="btn btn-warning btn-sm float-sm-right">Limpar Filtro</button></a>
		<?php } ?>
		<form action="index.php" method="get">
			<div class="input-group mb-3">
				<input type="text" class="form-control" placeholder="Pesquise por nome, CRM ou especialidade" name="pesq" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<input class="btn btn-primary" type="submit" value="Pesquisar">
				</div>
			</div>
		</form>
		<table class="table table-striped">
			<thead>
				<th>Nome</th>
				<th>CRM</th>
				<th>Telefone</th>
				<th>Especialidade</th>
				<th></th>	
			</thead>
			<tbody>
				
					<?php 

					require_once '_dao/daoMedico.php';

					if (count($result)>0){


						foreach ($result as $value){
					
					?>
					<tr>

						<td><?php echo $value['nome']; ?></td>
						<td><?php echo $value['crm']; ?></td>
						<td><?php echo $value['telefone']; ?></td>
						<td><?php echo $value['especialidade']?></td>
						<td> 
							<a href="cadmedico.php?idMed=<?php echo $value['idMedico']; ?>&nome=<?php echo $value['nome']; ?>&crm=<?php echo $value['crm']; ?>&tel=<?php echo $value['telefone']; ?>&idE=<?php echo $value['idEspecialidade']; ?>">
								<button class="btn btn-primary btn-sm">Editar</button>
							</a> 
							<a href="_dao/daoMedico.php?idM=<?php echo $value['idMedico']; ?>&idE=<?php echo $value['idEspecialidade']; ?>&tipo=D">
								<button class="btn btn-danger btn-sm">Apagar</button>
							</a> 
						</td>
					
					</tr>
					<?php
						}
					} else {
						?>
					<tr>
						<td colspan="5">Não há registros</td>
					</tr>
						<?php
					}
					?>
					
				
			</tbody>
			
		</table>
		
	</div>
	

</body>
</html>