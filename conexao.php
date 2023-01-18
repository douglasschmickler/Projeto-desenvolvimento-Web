<?php
	$servidor ="localhost"; //servidor onde está o banco de dados (máquina local)
	$usuario ="root";  //usuario do banco de dados
	$senha = "";  //senha do banco de dados
	$nome_banco ="banco_banquinho"; //nome da base de dados utilizada

	$conexao = mysqli_connect($servidor, $usuario, $senha, $nome_banco); 
	//Função que faz a conexao com o banco de dados

	mysqli_set_charset($conexao, "utf8"); 
	//setando o banco com o padrão utf8 do Brasil

	if(mysqli_connect_error()){  //Verificando existencia de erro com a conexão
		echo "Erro de conexão: ".mysqli_connect_error();
	}else{
        echo "Conexao realizada com sucesso!";
    }
?>