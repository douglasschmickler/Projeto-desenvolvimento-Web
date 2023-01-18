<?php

require_once "conexao.php"; //conexao com o banco de dados

$sql_usuario = 'SELECT * FROM tb_usuario';

$resultado_usuario = mysqli_query($conexao, $sql_usuario);


$tipo = '';

$id = "";
$id_usuario = "";
$nome = "";
$cpf = "";
$rg = "";
$data_nascimento = "";
$telefone = "";

if (isset($_GET['edicao'])) {

    $id = $_GET['edicao'];

    //echo"chegou";
    //echo $id;
    // die;


    $sql = "SELECT * FROM paciente WHERE id = ?";

    $stmt = mysqli_prepare($conexao, $sql); //preparando a conexao

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);

    $paciente = mysqli_fetch_assoc($resultado);


    $id = $paciente['id'];
    $id_usuario = $paciente['id_usuario'];
    $nome = $paciente['nome'];
    $cpf = $paciente['cpf'];
    $rg = $paciente['rg'];
    $data_nascimento = $paciente['data_nascimento'];
    $telefone = $paciente['telefone'];

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
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
        crossorigin="anonymous" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
    <?php include_once("topo.php"); ?>
    <div id="layoutSidenav">
        <?php include_once("menu.php"); ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Paciente</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Paciente</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            <a href="paciente-lista.php" type="button" class="btn btn-outline-primary">Lista de
                                Pacientes</a>
                        </div>
                    </div>
                    <?php if (isset($_GET['erro'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Não foi possivel realizar o cadastro do paciente. Tente novamente!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['senhadif'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            As senhas não conferem. Tente novamente!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['existe'])) { ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Este paciente já está cadastrada. Tente novamente!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['sucesso'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            paciente cadastrado com <strong>sucesso!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <?php if (isset($_GET['update'])) { ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            paciente atualizado com <strong>sucesso!</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-table mr-1"></i>Novo Paciente</div>
                        <div class="card-body">
                            <form action="cadastro_paciente.php?$id" method="POST">
                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                <!--<input type="hidden" name="id" value="<?= $id ?>">-->
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="tipo">Usuário</label>
                                            <select id="id" name="id" required
                                                class="form-control select-tb_paciente">
                                                <option selected disabled>Selecione...</option>
                                                <?php
                                                while ($dados = mysqli_fetch_array($resultado_usuario)) {
                                                    if ($id == $dados['usuario_id']) {
                                                        $seleciona = 'selected="selected"';
                                                    } else {
                                                        $seleciona = '';
                                                    }
                                                    echo '<option value="' . $dados['usuario_id'] . '" ' . $seleciona . '>' . $dados['usuario_email'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="nome">Nome</label>
                                            <input class="form-control" name="nome" id="nome"
                                                value="<?php echo $nome; ?>" type="text" placeholder="nome" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="cpf">CPF</label>
                                            <input class="form-control" name="cpf" id="cpf" value="<?php echo $cpf; ?>"
                                                type="text" placeholder="cpf" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="rg">RG</label>
                                            <input class="form-control" name="rg" id="rg" value="<?php echo $rg; ?>"
                                                type="text" placeholder="rg" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="data_nascimento">Data de Nascimento</label>
                                            <input class="form-control" name="data_nascimento" id="data_nascimento"
                                                value="<?php echo $data_nascimento; ?>" type="text"
                                                placeholder="data_nascimento" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="telefone">Telefone</label>
                                            <input class="form-control" name="telefone" id="telefone"
                                                value="<?php echo $telefone; ?>" type="text" placeholder="telefone" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4 mb-0">
                                    <!--   <input type="submit" name="bnt-cadastrar" class='btn btn-primary btn-block id=".<?php$id?>"' value="Salvar"> -->

                                    <input type="submit" name="bnt-cadastrar" class='btn btn-primary btn-block'
                                        value="Salvar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php include_once("rodape.php"); ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/datatables-demo.js"></script>
</body>

</html>