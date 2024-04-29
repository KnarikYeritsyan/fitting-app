@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
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

        <div class="max__container p-5">
            The data file should contain 2 columns without header: 1st column should be the temperature and the 2nd column should be the corresponding heat capacity.
            Don't forget to switch the temperature and heat capacity units if needed. You need to change also the number of repeat units and give initial values for fitting parameters. After that you can upload the file. The uploaded data will be converted units K for temperature and J/mol for heat capacity and be filled in the table. Then check if the data in table is filled properly. Then you can start fitting.
        </div>

        <div class="min__container">

            <livewire:cal-fitting />
            <livewire:contact />

        </div>

    </main>

@endsection