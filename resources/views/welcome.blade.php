@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('slider')
    <div class="banner">

        <h2 class="banner__title">Fitting, Plotting, win!</h2>

        <p class="banner__desc">
            A responsive one page website,
            designed & developed exclusively for online Fitting.
        </p>

        <button type="button" class="banner__btn">GO TO FITTING</button>

        <button type="button" class="banner__btn">LEARN MORE</button>

        <div class="arrow">
            <a href="" class="arrow__link"><i class="fa-solid fa-angles-down"></i></a>
        </div>
    </div>
@endsection

@section('content')

<main id="main">
    <div class="max__container">
        <section class="section">
            <article class="article">
                <div class="icon__block"><i class="fa-solid fa-pen-ruler"></i></div>
                <div class="article__block">
                    <h3 class="article__title">EASILY CUSTOMISED</h3>
                    <p class="article__desc">Easily customise Sedna to suit your start up,
                        portfolio or product. Take advantage of the layered Sketch file
                        and bring your product to life.

                    </p>
                </div>

            </article>

            <article class="article">
                <div class="icon__block"><i class="fa-solid fa-lightbulb"></i></div>
                <div class="article__block">
                    <h3 class="article__title">MODERN DESIGN</h3>
                    <p class="article__desc">Designed with modern trends and techniques
                        in mind, Sedna will help your product stand out in an already saturated market.

                    </p>
                </div>

            </article>

            <article class="article">
                <div class="icon__block"><i class="fa-brands fa-react"></i></div>
                <div class="article__block">
                    <h3 class="article__title">RESPONSIVE DEVELOPMENT</h3>
                    <p class="article__desc"> Built using the latest web teachnologies
                        like html5, css3, and jQuery, rest assured Sedna will look
                        smashing on every device under the sun.

                    </p>
                </div>

            </article>
        </section>
        When \(a \ne 0\), there are two solutions to \(ax^2 + bx + c = 0\) and they are \(\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}\)
        $$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$
        $$\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}$$
    </div>

    <div class="min__container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Large N</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Small N</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <livewire:fit-data />
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <livewire:plot-data />
            </div>
        </div>



        <livewire:contact />

    </div>

</main>

@endsection