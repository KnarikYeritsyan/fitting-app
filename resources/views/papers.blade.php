@extends('layouts.app')

@section('slider')
    @include('layouts.slider')
@endsection

@section('content')

<main id="main">

    <div class="row-cols-1 p-5">
        [1] <a href="https://doi.org/10.1038/s42004-021-00499-x" target="_blank">Implicit water model within the Zimm-Bragg
            approach to analyze experimental data for heat and
            cold denaturation of proteins</a><br>
        [2] <a href="https://www.frontiersin.org/articles/10.3389/fnano.2022.982644/full" target="_blank">Processing helix-coil transition data: account
            of chain length and solvent effects</a>
    </div>

    <div class="min__container mt-5">

        <livewire:contact />

    </div>

</main>

@endsection