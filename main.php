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
    <script src="options.js"></script>
</head>

<script>
    if(localStorage.getItem("login")){
        const user = JSON.parse(localStorage.getItem("login"));
        if(!validaLogin(user.name, user.senha)){
            window.location.href = "index.php";
        }else{
        $.post('login.php', { loginName: user.name, loginAno: user.anoVigente }, function(response) {
            console.log('login efetuado');
        });
        }
    }else{
        window.location.href = "/site/";
    }
</script>
<body>

<div class="container">
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./img/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      <img src="./img/php.png" alt="" width="40" height="30" class="d-inline-block align-text-top">
      Feito usando Bootstrap & PHP
    </a>
  </div>
</nav>  
        <div class="row align-items-center">
          <div class="col-12 col-md-5 col-lg-6 order-md-2">

            <!-- Image -->
            <img src="./img/illustration.png" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0 aos-init aos-animate" alt="..." data-aos="fade-up" data-aos-delay="100">

          </div>
          <div class="col-12 col-md-7 col-lg-6 order-md-1 aos-init aos-animate" data-aos="fade-up">

            <!-- Heading -->
            <h1 class="display-3 text-center text-md-start">
              Bem vindo ao <span class="text-primary">site de parcelas</span>. <br>
              Juliano Soder 
              <div class="text-center text-md-start">
                <a href="https://www.linkedin.com/in/julianosoder/" class="btn btn-primary shadow lift me-1">
                  linkedin <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
                </a>
                <a href="https://github.com/SoderJuliano/site" class="btn btn-primary shadow lift me-1">
                  Ver código no github <i class="fe fe-arrow-right d-none d-md-inline ms-3"></i>
                </a>
            </div>
            </h1>

          </div>
        </div> <!-- / .row -->
      </div> <!-- / .container -->
    
<div class="container">

<div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      
      <button id="visaoParcelas" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        <h3><i class="bi bi-card-checklist"></i> -></h3>
        <h3>Visão geral das parcelas pagas e pendentes</h3>
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
        <h3><i class="bi bi-credit-card"></i> -></h3>
          <h3>Lançar novas parcelas</h3>
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
              if(!user){
                window.location.href = 'index.php';
              }
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
        <h3><i class="bi bi-clipboard-check"></i> -></h3>
          <h3>Comprovantes</h3>
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <?php
          include_once('comprovatesPagina.php');
        ?>
      </div>
  </div>
</div>

</div>
</body>
<script>
  $("#selectAno").change(function (e) { 
    e.preventDefault();
      $.post('carregarParcela.php', { trocouAno: $("#selectAno").val() }, function(response) {
        $("#conteudoCard").html(response);
        $.post('login.php', { loginAno: $("#selectAno").val() }, function(response) {
            console.log('alterado ano vingente');
            atualizaAnovigente("Teste", response);
        });
      });
  });

  function pagarParcela(nome, img) {
    console.log(img);
    $.post('funcoes.php', { editarObj: nome, comprovante: img }, function(response) {
      console.log(response);
      $.post('carregarParcela.php', { trocouAno: $("#selectAno").val() }, function(response) {
        $("#conteudoCard").html(response);
      });
    });
  }

  $( document ).ready(function() {
    $("#visaoParcelas").click();
  });

function readFile() {
        if (!this.files || !this.files[0]) return;
        const FR = new FileReader();
    
        FR.addEventListener("load", function(evt) {
            //document.querySelector("#img").src         = evt.target.result;
            document.querySelector("#b64").textContent = evt.target.result;
    }); 
    
FR.readAsDataURL(this.files[0]);  
document.getElementById("pagar-bnt").disabled = false;
$("#b64").hide();

}

document.querySelector("#inp").addEventListener("change", readFile);
document.getElementById("inp").value = "";

document.getElementById("inp").value == "" ? document.getElementById("pagar-bnt").disabled = true : document.getElementById("pagar-bnt").disabled = false;
</script>