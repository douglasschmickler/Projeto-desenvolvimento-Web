<?php

     require_once "conexao.php";

    if (isset($_POST['bnt-cadastrar'])) {
        
       // $id = $_GET['id'];
        $id_usuario = mysqli_escape_string($conexao, $_POST['usuario_id']);
        $nome = mysqli_escape_string($conexao, $_POST['nome']);
        $cpf = mysqli_escape_string($conexao, $_POST['cpf']);
        $rg = mysqli_escape_string($conexao, $_POST['rg']);
        $data_nascimento = mysqli_escape_string($conexao, $_POST['data_nascimento']);
        $telefone = mysqli_escape_string($conexao, $_POST['telefone']);



        $sql_paciente = "SELECT id FROM tb_paciente WHERE id != '$id'";
        $resultado = mysqli_query($conexao, $sql_paciente); //executando o comando do sql
        $array = mysqli_fetch_array($resultado); 


        //tentando cadastrar um usuário já existente
        if((isset($array)) && ($id == $array['id'])){
            header('location: paciente-novo.php?existe');
        }else{ //passando um id já existente ou seja é uma ediçaõ
            if (isset($id) && $id!= ""){
                $sql = "UPDATE tb_paciente SET id_usuario = ?,nome = ?,cpf = ?,rg = ?,data_nascimento = ?, telefone = ? WHERE id = ? ";
                $tipos = "isssss";

                //variavel array $parametros
                $parametros = array($id_usuario,$nome,$cpf,$rg,$data_nascimento, $telefone);

                $stmt = mysqli_prepare($conexao, $sql); //aqui vai o sql dentro da preparacao 

               // echo $nome_fantasia."(chegou)";
               // echo $id;
               // die;

                if(!$stmt){
                    echo "Erro no cadastro do paciente: ".mysqli_error($conexao);
                }
                mysqli_stmt_bind_param($stmt, $tipos, ...$parametros); 
                mysqli_stmt_execute($stmt);
                
                if(mysqli_stmt_error($stmt)){

                    header('location: paciente-novo.php?erro');
                }else{
                    header('location: paciente-novo.php?update');
                }
            }else{
                $sql = "INSERT INTO tb_paciente(id_usuario,nome,cpf,rg,data_nascimento,telefone) values(?,?,?,?,?,?)";

                $tipos = "isssss";

                $parametros = array($id_usuario,$nome,$cpf,$rg,$data_nascimento, $telefone);

                $stmt = mysqli_prepare($conexao,$sql);

                if (!$stmt) {
                    echo "Erro no cadastro do paciente: ".mysqli_error($conexao);
                }

                mysqli_stmt_bind_param($stmt, $tipos, ...$parametros); 
                mysqli_stmt_execute($stmt);
                    
                if(mysqli_stmt_error($stmt)){

                    header('location: paciente-novo.php?erro');
                }else{
                    header('location: paciente-novo.php?sucesso');
                }

            }
            mysqli_Stmt_close($stmt);
        }
    }

    //Exclusão cadastro paciente
    if(isset($_POST['deleta'])){
        $id = mysqli_escape_string($conexao, $_POST['id']);
   
        $sql = "DELETE FROM tb_paciente WHERE id =?";
    
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
    
?>