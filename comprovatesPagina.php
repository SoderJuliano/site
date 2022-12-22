<!DOCTYPE html>
<?php 
include_once('carregarParcela.php'); ?>

<body>
<table class="table">
    <?php 
        mostrarComprovantes(getUserName(), getAnoVingente()); 
    ?>
</table>
</body>
</html>