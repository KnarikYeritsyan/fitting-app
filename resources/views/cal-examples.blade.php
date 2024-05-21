@extends('layouts.app')

@section('topscript')
    <script src="js/plotly-2.12.1.min.js"></script>
@endsection

@section('slider')
    @include('layouts.slider')
@endsection

@section('content')

    <main id="main">

        <div class="min__container">

            <livewire:cal-examples />
            {{--<livewire:contact />--}}

        </div>

    </main>

@endsection