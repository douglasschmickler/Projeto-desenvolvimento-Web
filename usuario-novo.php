<?php

 $tipoUsuario=''; 
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
                        <h1 class="mt-4">Usuário</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Usuário</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-body">
								<a href="usuario-lista.php" type="button" class="btn btn-outline-primary">Lista de Usuários</a>
							</div>
                        </div>
                                <!--<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Não foi possivel realizar o cadastro do Usuário. Tente novamente!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    As senhas não conferem. Tente novamente!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Este usuário já está cadastrado. Tente novamente!
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Usuário cadastrado com <strong>sucesso!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                               <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Usuário atualizado com <strong>sucesso!</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>-->
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Novo Usuário</div>
                            <div class="card-body">
                                <form action="cadastro_usuario.php" method="POST">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
												<label class="small mb-1" for="usuario_email">E-mail Login</label>
												<input class="form-control" name="usuario_email" id="usuario_email" value="" type="email" placeholder="Login"/> 
											</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
        										<label class="small mb-1" for="usuario_senha">Senha</label>
        										<input class="form-control" name="usuario_senha" id="usuario_senha" type="password" value="" aria-describedby="emailHelp" placeholder="Informe sua senha" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="tipo_usuario">Tipo de Usuário</label>
                                                        <select id="tipo_usuario" name="tipo_usuario" class="form-control" >
                                                            <option <?=$tipoUsuario==" " ? "selected" : ""?> disable>Selecione...</option>
                                                        
                                                           <?php
                                                                $paciente = json_decode($_SESSION["paciente"]);
                                                               if(!isset($_SESSION['paciente']) || trim($paciente->tipoUsuario) == "paciente"){
                                                                    ?>  
                                                                  <option value="paciente" selected="selected">Paciente</option>  
                                                                  <option value="medico" selected="selected">Médico</option>  
                                                                  <?php
                                                                }else{
                                                                   ?>
                                                                  <option value="paciente" <?=$tipoUsuario=="paciente" ? "selected" : ""?>>Paciente</option> 
                                                                     <option value="medico" <?=$tipoUsuario=="medico" ? "selected" : ""?>> Médico</option>
                                                                   <?php
                                                                    }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                    <div class="form-group mt-4 mb-0">
										<input type="submit" name="bnt-cadastrar" class="btn btn-primary btn-block"  value="Salvar">
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