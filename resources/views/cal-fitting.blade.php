@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('slider')
    @include('layouts.slider')
@endsection

@section('content')

    <main id="main">

        <div class="max__container p-5">
            The data file should contain 2 columns without header: 1st column should be the temperature and the 2nd column should be the corresponding heat capacity.
            Don't forget to switch the temperature and heat capacity units if needed. You need to change also the number of repeat units and give initial values for fitting parameters. After that you can upload the file. The uploaded data will be converted units K for temperature and J/mol for heat capacity and be filled in the table. Then check if the data in table is filled properly. Then you can start fitting.
        </div>

        <div class="min__container">

            <livewire:cal-fitting />
            {{--<livewire:contact />--}}

        </div>

    </main>

@endsection