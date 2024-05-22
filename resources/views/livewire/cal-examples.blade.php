<div>
<div class="main__middle">

    <div class="main__middle__left">

        <div class="accordion" id="accordionPanelsStayOpenExample">
            @foreach($contents as $cont=>$content)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-heading{{str_replace(' ', '', $cont)}}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse{{str_replace(' ', '', $cont)}}" aria-expanded="true" aria-controls="panelsStayOpen-collapse{{str_replace(' ', '', $cont)}}">
                            <i style="margin-right: 8px;" class="fa-solid fa-folder"></i> {{$cont}}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse{{str_replace(' ', '', $cont)}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading{{str_replace(' ', '', $cont)}}">
                        <div class="accordion-body">
                            @foreach($content as $con=>$file)
                                <i class="fa-solid fa-file"></i> {{$file['name']}}
                                <button class="btn btn-outline-success" wire:click="try_example('{{$cont.'/'.$file['name']}}','{{$file['temperature']}}',{{$file['length']}},{{$file['t_0_guess']}},{{$file['h_guess']}},{{$file['p_guess']}},{{$file['Q_guess']}},'{{isset($file['unit'])?$file['unit']:'j_mol'}}')">Apply</button>
                                <a download="{{$file['name']}}" href="{{ Storage::url('cal-examples/'.$cont.'/'.$file['name']) }}" title="Download data file">Download <i style="margin-left: 5px;" class="fa-solid fa-file-arrow-down"></i></a>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>

            @endforeach
        </div>

    </div>

    <div class="main__middle__right">
        <div class="form__block">
            <p>Data file (.csv, .txt, .dat)</p>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Browse...</div>
                </div>
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="No file selected." wire:model="data_file" disabled>
            </div>
            @error('data_file') <span class="text-danger">{{ $message }}</span> @enderror


            <div class="d-flex justify-content-center mt-3" id="switch">
                <p style="margin-right: 25px">Temperature in</p>
                <input type="checkbox" class="checkbox" id="chkn" wire:model="temperature" disabled/>
                <label class="label" for="chkn">
                    <i class="degree-celsius"><b>&#8451;</b></i>
                    <i class="degree-celsius"><b>&#xB0;K</b></i>
                    <div class="ball"></div>
                </label>
            </div>

            @if($format_error)
                <h6 class="alert text-bg-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> {{$format_error}} <a href="{{route('guest.examples')}}">see examples</a> </h6>
        @endif

            <div class="d-flex justify-content-center">
                <p style="margin-right: 25px">Heat Capacity Unit</p>
                <div class="btn-group">
                    <input type="radio" class="btn-check" name="unit" wire:model="unit" id="kj_mol" value="kj_mol" autocomplete="off" checked />
                    <label class="btn btn-primary" for="kj_mol" data-mdb-ripple-init>kJ/mol</label>

                    <input type="radio" class="btn-check" name="unit" wire:model="unit" id="j_mol" value="j_mol" autocomplete="off" />
                    <label class="btn btn-primary" for="j_mol" data-mdb-ripple-init>J/mol</label>

                    <input type="radio" class="btn-check" name="unit" wire:model="unit" id="kcal_mol" value="kcal_mol" autocomplete="off" />
                    <label class="btn btn-primary" for="kcal_mol" data-mdb-ripple-init>kcal/mol</label>

                    <input type="radio" class="btn-check" name="unit" wire:model="unit" id="cal_mol" value="cal_mol" autocomplete="off" />
                    <label class="btn btn-primary" for="cal_mol" data-mdb-ripple-init>cal/mol</label>
                </div>
            </div>

        <!--<button type="button" class="form__block__btn">UPLOAD FILE</button>-->
            <button  wire:click="parseFile" type="button" class="btn btn-success m-2" wire:loading.attr="disabled">Upload file</button>

            <div class="input-group mb-3">
                <span class="input-group-text m-2 p-2">Number of repeat units (amino acid residues)</span>
                <input type="number" class="form-control m-2 p-2" wire:model="repeat_units" disabled>
                @error('repeat_units') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text m-2 p-2">Initial t<sub>0</sub></span>
                <input type="number" class="form-control m-2 p-2" wire:model="init_t0" disabled>
                @error('init_t0') <span class="text-danger">{!! html_entity_decode($message) !!}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text m-2 p-2">Initial h</span>
                <input type="number" class="form-control m-2 p-2" wire:model="init_h" disabled>
                @error('init_h') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text m-2 p-2">Initial h<sub>ps</sub></span>
                <input type="number" class="form-control m-2 p-2" wire:model="init_h_ps" disabled>
                @error('init_h_ps') <span class="text-danger">{!! html_entity_decode($message) !!}</span> @enderror
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text m-2 p-2">Initial Q</span>
                <input type="number" class="form-control m-2 p-2" wire:model="init_Q" disabled>
                @error('init_Q') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

        </div>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-bordered table-striped mb-0 data-sticky-header-offset-y">
                <thead class="sticky-table-header">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Temperature [K]</th>
                    <th scope="col">Heat Capacity [J/mol]</th>
                </tr>
                </thead>
                <tbody>
                @if($csv_data)
                    {{--                    {{dd($csv_data)}}--}}
                    <?php $j=0 ?>
                    @foreach ($csv_data as $i=>$row)
                        <?php $j++ ?>
                        {{--                        <tr>{{$j}}</tr>--}}
                        <tr>
                            <th scope="row">{{$j}}</th>
                            <td>{{$row[0]}}</td>
                            <td>{{$row[1]}}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>

        </div>


        <button wire:click="fit_cal_data" type="button" class="btn btn-primary m-4" wire:loading.attr="disabled">
            Start fitting
        </button>
        <div wire:loading wire:target="fit_cal_data">

            Fitting...

        </div>

        {{--<button class="btn btn-primary" type="button" disabled>--}}
        {{--<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>--}}
        {{--Fitting...--}}
        {{--</button>--}}

        <div id="fit-errorn"></div>
        <div id="fit-warningn"></div>
        <div id="myChartn" style="width:600px;max-height:600px;"></div>
        <div id="mytablen" style="max-height: 300px"></div>
    </div>



    {{--@if(isset($output_data['r_squared']))--}}
    <script>
        window.addEventListener('contentChanged', (e) => {

            // document.getElementById('myChart').innerHTML = "";
            // let graph = document.getElementById('tester');
            if(e.detail.output_data['error_message']) {
                document.getElementById('myChartn').innerHTML = "";
                document.getElementById('mytablen').innerHTML = "";
                document.getElementById('fit-errorn').innerHTML = '<h5 class="alert text-bg-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> '+e.detail.output_data['error_message']+'</h5>';
            }else {
                if(e.detail.output_data['warning_message']){
                    document.getElementById('fit-warningn').innerHTML = '<h6 class="alert text-bg-warning text-center"><i class="fa-solid fa-circle-exclamation"></i> '+e.detail.output_data['warning_message']+'</h6>'
                }
                let graph = document.getElementById('myChartn');
                        {{--let xopt = {!! $output_data['xopt'] !!};--}}
                        {{--let yopt = {!! $output_data['yopt'] !!};--}}
                        {{--let xexp = @json($output_data['xexp']);--}}
                        {{--let yexp = @json($output_data['yexp']);--}}
                        {{--let xopt = @json($output_data['xopt']);--}}
                        {{--let yopt = @json($output_data['yopt']);--}}

                let xexp = e.detail.output_data['xexp'];
                let yexp = e.detail.output_data['yexp'];
                let xopt = e.detail.output_data['xopt'];
                let yopt = e.detail.output_data['yopt'];

                let trace1 = {
                    x: xexp,
                    y: yexp,
                    mode: 'markers',
                    type: 'scatter',
                    name: 'exp',
                };

                let trace2 = {
                    x: xopt,
                    y: yopt,
                    mode: 'lines',
                    type: 'scatter',
                    name: 'fit',
                };


                let layout = {
                    title: 'Heat Capacity',
                    xaxis: {
                        title: '<b>Temperature [K]</b>',
                    },
                    yaxis: {
                        title: '<b>C<sub>p</sub>/N [J/mol]</b>',
                    },
                    dragmode: 'pan',
                    font: {
                        family: "Courier New, monospace",
                        size: 18,
                        // color: "RebeccaPurple"
                    },
                    colorway : ['#ff7f0e','#1f77b4']
                };

                let config = {
                    responsive: true,
                    scrollZoom: true,
                    displayModeBar: true,
                    displaylogo: false,
                    toImageButtonOptions: {
                        format: 'svg', // one of png, svg, jpeg, webp
                        // height: 600,
                        // width: 600,
                        // scale: 1
                    }
                    // modeBarButtonsToRemove: ['zoom', 'pan']
                };

                Plotly.newPlot(graph, [trace1, trace2], layout, config);
                // Plotly.update(graph, [trace1,trace2],layout, config);


                //plotly table
                let values = [
                        {{--['{{ $output_data['fit_params']['t0'].' ('.$output_data['fit_params_errors']['t0'].')'}}'],--}}
                        {{--['{{$output_data['fit_params']['h'].' ('.$output_data['fit_params_errors']['h'].')'}}'],--}}
                        {{--['{{$output_data['fit_params']['h_ps'].' ('.$output_data['fit_params_errors']['h_ps'].')'}}'],--}}
                        {{--['{{$output_data['fit_params']['Q'].' ('.$output_data['fit_params_errors']['Q'].')'}}'],--}}
                        {{--[{{$output_data['sigma']}}],--}}
                        {{--[{{$output_data['r_squared']}}],--}}
                    [e.detail.output_data['fit_params']['t0'] + ' (' + e.detail.output_data['fit_params_errors']['t0'] + ')'],
                    [e.detail.output_data['fit_params']['h'] + ' (' + e.detail.output_data['fit_params_errors']['h'] + ')'],
                    [e.detail.output_data['fit_params']['h_ps'] + ' (' + e.detail.output_data['fit_params_errors']['h_ps'] + ')'],
                    [e.detail.output_data['fit_params']['Q'] + ' (' + e.detail.output_data['fit_params_errors']['Q'] + ')'],
                    [e.detail.output_data['sigma']],
                    [e.detail.output_data['r_squared']],
                ];


                let data = [{
                    type: 'table',
                    header: {
                        values: [
                            ["t<sub>0</sub> [K]"],
                            ["h [J/mol]"], ["h<sub>ps</sub> [J/mol]"], ["Q"], ["σ"], ["R<sup>2</sup>"]],
                        align: ["center"],
                        line: {width: 1, color: '#506784'},
                        fill: {color: '#119DFF'},
                        font: {family: "Arial", size: 12, color: "white"}
                    },
                    cells: {
                        values: values,
                        align: ["center"],
                        line: {color: "#506784", width: 1},
                        fill: {color: ['white']},
                        font: {family: "Arial", size: 11, color: ["#506784"]}
                    }
                }];

                Plotly.newPlot('mytablen', data);
            }

        });
    </script>
    {{--@endif--}}
</div>
</div>