<div class="main__middle">
    <div class="main__middle__left">

        <div class="form__block">
            <p>Data file (.csv, .txt, .dat)</p>
            <input class="form-control" type="file" id="formFile" wire:model="data_file" accept=".csv, .txt, .dat">
            @error('data_file') <span class="text-danger">{{ $message }}</span> @enderror


            <div class="d-flex justify-content-center mt-3" id="switch">
                <p style="margin-right: 25px">Temperature in</p>
                <input type="checkbox" class="checkbox" id="chk" wire:model="temperature" />
                <label class="label" for="chk">
                    <i class="degree-celsius"><b>&#8451;</b></i>
                    <i class="degree-celsius"><b>&#xB0;K</b></i>
                    <div class="ball"></div>
                </label>
            </div>

            @if($format_error)
                <h6 class="alert text-bg-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> {{$format_error}} <a href="{{route('guest.examples')}}">see examples</a> </h6>
            @endif

            <!--<button type="button" class="form__block__btn">UPLOAD FILE</button>-->
            <button  wire:click="parseFile" type="button" class="btn btn-success m-2" wire:loading.attr="disabled">Upload file</button>

        </div>

        <div class="table-wrapper-scroll-y my-custom-scrollbar">
            <table class="table table-bordered table-striped mb-0 data-sticky-header-offset-y">
                <thead class="sticky-table-header">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Temperature [K]</th>
                    <th scope="col">Helicity degree</th>
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


        <button wire:click="fit_data_infinite_N" type="button" class="btn btn-primary m-4" wire:loading.attr="disabled">
            Start fitting
        </button>
        <div wire:loading wire:target="fit_data_infinite_N">

            Fitting...

        </div>

        {{--<button class="btn btn-primary" type="button" disabled>--}}
            {{--<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>--}}
            {{--Fitting...--}}
        {{--</button>--}}

    </div>

    <div class="main__middle__right">
        <div id="fit-error"></div>
        <div id="fit-warning"></div>
        <div id="myChart" style="width:600px;max-height:600px;"></div>
        <div id="mytable" style="max-height: 300px"></div>
    </div>


{{--@if(isset($output_data['r_squared']))--}}
    <script>
      window.addEventListener('plot1ContentChanged', (e) => {

        // document.getElementById('myChart').innerHTML = "";
        // let graph = document.getElementById('tester');
          if(e.detail.output_data['error_message']) {
          document.getElementById('myChart').innerHTML = "";
          document.getElementById('mytable').innerHTML = "";
          document.getElementById('fit-error').innerHTML = '<h5 class="alert text-bg-danger text-center"><i class="fa-solid fa-triangle-exclamation"></i> '+e.detail.output_data['error_message']+'</h5>';
        }else {
              if(e.detail.output_data['warning_message']){
                  document.getElementById('fit-warning').innerHTML = '<h6 class="alert text-bg-warning text-center"><i class="fa-solid fa-circle-exclamation"></i> '+e.detail.output_data['warning_message']+'</h6>'
              }
          let graph = document.getElementById('myChart');
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
            x: xopt,
            y: yopt,
            mode: 'lines',
            type: 'scatter',
            name: 'fit',
          };

          let trace2 = {
            x: xexp,
            y: yexp,
            mode: 'markers',
            type: 'scatter',
            name: 'exp',
          };


          let layout = {
            title: 'Helicity degree',
            xaxis: {
              title: '<b>Temperature [K]</b>',
            },
            yaxis: {
              title: '<b>Θ</b>',
            },
            dragmode: 'pan',
            font: {
              family: "Courier New, monospace",
              size: 18,
              // color: "RebeccaPurple"
            }
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
                ["t<sub>0</sub>, K"],
                ["h, J mol<sup>-1</sup>"], ["h<sub>ps</sub>, J mol<sup>-1</sup>"], ["Q"], ["σ"], ["R<sup>2</sup>"]],
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

          Plotly.newPlot('mytable', data);
        }

      });
    </script>
{{--@endif--}}
</div>
