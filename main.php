<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Personal website">
    <meta name="keywords" content="HTML, CSS, JavaScript">
    <meta name="author" content="Juliano Soder">
    <title>Parcelas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <?php include_once('carregarParcela.php'); ?>

</head>

<body>
<div class="container">

<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        <span><i class="bi bi-card-checklist"></i> -></span>
        Visão geral das parcelas pagas e pendentes
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <h1>Parcelas</h1>
        <div class="card">
          <div class="card-header">
            <span>Todos os arquivos de
              <select id="selectAno" class="form-select" aria-label="Selecione o ano">
                <option value="2022" selected>2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
              </select>
            </span>
          </div>
          <ul id="conteudoCard" class="list-group list-group-flush">
          <?php lerTodosArquivos('2022') ?>
          </ul>
        </div>
      </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        <span><i class="bi bi-credit-card"></i> -></span>
        Lançar novas parcelas
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
      <form action="funcoes.php" method="GET">
        <p>
            Escolher quantidade de parcelas:
            <select name="quantidadeDeParcelas" value="1" class="form-select" aria-label="Default select example">
                <option value="0" selected>Este mês</option>
                <option value="2">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
        </p>
        <p>
            Valor:
        <div class="input-group mb-2">
                <span class="input-group-text">R$</span>
                <input name="valorDaParcela" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
        </div>
        </p>
        <p>
            <div class="input-group mb-2">
            <span class="input-group-text">Lançador do valor</span> 
            <script>
              const user = JSON.parse(localStorage.getItem('login'));
              document.write('<input name="lancadorParcela" value="'+user.name+'" class="input-group-text" />');
            </script>
            </div>
        </p>
        
        <button class="btn btn-primary"  type="submit" name="saveBnt" value="saveBnt">Salvar debito</button>

        </form>
      </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        <span><i class="bi bi-clipboard-check"></i> -></span>
        Anexar comprovantes
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        Em construção...  
      </div>
  </div>
</div>

</div>
</body>
<script src="options.js"></script>
<script>
  $("#selectAno").change(function (e) { 
    e.preventDefault();
      $.post('carregarParcela.php', { trocouAno: $("#selectAno").val() }, function(response) {
        $("#conteudoCard").html(response);
      });
  });

  function pagarParcela(nome) {
    console.log(nome);
    $.post('funcoes.php', { editarObj: nome }, function(response) {
      console.log(response);
      $.post('carregarParcela.php', { trocouAno: $("#selectAno").val() }, function(response) {
        $("#conteudoCard").html(response);
      });
    });
  }
  if(localStorage.getItem("login")){
      const user = JSON.parse(localStorage.getItem("login"));
      if(!validaLogin(user.name, user.senha)){
          window.location.href = "index.php";
      }
    }else{
      window.location.href = "/site/";
  }
</script>