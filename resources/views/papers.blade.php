@extends('layouts.app')

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

    <div class="row-cols-1 p-5">
        <a href="https://doi.org/10.1038/s42004-021-00499-x" target="_blank">Implicit water model within the Zimm-Bragg
            approach to analyze experimental data for heat and
            cold denaturation of proteins</a><br>
        <a href="https://www.frontiersin.org/articles/10.3389/fnano.2022.982644/full" target="_blank">Processing helix-coil transition data: account
            of chain length and solvent effects</a>
    </div>

    <div class="min__container mt-5">

        <livewire:contact />

    </div>

</main>

@endsection