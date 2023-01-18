<?php

	session_start();

	//inclusão e alteração 
	require_once "conexao.php"; //chamada do arquivo conexão para ele se conectar com o banco de dados (require_once = inclua apenas uma vez esse arquivo)

	if(isset($_POST['btn-entrar'])){ //verifica se veio por esse metodo e se exite essa variavel
		$login_email = mysqli_escape_string($conexao,$_POST['login_email']);
		
		$senha = md5($_POST['senha']);

		$sql_login = "SELECT usuario_id,usuario_email,usuario_senha,tipo_usuario FROM tb_usuario WHERE email = '$login' AND senha = '$senha'";

		$resultado = mysqli_query($conexao, $sql_login); //executando o comando do sql_login
		//variavel row é a quantidade de retorno
		$row = mysqli_fetch_array($resultado); 		 

		if($row <= 0){
			echo "<script language='javascript' type='text/javascript'>
			alert('Login ou senha incorretos!');
			window.location.href = 'login.php';
			</script>
			";
			die();
		}else{

			$arrayUsuario = [
				"id_usuario" => $row["id_usuario"],
				"nome" => $row["nome"],
				"cpf" => $row["cpf"],
				"tipoUsuario" => $row["tipoUsuario"]
			];

			$_SESSION["usuario"] = json_encode($arrayUsuario);

			header("Location:index.php");	
		}
	}

	?>