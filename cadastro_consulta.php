<?php

    require_once "conexao.php";

    if (isset($_POST['bnt-cadastrar'])) {
        //$id = mysqli_escape_string($conexao, $_POST['id']);
        $id_paciente = mysqli_escape_string($conexao, $_POST['id_paciente']);
        $id_medico = mysqli_escape_string($conexao, $_POST['id_medico']);
        $data_consulta = mysqli_escape_string($conexao, $_POST['data_consulta']);
        $descricao_consulta = trim(mysqli_escape_string($conexao, $_POST['descricao_consulta']));
        $status_consulta = mysqli_escape_string($conexao, $_POST['status_consulta']);


        $sql = "INSERT INTO tb_consulta(id_paciente,id_medico,data_consulta,descricao_consulta,status_consulta)
            values(?,?,?,?,?)";

        $tipos = "iisss";

        $parametros = array($id_paciente,$id_medico,$data_consulta,$descricao_consulta,$status_consulta);

        $stmt = mysqli_prepare($conexao,$sql);

        if (!$stmt) {
            echo "Erro no cadastro da consulta: ".mysqli_error($conexao);
        }

        echo "chegou";

        mysqli_stmt_bind_param($stmt, $tipos,...$parametros);


        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            echo "Erro ao cadastrar a consulta";
        }else{
            echo "Consulta cadastrada com sucesso!";
        }
    }

    mysqli_stmt_close($stmt);
?>