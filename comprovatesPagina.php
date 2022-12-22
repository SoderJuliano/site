<!DOCTYPE html>
<?php 
include_once('carregarParcela.php'); ?>

<body>
<table class="table">
    <?php 
        echo "<script>console.log(".getUserName().")</script>";
        echo "<script>console.log('retornou')</script>";
        mostrarComprovantes(getUserName(), getAnoVingente()); 
    ?>
</table>
</body>
</html>