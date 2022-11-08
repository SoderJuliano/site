<!doctype html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal website">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Juliano Soder">
    <title>Detalhes</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <?php 
        include_once('funcoes.php');    
    ?>
</head>

<?php 
    $pegarParcela = $_GET['detalhesObjeto'];
    $apagarParcela = $_GET['bntTrash'];

    if($pegarParcela){
        $parcela = getObjectByName($pegarParcela);
    }elseif($pegarParcela == null && $apagarParcela){
        deleteFile($apagarParcela);
    }
?>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">     
                            <?php echo $parcela->nome; ?>
                        </h3>
                    </div>
                    <p>Status: <?php echo $parcela->pago == "true" ? "pago" : "falta pagar"; ?></p>
                    <p>data limite para pagamento: <?php echo $parcela->dataPagamento; ?></p>
                    <p>valor: <?php echo "R$ ".$parcela->valorDaParcela; ?></p>
                    <p>parcela numero de registro: <?php echo $parcela->parcela; ?></p>
                    <p>Nome do lançador da parcela: <?php echo $parcela->lancador; ?></p>
                    <button type="button" class="btn btn-primary" id="voltar" >Voltar</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $("#voltar").click(function () {
        window.location.href = "/site/main.php";
    });
</script>