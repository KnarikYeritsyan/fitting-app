@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('slider')
    @include('layouts.slider')
@endsection

@section('content')

<main id="main">

    <div class="min__container mt-4">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Large N</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Small N</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <livewire:fit-data-example />
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <livewire:plot-data-example />
            </div>
        </div>

        {{--<livewire:contact />--}}

    </div>

</main>

@endsection