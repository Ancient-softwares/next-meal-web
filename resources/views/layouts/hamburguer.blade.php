<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo')</title>

    <!-- Styles -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    {{-- Links --}}
    @yield('css')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
    @yield('js')

</head>

<body>

    <div class="sidebar close">
        <ul class="nav-links">
            <li class="img-logo">
                <div class="imagem">
                    <i class="bx logo">
                        <img src="{{ asset('img/logo-N-M-vermelho.png') }}" alt="">
                    </i>
                </div>
            </li>
            <li>
                <a href="{{ route('index') }}">
                    <i class='bx'>
                        <div class="icone">
                            <img src="{{ asset('img/sidebar/casa.png') }}" alt="">
                        </div>
                    </i>
                    <span class="link_name">Início</span>
                </a>

            </li>
            <li>
                <a href="{{ route('perfil-page') }}">
                    <i class='bx'>
                        <img src="{{ asset('img/sidebar/do-utilizador.png') }}" alt="">
                    </i>
                    <span class="link_name">Perfil</span>
                </a>

            </li>
            <li>
                <a href="{{ route('cardapio.index') }}">
                    <i class='bx'>
                        <img src="{{ asset('img/sidebar/book-alt.png') }}" alt="">
                    </i>
                    <span class="link_name">Cardápio</span>
                </a>

            </li>
            <li>
                <a href="{{ route('mesas.index') }}">
                    <i class='bx'>
                        <img src="{{ asset('img/sidebar/tabuleiro-de-jogo-alt.png') }}" alt="">
                    </i>
                    <span class="link_name">Mesas</span>
                </a>

            </li>
            <li>
                <a href="{{ route('reserva') }}">
                    <i class='bx'>
                        <img src="{{ asset('img/sidebar/usuarios-alt.png') }}" alt="">
                    </i>
                    <span class="link_name">Reservas</span>
                </a>

            </li>
            <li>
                <a href="/avaliacao">
                    <i class='bx'>
                        <img src="{{ asset('img/sidebar/usuarios-alt.png') }}" alt="">
                    </i>
                    <span class="link_name">Avaliações</span>
                </a>

            </li>
            <li>
                <a class="logout" href="/logout">
                    <i class='bx bx-log-out'></i>
                    <span class="link_name"> Sair</span>
                </a>

            </li>
        </ul>
    </div>
    <section class="home-section">

        <div class="home-content">
            <i class="bx bx-menu"></i>
        </div>

        <main>
            @yield('conteudo')
        </main>
    </section>

    <script>
        let btn = document.querySelector(".bx-menu");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector("bx-search");

        btn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>


</body>

</html>