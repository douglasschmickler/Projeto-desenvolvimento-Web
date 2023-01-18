<?php

    require_once "conexao.php";

    if (isset($_POST['bnt-cadastrar'])) {
        //$id = mysqli_escape_string($conexao, $_POST['id']);
        $id_usuario = mysqli_escape_string($conexao, $_POST['usuario_id']);
        $nome = mysqli_escape_string($conexao, $_POST['nome']);
        $cmr = mysqli_escape_string($conexao, $_POST['cmr']);
        $id_clinica = mysqli_escape_string($conexao, $_POST['clinica_id']);        
        $especialidade = mysqli_escape_string($conexao, $_POST['especialidade']);



        $sql = "INSERT INTO tb_medico(id_usuario,nome,cmr,id_clinica,especialidade)
            values(?,?,?,?,?)";

        $tipos = "issis";

        $parametros = array($id_usuario,$nome,$cmr,$id_clinica,$especialidade);

        $stmt = mysqli_prepare($conexao,$sql);

        if (!$stmt) {
            echo "Erro no cadastro do médico: ".mysqli_error($conexao);
        }

        mysqli_stmt_bind_param($stmt, $tipos,...$parametros);


        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            echo "Erro ao cadastrar o médico";
        }else{
            echo "Médico cadastrado com sucesso!";
        }
        
    }
    


    
    //Exclusão cadastro médico
    if(isset($_POST['deleta'])){
        $id = mysqli_escape_string($conexao, $_POST['id']);
        
        $sql = "DELETE FROM tb_medico WHERE id =?";
        
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