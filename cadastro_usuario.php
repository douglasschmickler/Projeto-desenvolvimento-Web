<?php

    require_once "conexao.php";

    if (isset($_POST['bnt-cadastrar'])) {
        //$id = mysqli_escape_string($conexao, $_POST['id']);
        $usuario_email = mysqli_escape_string($conexao, $_POST['usuario_email']);
        $usuario_senha = trim(mysqli_escape_string($conexao, $_POST['usuario_senha']));
        $tipo_usuario = mysqli_escape_string($conexao, $_POST['tipo_usuario']);


        $sql = "INSERT INTO tb_usuario(usuario_email,usuario_senha,tipo_usuario)
            values(?,?,?)";

        $tipos = "sss";

        $parametros = array($usuario_email,$usuario_senha,$tipo_usuario);

        $stmt = mysqli_prepare($conexao,$sql);

        if (!$stmt) {
            echo "Erro no cadastro do usuario: ".mysqli_error($conexao);
        }

        echo "chegou";

        mysqli_stmt_bind_param($stmt, $tipos,...$parametros);


        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {

            echo "Erro ao cadastrar o usuario";
        }else{
            echo "Usuario cadastrado com sucesso!";
        }
    }

        //Exclusão cadastro clinica
        if(isset($_POST['deleta'])){
            $id = mysqli_escape_string($conexao, $_POST['usuario_id']);
            
            $sql = "DELETE FROM tb_usuario WHERE usuario_id =?";
            
            $stmt = mysqli_prepare($conexao, $sql);
            
            mysqli_stmt_bind_param($stmt, 'i', $id); 
            
            mysqli_stmt_execute($stmt);
            $erro = mysqli_stmt_error($stmt);
            
            mysqli_Stmt_close($stmt);
            
            if($erro){
                echo 0;
            }else{
                echo 1;
            }
        }
        
        mysqli_stmt_close($stmt);
?>