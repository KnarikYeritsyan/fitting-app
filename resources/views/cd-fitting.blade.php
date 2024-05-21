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
            The data file should contain 2 columns without header: 1st column should be the temperature and the 2nd column should be the corresponding order parameter (helicity degree).
            Don't forget to switch the temperature and heat capacity units if needed. You need to change also the number of repeat units in the case of short chains. After that you can upload the file. The uploaded data will be converted units K for temperature and the helicity degree will keep intact. Then check if the data in table is filled properly. Then you can start fitting.
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
            {{--<livewire:contact />--}}
        </div>

    </main>

@endsection