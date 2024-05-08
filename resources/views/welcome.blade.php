@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('bottomscript')
    <script id="MathJax-script" async src="js/tex-chtml.js"></script>
@endsection

@section('slider')
    <div class="banner">

        <h2 class="banner__title">CD and DSC processing</h2>

        <p class="banner__desc">
            A responsive online tool,
            designed & developed for online Fitting of CD and DSC data.
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
                    <h3 class="article__title">WHAT OFFERS</h3>
                    <p class="article__desc">The online tool offers users the ability to upload and analyze circular dichroism (CD) and differential scanning calorimetry (DSC) data.
                        Users can visualize their data, obtain fitting parameters, and download results.
                    </p>
                </div>

            </article>

            <article class="article">
                <div class="icon__block"><i class="fa-solid fa-lightbulb"></i></div>
                <div class="article__block">
                    <h3 class="article__title">INPUT DATA</h3>
                    <p class="article__desc">
                        Accepts experimental data files in CSV, TXT, or DAT formats with two columns: the independent variable (temperature) and the corresponding dependent variable (CD or DSC signal).
                        Users can adjust units for different experimental setups.


                    </p>
                </div>

            </article>

            <article class="article">
                <div class="icon__block"><i class="fa-brands fa-react"></i></div>
                <div class="article__block">
                    <h3 class="article__title">THE FITTING MODEL</h3>
                    <p class="article__desc">  It employs the Zimm-Bragg model with solvent effects for fitting, utilizing Python's scipy library.
                        <a href="{{route('guest.examples')}}" class="arrow__link">Example datasets</a> and <a href="{{route('guest.formulas-and-papers')}}" class="arrow__link">theoretical explanations</a> are provided for guidance.
                    </p>
                </div>

            </article>
        </section>
        When \(a \ne 0\), there are two solutions to \(ax^2 + bx + c = 0\) and they are \(\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}\)
        $$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$
        $$\sum_{i=0}^n i^2 = \frac{(n^2+n)(2n+1)}{6}$$
    </div>

    <div class="min__container">


        <livewire:contact />

    </div>

</main>

@endsection