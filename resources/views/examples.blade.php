@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('slider')
    @include('layouts.slider')
@endsection

@section('content')

<main id="main">

    <div class="min__container mt-4 mb-4">
        <div class="d-flex justify-content-center">
        <a type="button" class="btn btn-success" style="margin-right: 5em" href="{{route('guest.cd-examples')}}">Examples CD</a>
        <a type="button" class="btn btn-success" href="{{route('guest.cal-examples')}}">Examples DSC</a>
        </div>
        {{--<livewire:contact />--}}
    </div>

</main>

@endsection