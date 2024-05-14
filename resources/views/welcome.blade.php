@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('bottomscript')
    <script id="MathJax-script" async src="js/tex-chtml.js"></script>
@endsection

@section('slider')
    @include('layouts.slider')
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
        <h5 class="mt-5 mb-5 d-flex justify-content-center text-danger">
            By utilizing WaterProd for your analysis, you acknowledge the importance of citing the publications that outline the original methods and reference data employed, along with referencing the specific papers associated with WaterProd:
        </h5>
        Badasyan, A., Tonoyan, S., Valant, M., & Grdadolnik, J. (2021). Implicit water model within the Zimm-Bragg approach to analyze experimental data for heat and cold denaturation of proteins. Communications chemistry, 4(1), 57.
        <a href="https://doi.org/10.1038/s42004-021-00499-x" target="_blank">DOI</a>
        <br>
        <br>
        Yeritsyan, K., Valant, M., & Badasyan, A. (2022). Processing helix–coil transition data: Account of chain length and solvent effects. Frontiers in Nanotechnology, 4, 982644.
        <a href="https://doi.org/10.3389/fnano.2022.982644" target="_blank">DOI</a>
        <br>
        <br>
        Badasyan, A. (2021). System size dependence in the zimm–bragg model: Partition function limits, transition temperature and interval. Polymers, 13(12), 1985.
        <a href="https://doi.org/10.3390/polym13121985" target="_blank">DOI</a>
    </div>

    <div class="min__container">


        <livewire:contact />

    </div>

</main>

@endsection