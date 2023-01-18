<?php

     require_once "conexao.php";

    if (isset($_POST['bnt-cadastrar'])) {
        $id = mysqli_escape_string($conexao, $_POST['id']);
       // $id = $_GET['id'];
        $nome_fantasia = mysqli_escape_string($conexao, $_POST['nome_fantasia']);
        $endereco = mysqli_escape_string($conexao, $_POST['endereco']);
        $cep = mysqli_escape_string($conexao, $_POST['cep']);
        $razao_social = mysqli_escape_string($conexao, $_POST['razao_social']);
        $numero = mysqli_escape_string($conexao, $_POST['numero']);



        $sql_clinica = "SELECT id FROM clinica WHERE id != '$id'";
        $resultado = mysqli_query($conexao, $sql_clinica); //executando o comando do sql
        $array = mysqli_fetch_array($resultado); 


        //tentando cadastrar um usuário já existente
        if((isset($array)) && ($id == $array['id'])){
            header('location: clinica-novo.php?existe');
        }else{ //passando um id já existente ou seja é uma ediçaõ
            if (isset($id) && $id != ""){
                $sql = "UPDATE clinica SET nome_fantasia = ?,endereco = ?,numero = ?,cep = ?,razao_social = ? WHERE id = ? ";
                $tipos = "sssssi";

                //variavel array $parametros
                $parametros = array($nome_fantasia,$endereco,$numero,$cep,$razao_social, $id);

                $stmt = mysqli_prepare($conexao, $sql); //aqui vai o sql dentro da preparacao 

               // echo $nome_fantasia."(chegou)";
               // echo $id;
               // die;

                if(!$stmt){
                    echo "Erro no cadastro da clinica: ".mysqli_error($conexao);
                }
                mysqli_stmt_bind_param($stmt, $tipos, ...$parametros); 
                mysqli_stmt_execute($stmt);
                
                if(mysqli_stmt_error($stmt)){

                    header('location: clinica-novo.php?erro');
                }else{
                    header('location: clinica-novo.php?update');
                }
            }else{
                $sql = "INSERT INTO clinica(nome_fantasia,endereco,numero,cep,razao_social) values(?,?,?,?,?)";

                $tipos = "sssss";

                $parametros = array($nome_fantasia,$endereco,$numero,$cep,$razao_social);

                $stmt = mysqli_prepare($conexao,$sql);

                if (!$stmt) {
                    echo "Erro no cadastro da clinica: ".mysqli_error($conexao);
                }

                 mysqli_stmt_bind_param($stmt, $tipos, ...$parametros); 
                mysqli_stmt_execute($stmt);
                    
                if(mysqli_stmt_error($stmt)){

                    header('location: clinica-novo.php?erro');
                }else{
                    header('location: clinica-novo.php?sucesso');
                }

            }
            mysqli_Stmt_close($stmt);
        }
    }

    //Exclusão cadastro clinica
    if(isset($_POST['deleta'])){
        $id = mysqli_escape_string($conexao, $_POST['id']);
   
        $sql = "DELETE FROM tb_clinic WHERE id =?";
    
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