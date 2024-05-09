@extends('layouts.app')

@section('slider')
    @include('layouts.slider')
@endsection

@section('bottomscript')
    <script id="MathJax-script" async src="js/tex-chtml.js"></script>
    <script>
        window.MathJax = {
            tex: {
                tags: 'ams'
            }
        };
    </script>
@endsection

@section('content')

<main id="main">

    <div class="min__container mt-5">
        <h5>The formulas according to with the fittings were done are in this page. Please cite the literature if used.</h5>
        The characteristic equation for standard Zimm-Bragg model is [1]:
        \begin{equation}\label{characteristicequation}
        \lambda^{2}-(s+1)\lambda+s(1-\sigma)=0
        \end{equation}

        The eigenvalues including solvent effects are:

        \begin{equation}\label{eigenvalues}
        \lambda_{1,2}=\frac{1}{2}\left[1+\widetilde{s}\pm \sqrt{(1-\widetilde{s})^{2}+4\sigma \widetilde{s}}\right]
        \end{equation}

        Here \(s\) was renormalized to \(\widetilde{s}\) in order to include solvent effects [2].<br>

        The partition function including chain size effects is [3]:
        \begin{equation}
        Z(\widetilde{s},\sigma,N)=\frac{1-\lambda_2}{\lambda_1-\lambda_2}\lambda_1^N+\frac{\lambda_1-1}{\lambda_1-\lambda_2}\lambda_2^N
        \end{equation}

        When the protein chain is long enough to not consider size effects the partition function of the system reads as [4]:

        \begin{equation}
        Z(\widetilde{s},\sigma,N)=\lambda_1^N
        \end{equation}

        The general degree of helicity is:

        \begin{equation} \label{Degreeofhelsolventfinal}
        \theta(\widetilde{s},\sigma, N)=\frac{\widetilde{s}+\sigma}{N}\frac{\partial\ln Z}{\partial \widetilde{s}}
        \end{equation}

        The helicity degree for long chains is:

        \begin{equation} \label{DegreeofHelZBsolventLongFinal}
        \theta(\sigma,\widetilde{s})=\frac{\widetilde{s}+\sigma}{1+\widetilde{s}+\sqrt{(1-\widetilde{s})^2+4\sigma\widetilde{s}}}
        \left(1+\frac{2\sigma-1+\widetilde{s}}{\sqrt{(1-\widetilde{s})^2+4\sigma\widetilde{s}}}\right).
        \end{equation}

        To pass to the Hamiltonian representation of Zimm-Bragg model in order to include solvent effects, we need to replace Zimm-Bragg model's \(\sigma\) and \(\widetilde{s}\) parameters:

        \begin{equation}
        \sigma=\frac{1}{Q}
        \end{equation}

        \begin{equation}\label{renorm-param-s}
        \widetilde{s}(t,t_0,h,h_{ps},Q,q)=\frac{1}{Q}\left[\left(e^{-\frac{h}{R(t-t_{0})}}+\frac{e^{\frac{h_{ps}-h}{R(t-t_0)}}-e^{-\frac{h}{R(t-t_{0})}}}{q}\right)^{-2}-1\right],
        \end{equation}

        The final expression for heat capacity is:

        \begin{equation}\label{heat-capacity-with-solvent}
        C_V=-2Nh\frac{\partial\theta}{\partial T}+\frac{2Nh_{ps}^2
        e^{h_{ps}/T}(q-1)}{T^2\left(q+e^{h_{ps}/T}-1\right)^2}(1-\theta)+\frac{2Nh_{ps} e^{h_{ps}/T}}{\left(q+e^{h_{ps}/T}-1\right)}\frac{\partial\theta}{\partial T}.
        \end{equation}

        The fitting parameters and their units are in the following table:

        \begin{array} {|c|c|}\hline t_0 & h & h_{ps} & Q \\ \hline K & J/mol & J/mol & 1 \\ \hline  \end{array}


    </div>

    <div class="row-cols-1 p-5">
        [1] <a href="https://doi.org/10.1073/pnas.45.11.1601" target="_blank">Determination of the parameters for helix formation in poly-\(\gamma\)-benzyl-L-glutamate</a><br>
        [2] <a href="https://doi.org/10.1038/s42004-021-00499-x" target="_blank">Implicit water model within the Zimm-Bragg
            approach to analyze experimental data for heat and cold denaturation of proteins</a><br>
        [3] <a href="https://doi.org/10.3389/fnano.2022.982644" target="_blank">Processing helix-coil transition data: account of chain length and solvent effects</a><br>
        [4] <a href="https://doi.org/10.3390/polym13121985" target="_blank">System Size Dependence in the Zimm-Bragg Model: Partition Function Limits, Transition Temperature and Interval</a><br>
        [5] <a href="" target="_blank">Differential Scanning Calorimetry of proteins and Zimm-Bragg model in water</a>
    </div>

    <div class="min__container mt-5">

        <livewire:contact />

    </div>

</main>

@endsection