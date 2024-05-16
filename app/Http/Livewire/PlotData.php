<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PlotData extends Component
{

    use WithFileUploads;

    public $data_file_n;
    public $temperature=false;
    public $csv_data;
    public $csv_header_cols = [];
    public $csv_fields;
    public $repeat_units;
    public $fileHasHeader = true;
    public $output_data_n=[];
    public $format_error;

    public $rules = [
        'data_file_n' => 'required|file|mimes:csv,txt,dat|max:1024',

    ];

    protected $validationAttributes = [
        'data_file_n' => 'Data File'
    ];

//    public function save()
//    {
//        $this->validate();
        // store the csv under the local filesytem, defined in config/filesystems.php
//        $this->data_file_n->store('csv', 'local');
//    }


    function parseFile()
    {
        $this->validate();
        $path = $this->data_file_n->getRealPath();
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
        $this->validate([
            'data_file_n' => 'required|file|mimes:csv,txt,dat',
            'repeat_units' => 'required|numeric',
        ]);
        $this->parseFile();
        $this->output_data_n = [];
        if (!$this->format_error) {
            $pythonpath = base_path('fit-helicity-degree-small-N.py');
            $path = $this->data_file_n->getRealPath();
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
        return view('livewire.plot-data');
    }
}
