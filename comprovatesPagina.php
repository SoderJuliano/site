<!DOCTYPE html>
<?php 
include_once('carregarParcela.php'); ?>

<body>
<table class="table">
    <script>console.log('mostrarComprovantes');</script>
    <?php 
        mostrarComprovantes(getOnlineUser(), "2022"); 
    ?>
</table>
</body>
</html>