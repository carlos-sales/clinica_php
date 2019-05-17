<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Médico</title>

	<link rel="stylesheet" href="_css/bootstrap.css">
	<link rel="stylesheet" href="_css/style.css">
	<script src="_scripts/script.js"></script>

</head>
<body>

	<div class="container-fluid">

			<div class="jumbotron">
				<h1>Cadastro de Médico</h1>
			</div>

		<form action="_dao/daoMedico.php" method="get">

			<?php if (isset($_GET['idMed'])){ ?>

			<input type="text" value="<?php echo $_GET['idMed']; ?>" name="idM" class="hide">
			<input type="text" value="<?php echo $_GET['idE']; ?>" name="idE" class="hide">
			<?php } ?>

			<div class="form-group">
				<label for="cNome">Nome</label>
				<input type="text" class="form-control" name="tNome" id="cNome" placeholder="Nome do médico" value="<?php echo isset($_GET['nome'])?$_GET['nome']:''; ?>" required>
			</div>

			<div class="form-group">
				<label for="cCrm">CRM</label>
				<input type="number" class="form-control" name="tCrm" id="cCrm" placeholder="CRM do médico" value="<?php echo isset($_GET['crm'])?$_GET['crm']:''; ?>" required>
			</div>

			<div class="form-group">
				<label for="cTelefone">Telefone</label>
				<input type="tel" class="form-control" name="tTelefone" id="cTelefone" placeholder="(XX) XXXX-XXXX" value="<?php echo isset($_GET['tel'])?$_GET['tel']:''; ?>" oninput="mascara(this)" required>
			</div>
	
			<div class="form-group">
				<label>Especialidades (escolha no mínimo duas)</label><br>
				
				<table class="table">

					<?php 

					include_once '_dao/daoEspecialidade.php';

					$linha=1;

					foreach ($result as $value){

						if ($linha==1) {
					
					?>
					
					<tr>
					
					<?php
						
						}

						$aux = isset($_GET['idE'])?$_GET['idE']:-1;

						if($value['idEspecialidade'] != $aux){

					?>
		
					<td>
						<div class="container-fluid">
							<input class="form-check-input" type="checkbox" id="cItem" name="item[]" value="<?php echo $value['idEspecialidade']; ?>" onclick="marcaBox(<?php echo isset($_GET['idE']) ?>)">
							<label class="form-check-label"><?php echo $value['especialidade']; ?></label>	
						</div>
					</td>

					<?php 

							$linha++;
						}

						if ($linha==5) {
							$linha=1;
					?>
					
					</tr>
					
					<?php
						}
					}

				 	?>
				
				</table>

			</div>

			<input id="submit" type="submit" class="btn btn-success btn-block" value="Cadastrar" disabled="disabled">

		</form>

		<a href="index.php"><button class="btn btn-primary btn-block btn-menu">Voltar</button></a>


	</div>

	<script>
		<?php if (isset($_GET['idMed'])) { ?>
	
			document.getElementById('submit').disabled = false;
	
		<?php } ?>
	</script>

</body>
</html>