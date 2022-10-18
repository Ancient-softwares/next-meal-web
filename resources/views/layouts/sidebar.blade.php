<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Links --}}
    @yield('css')
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    <script src="{{ asset('js/hamburguer.js') }}"></script>
    @yield('js')

    <title>@yield('titulo')</title>
</head>
<body>  
    <div class="container-sidebar">
        <aside>
            <h1 class="nomeUser">Olá, {{ $login }}!<h1>
        </aside>
  
        <header>
            <!-- <div class="hamburger">
                <div class="line" id="line1"></div> 
                <div class="line" id="line2"></div> 
                <div class="line" id="line3"></div> 
            </div> -->
            <nav>
                <ul class="menu-side">
                        <div class="imagem">
                            <img src="{{ asset('img/logo-N-M-vermelho.png') }}" alt="">
                        </div>
                        <li class="menu-sidebar">
                            <a href="{{ route('index') }}" class="menu-link">
                            <img src="{{ asset('img/sidebar/casa.png') }}" alt="">Início</a>   
                        </li>
                        <li class="menu-sidebar">
                            <a href="{{ route('perfil-page') }}" class="menu-link">
                            <img src="{{ asset('img/sidebar/do-utilizador.png') }}" alt="">Perfil</a>   
                        </li>
                        <li class="menu-sidebar">
                            
                            <a href="{{ route('cardapio.index') }}" class="menu-link">
                            <img src="{{ asset('img/sidebar/book-alt.png') }}" alt="">Cardápio</a>   
                        </li>
                        <li class="menu-sidebar">
                            <a href="{{ route('mesas.index') }}" class="menu-link">
                            <img src="{{ asset('img/sidebar/tabuleiro-de-jogo-alt.png') }}" alt="">Mesas</a>   
                        </li>
                        <li class="menu-sidebar">
                            <a href="/avaliacao" class="menu-link">
                            <img src="{{ asset('img/sidebar/usuarios-alt.png') }}" alt="">Avaliações</a>   
                        </li>
                        <div class="exit">
                            <a href="/logout" class="menu-link sair"><li class="menu-item">Sair</li></a>
                        </div>
                </ul>
            </nav>
            
        </header>
        <main>
            @yield('conteudo')
        </main>
    </div>
    
    
</body>
</html>