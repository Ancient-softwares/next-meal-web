<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NextMeal</title>
  <link rel="icon" href="{{ asset('img/iconNM.png')}}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
  <script src="{{ asset('js/jquery.mask.min.js') }}"></script>

  <script src="{{ asset('js/validarCep.js') }}"></script>

  <script>
    $(document).ready(function($) {
      $("#telefone").mask("(00) 0000-00000");
      $("#cep").mask("00000-000");
      $("#cnpj").mask("99.999.999/9999-99");


    });
  </script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="{{ asset('css/utsukushi.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/footerDeDoido.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('css/Responsive.css') }}" rel="stylesheet" type="text/css">
  <!-- Carousel Style -->
  <link href="{{ asset('css/carousel.css') }}" rel="stylesheet" type="text/css">

</head>

<body>
  <!--NavBar-->
  <header>
    <div class="container">
      <img src="{{ asset('img/logo-N-M-branco.png') }}" alt="Rocketseat" />
      <div class="menu-section">
        <div class="menu-toggle">
          <div class="one"></div>
          <div class="two"></div>
          <div class="three"></div>
        </div>
        <nav>
          <ul>
            <li>
              <a href="#">Home</a>
            </li>
            <li>
              <a href="#Download">Aplicativo</a>
            </li>
            <li>
              <a id="btn-login" href="#Login">Login</a>
            </li>
            <li>
              <a id="btn-registro" href="#Registro">Registro</a>
            </li>
            <li>
              <a href="#Contato">Contato</a>
            </li>
          </ul>
        </nav>
      </div>
    </div>

  </header>

  <!-- -->
  <div id="modalLogin" class="modal">
    <div class="modal-content">
      <h2 class="Registro-cadrastar-style">Login</h2>
      <hr>
      <div class="corpin">
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
          {{ $errors->first() }}
        </div>
        @endif
        <form method="POST" action="{{ route('autenticar') }}">
          @csrf
          <label>E-mail: </label>
          <input type="email" name="email">

          <label>Senha: </label>
          <input type="password" name="senha">
          <div class="btn-login">

            <input type="submit" class=" btn btn-outline-danger" value="Entrar">
          </div>
          Ainda não possui uma conta?<a class="btn-abreModalRegistro" id="btn-abrirRegistro">Registrar-se</a>
        </form>
      </div>
    </div>
  </div>

  <!---->



  <div id="modalRegistro" class="modal">
    <div class="modal-content" class="conteudo">
      <h2 class="Registro-cadrastar-style">Registro do restaurante</h2>
      <hr>
      <div class="corpin">
        @if($errors->any())
        <div class="alert alert-danger" role="alert">
          {{ $errors->first() }}
        </div>
        @endif

        <form id="regForm" method="POST" action="{{ route('registrar') }}">
          @csrf
          <div class="tab">
            <label>Nome do restaurante: </label>
            <input type="text" name="nome">
            <br>

            <div class="row">
              <div class="col-sm-6">
                <label>Telefone do restaurante: </label>
                <input type="text" name="telefone" id="telefone">
              </div>
              <div class="col-sm-6">
                <label>CNPJ do restaurante: </label>
                <input type="text" name="cnpj" id="cnpj">
              </div>
            </div>


            <div class="row">
              <div class="col-sm-6">
                <label>E-mail: </label>
                <input type="email" name="email">
              </div>
              <div class="col-sm-6">
                <label>Senha: </label>
                <input type="password" name="senha">
              </div>
            </div>
          </div>
          <div class="tab">
            <div class="row">
              <div class="col-sm-5">
                <label>Cep:
                  <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);" /></label>
              </div>
              <div class="col-sm-5">
                <label>Rua: <input name="rua" type="text" id="rua" /> </label>
              </div>
              <div class="col-sm-2">
                <label>Estado:
                  <input name="uf" type="text" id="uf" /></label>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <label>Bairro:
                  <input name="bairro" type="text" id="bairro" /></label>
              </div>
              <div class="col-sm-5">
                <label>Cidade:
                  <input name="cidade" type="text" id="cidade" /></label>
              </div>
              <div class="col-sm-2">
                <label>Numero: </label>
                <input type="text" name="numero" id="numero">
                <br>
              </div>
            </div>
          </div>
          <div class="tab">
            <div class="col-sm-12">
              <label>Capacidade máxima do restaurante: </label>
              <input type="number" name="capacidade" id="capacidade">
              <br>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Tipo do restaurante: </label>
                <select name="tipoRestaurante" id="tipoRestaurante" onChange="return showTipoNovo()">
                  @foreach($tipos as $tipo)
                  <option value="{{ $tipo->idTipoRestaurante }}">{{ $tipo->tipoRestaurante }}</option>
                  @endforeach
                  <option value="0">Outros</option>
                </select>
              </div>
              <div class="col-sm-6">
                <div class="escondido" id="novoTipo" style="visibility:hidden">
                  <label>Novo tipo de restaurante: </label>
                  <input type="text" name="novo" id="novo" value="-">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <label>Horário de abertura: </label>
                <input type="time" name="horarioabertura" id="horarioabertura">
                <br>
              </div>
              <div class="col-sm-6">
                <label>Horário de fechamento: </label>
                <input type="time" name="horariofechamento" id="horariofechamento">
                <br>
              </div>
            </div>
          </div>

          Já possui login? <a class="edit-entra-registro" type="button" id="btn-abrirLogin">Entrar</a>
          <div class="d-grid gap-2">
            <div style="overflow:auto;">
              <div style="float:right;">
                <div class="btn-group">
                  <button type="button" class="btn btn-outline-danger btn-proxAnterior" id="prevBtn" onclick="nextPrev(-1)">Anterior</button>
                  <button type="button" class="btn btn-outline-danger btn-proxAnterior" id="nextBtn" onclick="nextPrev(1)">Próximo</button>
                </div>
              </div>
            </div>
          </div>
          <div style="text-align:center;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
        </form>







      </div>
    </div>
  </div>

  <!---->





  <div class="slider">
    <div class="slides">
      <input type="radio" name="radio-btn" id="radio1">
      <input type="radio" name="radio-btn" id="radio2">

      <div class="slide frist">
        <img src="{{ URL::asset('img/header.png')}}" alt="">
      </div>
      <div class="slide">
        <img src="{{ URL::asset('img/header2.png')}}" alt="">
      </div>


      <div class="navigation-auto">
        <div class="auto-btn1"></div>
        <div class="auto-btn2"></div>
      </div>

      <div class="navigation-manual">
        <label for="radio1" class="manual-btn"></label>
        <label for="radio2" class="manual-btn"></label>
      </div>
    </div>
  </div>


  <!--NavBar-->
  <main>
    <div class="BackColor2">
      <section class="hero">
        <div class="BoxContainer">
          <div class="slideshow-container">

            <div class="mySlides">
              <img src="{{ URL::asset('img/slide1.jpg') }}" style="width:100%">
            </div>

            <div class="mySlides">
              <img src="{{ URL::asset('img/slide2.jpg') }}" style="width:100%">
            </div>

            <div class="mySlides">
              <img src="{{ URL::asset('img/slide3.jpg') }}" style="width:100%">
            </div>

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

          </div>
          <div class="Info">
            <img class="image" src="{{ URL::asset('img/logoNextRed.png') }}" />
            <p>O Next Meal é uma solução web e mobile para reduzir as filas de restaurantes,
              ajudando mais de 10mil pessoas por dia.</p>
          </div>
        </div>
      </section>

      <div class="BoxVideo">
        <div class="text">
          <h2>Aplicativo</h2>
          <h3>O Next Meal permite você reservar mesas de forma rápida e simples possibilitando também consultas de
            restaurantes próximos de sua localização.</h3>
        </div>
        <video autoplay muted loop class="VideoBack">
          <source class="VideoV" src="{{ URL::asset('img/back.mp4') }}" type="video/mp4">
        </video>
      </div>
    </div>

    <div class="BackColor">
      <div class="Vantagens">
        <h2>Vantagens</h2>
        <div class="container">
          <div class="boxV">
            <div class="titleV">
              <h3>Esteja à frente da concorrência.</h3>
            </div>
            <p>Conosco, o seu restaurante será movimentado da forma correta, onde poderão escolher o seu estabelecimento!
            </p>
          </div>
          <div class="boxV">
            <div class="titleV">
              <h3>Melhorar a logística do seu negócio.</h3>
            </div>
            <p>Melhoria em organização, gerando agilidade no atendimento ao seu cliente.
            </p>
          </div>
          <div class="boxV">
            <div class="titleV">
              <h3>Experiência que gera fidelidade do cliente.</h3>
            </div>
            <p>Uma solução perfeita para você construir a fidelidade com seu cliente.
              O NextMeal é a ponte entre o seu negócio e o público-alvo.
            </p>
          </div>
          <div class="boxV">
            <div class="titleV">
              <h3>Optar pelo seu estabelecimento</h3>
            </div>
            <p>Utilizando o nosso sistema de reservas o seu cliente estará ligado diretamente ao seu restaurante
              pois poderá escolher você!!
            </p>
          </div>
        </div>
        <div class="bottonV">
          <div class="letsGo">
            <a id="btn-registro" href="#"> Vamos lá?</a>
          </div>
        </div>
      </div>

      <div class="Download" id="Download">
        <div class="container">
          <img class="boxIMG" src="{{ URL::asset('img/dwon.png') }}">
          <div class="box">
            <h2>Download</h2>
            <div class="iOSAndroid">
              <button class="Android">
                <a href="#"><img src="{{ URL::asset('img/and.png') }}"></a>
                <h5 class="card-title">Play Store</h5>
              </button>
              <button class="iOS">
                <a href="#"><img src="{{ URL::asset('img/ios.png') }}"></a>
                <h5 class="card-title">App Store</h5>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>


  </main>


  <footer>
    <section class="footer">
      <div class="Contato" id="Contato">
        <div class="footer-header">
          <h2>Redes sociais</h2>
          <ul class="rede">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li><a href="#"><i class="fa fa-github"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
          </ul>
        </div>
        <div class="footer-content">
          <h3>"Lazer Sem Filas"</h3>
          <p>@NextMeal</p>
        </div>
      </div>
    </section>
  </footer>

  <button id="topBtn"><i class="fas fa-arrow-up"></i></button>

  <script src="{{ asset('js/carousel.js') }}"></script>
  <script src="{{ asset('js/hamburguer.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
  <script src="{{ asset('js/Modal.js') }}"></script>
  <script src="{{ asset('js/back-top.js') }}"></script>
  <script src="{{ asset('js/registroHome/teste.js') }}"></script>
  <script src="{{ asset('js/registroHome/jquery-3.6.1.min.jss') }}"></script>
  <script>
    function showTipoNovo() {
      var selectBox = document.getElementById('tipoRestaurante');
      var userInput = selectBox.options[selectBox.selectedIndex].value;
      if (userInput == "0") {
        document.getElementById('novoTipo').style.visibility = 'visible';
        document.getElementById('novo').value = '';
      } else {
        document.getElementById('novoTipo').style.visibility = 'hidden';
        document.getElementById('novo').value = '-';
      }
      return false;
    }
  </script>
</body>

</html>