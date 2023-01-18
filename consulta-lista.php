<?php

    require_once "conexao.php"; //conexao com o bd

    $sql = "SELECT data_consulta, descricao_consulta, status_consulta FROM tb_consulta";
    $resultado = mysqli_query($conexao, $sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Sistema Web</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    <body class="sb-nav-fixed">
       <?php include_once("topo.php");?>
        <div id="layoutSidenav">
            <?php include_once("menu.php");?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Consultas</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Consulta</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
								<a href="consulta-novo.php" type="button" class="btn btn-outline-primary">+ Consulta</a>
							</div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fa fa-list-ul"></i> Lista de Consultas</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Id Paciente</th>
                                                <th>Id Médico</th>
                                                <th>Data Consulta</th>
                                                <th>Descricao</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Código</th>
                                                <th>Id Paciente</th>
                                                <th>Id Médico</th>
                                                <th>Data Consulta</th>
                                                <th>Descricao</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                                while($dados = mysqli_fetch_array($resultado)) {
                                                    echo "<tr>";
                                                        echo "<td>".$dados['id']."</td>";
                                                        echo "<td>".$dados['id_paciente']."</td>";
                                                        echo "<td>".$dados['id_medico']."</td>";
                                                        echo "<td>".$dados['data_consulta']."</td>";
                                                        echo "<td>".$dados['descricao']."</td>";
                                                        echo "<td>".$dados['status']."</td>";
                                                        echo "<td>";

                                                    //passando id do registro que sera alterado para uma variavel
                                                    //passando a informação do codigo via get
                                                        echo "<a href='consulta-novo.php?edicao=".$dados['id']."'>";
                                                            echo "<i class='fa fa-pencil-square-o' aria-hidden='true'> </i>";

                                                        echo "<a href='#'class='deleta' id=".$dados['id']."'>";
                                                            echo "<i class='fa fa-trash' aria-hidden='true'> </i> ";
                                                             
                                                        echo "</td>";
                                                        echo"</tr>";                                                    
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
               <?php include_once("rodape.php");?>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>

        <script type="text/javascript">
                
            $('.deleta').bind('click',function(){ //será executada quando a classe for clicada
                var id = this.id;
                if(confirm('Deseja excluir o registro de código: ' +id)){ //confirmando se deseja mesmo excluir o usuario com esse id
                    $.ajax({ //passando para o arquivo cadastrar o id do usuario que será deletado
                        url : 'cadastro_consulta.php',
                        type: 'POST',
                        data: { //data significa os registros
                            deleta: true,  //variavel deleta está recebendo o valor true
                            consulta_id: id
                        },
                        success: function(response){  //sucesso se tudo der certo 
                            if(response != 1){
                                alert('Consulta deletada com sucesso!');
                                location.reload();
                            }else{ 
                                alert('Código inválido!');
                            }
                        }

                    });
                }
            }); 

        </script>

        
    </body>
</html>