<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <mete name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Projeto Clinica</title>
    <link href="css/styles.css" rel="stylesheet" />
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/footer-with-button-logo.css">
</head>
<body class="sb-nav-fixed" style="font-family: Arial, Helvetica, sans-serif;">
<br><br><br><br><br>
<?php include_once("topo.php");?>
            <div id="layoutSidenav_content">
                <main>
                <div class="container-fluid" >
                    <div class="container">
                        <center>
                            <div class="col-lg-6">
                                <div class="card shadow-lg border-6 mt-4" style="border-color: #093741;">
                                    <div class="card-header" style="background-color: #3d7a7a;"><h3 class="text-center font-weight-light my-4" style="color: white"><b>Login</b></h3></div>
                                        <?php if(isset($_GET['logar'])){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            Você precisa estar logado no sistema para acessar essa página!
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php } ?>
                                    <div class="card-body">
                                        <form action="valida_login.php" method="POST">
                                            <div class="form-group">
                                                <label class="small mb-1" for="login_email">E-mail</label>
                                                <input class="form-control py-4" name="login_email" id="login_email" type="email" placeholder="Digite seu E-mail" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="senha">Senha</label>
                                                <input class="form-control py-4" name="senha" id="senha" type="password" placeholder="Digite sua senha" />
                                            </div>
                                            
                                            <div class="form-group d-flex align-items-center justify-content-center mt-3 mb-0">
                                                <input type="submit" name="btn-entrar" class="btn-outline-secondary border-8 btn-lg" style="color:#093741;" value="Entrar">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </center>
                    </div>
                </div>
            </main>
            <br><br>
            </form>
                            </div>
                        </div>
                    </div>
                </main>
                <br><br>
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