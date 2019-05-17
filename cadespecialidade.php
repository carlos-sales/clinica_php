<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Cadastro de Médico</title>

	<link rel="stylesheet" href="_css/bootstrap.css">
	<link rel="stylesheet" href="_css/style.css">
</head>
<body>
	
	<div class="container">
		<div class="jumbotron">
		<h1>Cadastro de Especialidade</h1>
	</div>

	<form action="_dao/daoEspecialidade.php" method="post">
		
		<div class="form-group">
			<label for="nome">Especialidade</label>
			<input type="text" class="form-control" id="especialidade" name="especialidade" placeholder="Nome da especialidade" required>
		</div>

		<input id="submit" type="submit" class="btn btn-success btn-block" value="Cadastrar">

	</form>

	<a href="index.php"><button class="btn btn-primary btn-block btn-menu">Voltar</button></a>
		
	</div>


</body>
</html>