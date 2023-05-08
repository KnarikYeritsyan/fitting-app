<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PlotDataExample extends Component
{
    use WithFileUploads;

    public $data_file_n;
    public $temperature=false;
    public $csv_data;
    public $csv_header_cols = [];
    public $csv_fields;
    public $repeat_units = 50;
    public $fileHasHeader = true;
    public $output_data_n=[];
    public $format_error;

    public $rules = [
        'data_file_n' => 'required',

    ];

    protected $validationAttributes = [
        'data_file_n' => 'Data File'
    ];

    protected $messages = [
        'data_file_n.required' => 'Please select one of the examples.',
    ];

    public function save()
    {
        $this->validate();

        // store the csv under the local filesytem, defined in config/filesystems.php
        $this->data_file_n->store('csv', 'local');
    }

    function try_example($file, $temp, $length){
//        dd($file);
        $this->data_file_n=$file;
        $this->temperature=$temp;
        $this->repeat_units=$length;
        $this->parseFile();
    }


    function parseFile()
    {
        $this->validate();
        $path = storage_path('app/public/examples/small-n/'.$this->data_file_n);
        $pythonpath = base_path('read-data.py');
        $process = new Process(['python3',$pythonpath,$path,$this->temperature]);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $output=$process->getOutput();
        $output = str_replace(["[","]"], '', $output);
        $output=json_decode($output,true);
        if (isset($output['format_error'])) {
            $this->csv_data = [];
            $this->format_error = $output['format_error'];
        }else{
            $this->format_error = false;
            $output['xexp'] = explode(',', $output['xexp']);
            $output['yexp'] = explode(',', $output['yexp']);
            $this->csv_fields = $output;
            $data = [];

            foreach ($output['xexp'] as $key=>$dat)
            {
                $data[$key][0]=floatval($output['xexp'][$key]);
                $data[$key][1]=floatval($output['yexp'][$key]);
            }

            $this->csv_data = $data;
        }
    }

    function fit_data_finite_N()
    {
        $this->parseFile();
        $this->output_data_n = [];
        if (!$this->format_error) {
            $pythonpath = base_path('fit-helicity-degree-small-N.py');
            $path = storage_path('app/public/examples/small-n/'.$this->data_file_n);
            $process = new Process(['python3', $pythonpath, $path, $this->temperature, $this->repeat_units]);
            $process->run();

// executes after the command finishes
            if (!$process->isSuccessful()) {
                throw new ProcessFailedException($process);
            }

            $output = $process->getOutput();
            $output = str_replace(["[", "]"], '', $output);
            $output = json_decode($output, true);
            if (!isset($output['error_message'])) {
                $output['xopt'] = explode(',', $output['xopt']);
                $output['yopt'] = explode(',', $output['yopt']);
                $output['xexp'] = explode(',', $output['xexp']);
                $output['yexp'] = explode(',', $output['yexp']);
            }
            $this->output_data_n = $output;
            $this->dispatchBrowserEvent('contentChanged', ['output_data_n' => $this->output_data_n]);
        }
    }

    public function render()
    {
        $dir = storage_path('app/public/examples/small-n/');
        $contents = json_decode(file_get_contents($dir.'examples.json'),true);
        return view('livewire.plot-data-example',compact('contents','dir'));
    }
}
