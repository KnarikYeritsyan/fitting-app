<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitting</title>
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap@5.2.0-beta1.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--<script src="js/chart.min.js"></script>-->
    @yield('topscript')
    @livewireStyles
</head>
<body>
<div class="wrapper">
    <header id="header">

        <div id="top__bar">
            <div class="min__container">

                <input id="check__menu" type="checkbox" class="check__menu">
                <div class="check__menu__block">
                    <label for="check__menu" class="menu__label">
                        <span></span><span></span><span></span>
                    </label>
                </div>

                <nav class="nav" id="menu">
                    <div class="logo">
                        <a href="{{route('guest')}}" class="logo__link">
                            <h1 class="h1">F<span class="logo__span">it</span>ti<span class="logo__span">ng</span></h1>
                        </a>
                    </div>

                    <ul class="nav__block">
                        <li class="nav__list"><a href="{{route('guest.examples')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.examples') ? 'active' : '' }}">EXAMPLES</a></li>
                        <li class="nav__list"><a href="{{route('guest.papers')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.papers') ? 'active' : '' }}">PAPERS</a></li>
                        <li class="nav__list"><a href="#" class="nav__link">FORMULAS</a></li>
                    </ul>
                </nav>
            </div>
        </div>

        @yield('slider')

    </header>

    @yield('content')

    <footer id="footer">
        <div class="footer__top">
            <a href="#"><i class="fa-solid fa-angles-up"></i></a>
        </div>
        <div class="footer__bottom">
            <div class="footer__left">
                <div class="footer__text">
                    <a href="{{route('guest.examples')}}">EXAMPLES</a>
                    <a href="{{route('guest.papers')}}">PAPERS</a>
                    <a href="#">FORMULAS</a>

                    <p class="footer__desc">Copyright &copy; 2022 <a href="#">KNARIK</a></p>
                    <p><a href="#">Licence</a> | Crafted with <i class="fa-solid fa-heart"></i> for <a
                                href="#">Knarik</a></p>
                </div>
            </div>
            <div class="footer__right">
                <div class="footer__link">
                    <p>SHARE THIS WITH YOUR FRIENDS</p>

                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href="" class="footer__a"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>

    </footer>
</div>
@include('cookie-consent::index')


<!--<script src="js/jquery-v3.6.0.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
{{--<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>--}}
{{--<script id="MathJax-script" async src="js/tex-mml-chtml.js"></script>--}}
<script id="MathJax-script" async src="js/tex-chtml.js"></script>
@livewireScripts
</body>
</html>