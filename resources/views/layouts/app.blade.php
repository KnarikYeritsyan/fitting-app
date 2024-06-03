<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitting</title>
    <link rel="icon" type="image/png" href="/images/faveicon.png">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap@5.2.0-beta1.min.css">
    <link rel="stylesheet" href="/css/style.css">
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
                            <h1 class="h1">F<span class="logo__span">it</span>F<span class="logo__span">old</span>D<span class="logo__span">ata</span></h1>
                        </a>
                    </div>

                    <ul class="nav__block">
                        <li class="nav__list"><a href="{{route('guest.cd-fitting')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.cd-fitting') ? 'active' : '' }}">CD</a></li>
                        <li class="nav__list"><a href="{{route('guest.cal-fitting')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.cal-fitting') ? 'active' : '' }}">DSC</a></li>
                        <li class="nav__list"><a href="{{route('guest.examples')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.examples') ? 'active' : '' }}">EXAMPLES</a></li>
                        <li class="nav__list"><a href="{{route('guest.formulas-and-papers')}}" class="nav__link {{ (Route::currentRouteName() == 'guest.formulas-and-papers') ? 'active' : '' }}">FORMULAS and PAPERS</a></li>
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
                    <a href="{{route('guest.cd-fitting')}}">CD</a>
                    <a href="{{route('guest.cal-fitting')}}">DSC</a>
                    <a href="{{route('guest.examples')}}">EXAMPLES</a>
                    <a href="{{route('guest.formulas-and-papers')}}">FORMULAS and PAPERS</a>

                    <p class="footer__desc">The research was done by K. Yeritsyan and A. Badasyan within the PhD project</p>
                    <p>Materials Research Laboratory, University of Nova Gorica, Slovenia</p>
                    <p>The website was developed by K. Yeritsyan, &copy; {{ now()->year }} FitFoldData. All rights reserved.</p>
                    <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a>
                </div>
            </div>
            <div class="footer__right">
                <div class="footer__link">
                    <p>For inquiries, contact us at</p>

                    <a href="mailto:knarik.yeritsyan@gmail.com?subject=FitFoldData"><i class="fa-solid fa-envelope"></i></a>
                    <a href=""><i class="fa-brands fa-twitter"></i></a>
                    <a href="" class="footer__a"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>

    </footer>
</div>
@include('cookie-consent::index')


<!--<script src="js/jquery-v3.6.0.min.js"></script>-->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/script.js"></script>
{{--<script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>--}}
{{--<script id="MathJax-script" async src="js/tex-mml-chtml.js"></script>--}}
@yield('bottomscript')
@livewireScripts
</body>
</html>