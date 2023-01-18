<?php
    
    require_once "conexao.php"; //conexao com o banco de dados

        $id = "";
        $nome_fantasia = "";
        $endereco = "";
        $cep = "";
        $razao_social = "";
        $numero = "";

    if(isset($_GET['edicao'])){ 

        $id = $_GET['edicao'];

        //echo"chegou";
        //echo $id;
       // die;


        $sql = "SELECT * FROM clinica WHERE id = ?";

        $stmt = mysqli_prepare($conexao, $sql); //preparando a conexao
     
        mysqli_stmt_bind_param($stmt, "i", $id); 
        mysqli_stmt_execute($stmt); 

        $resultado = mysqli_stmt_get_result($stmt); 

        $clinica = mysqli_fetch_assoc($resultado);


        $id= $clinica['id'];
        $nome_fantasia = $clinica['nome_fantasia'];
        $endereco = $clinica['endereco'];
        $cep = $clinica['cep'];
        $razao_social = $clinica['razao_social'];
        $numero = $clinica['numero'];
    }
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
                        <h1 class="mt-4">clinica</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">clinica</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
								<a href="clinica-lista.php" type="button" class="btn btn-outline-primary">Lista de Clinicas</a>
							</div>
                        </div>
                                <?php if(isset($_GET['erro'])){?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Não foi possivel realizar o cadastro da clinica. Tente novamente!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET['senhadif'])){?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                As senhas não conferem. Tente novamente!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET['existe'])){ ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Está clinica já está cadastrada. Tente novamente!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET['sucesso'])){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Clínica cadastrada com <strong>sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <?php if(isset($_GET['update'])){ ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                Clínica atualizada com <strong>sucesso!</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Novo Usuário</div>
                            <div class="card-body">
                                <form action="cadastroclinica.php?$id" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id;?>"/>
                                    <!--<input type="hidden" name="id" value="<?=$id?>">-->
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label class="small mb-1" for="nome_fantasia">Nome Fantasia</label>
												<input class="form-control" name="nome_fantasia" id="nome_fantasia" value="<?php echo $nome_fantasia;?>" type="text" placeholder="nome_fantasia"/> 
											</div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="endereco">Endereço</label>
                                                <input class="form-control" name="endereco" id="endereco" value="<?php echo $endereco;?>" type="text" placeholder="endereco"/> 
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="cep">CEP</label>
                                                <input class="form-control" name="cep" id="cep" value="<?php echo $cep;?>" type="text" placeholder="cep"/> 
                                            </div>
                                             <div class="form-group">
                                                <label class="small mb-1" for="numero">Número</label>
                                                <input class="form-control" name="numero" id="numero" value="<?php echo $numero;?>" type="text" placeholder="número"/> 
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="razao_social">Razão Social</label>
                                                <input class="form-control" name="razao_social" id="razao_social" value="<?php echo $razao_social;?>" type="text" placeholder="razao_social"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                     <!--   <input type="submit" name="bnt-cadastrar" class='btn btn-primary btn-block id=".<?php$id?>"' value="Salvar"> -->

                                        <input type="submit" name="bnt-cadastrar" class='btn btn-primary btn-block' value="Salvar">
                                    </div>
                                </form>
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
    </body>
</html>