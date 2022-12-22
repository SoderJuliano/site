<!DOCTYPE html>
<?php 
include_once('carregarParcela.php'); ?>

<body>
<select id="selectAnoComprovantes" class="form-select" aria-label="Selecione o ano">
    <option value="2022" selected>2022</option>
    <option value="2023">2023</option>
    <option value="2024">2024</option>
    <option value="2025">2025</option>
</select>
<table id="tableBody" class="table">
    <script>
        $.post('carregarParcela.php', { userName: "Teste", trocouAno: $("#selectAnoComprovantes").val() }, function(response) {
            $("#tableBody").html(response);
            atualizaAnovigente("Teste", $("#selectAno").val());
        });
    </script>
</table>
<script>
    $("#selectAnoComprovantes").change(function (e) { 
        e.preventDefault();
        $.post('carregarParcela.php', { userName: $("#nav-bar").text(), trocouAno: $("#selectAnoComprovantes").val() }, function(response) {
            $("#tableBody").html(response);
            atualizaAnovigente("Teste", $("#selectAno").val());
        });
    });
</script>
</body>
</html>