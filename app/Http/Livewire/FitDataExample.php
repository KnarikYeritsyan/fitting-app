<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FitDataExample extends Component
{
    use WithFileUploads;

    public $data_file;
    public $temperature=false;
    public $csv_data;
    public $csv_header_cols = [];
    public $csv_fields;
    public $fileHasHeader = true;
    public $output_data;
    public $format_error;

    public $rules = [
        'data_file' => 'required',

    ];

    protected $validationAttributes = [
        'data_file' => 'Data File',
    ];

    protected $messages = [
        'data_file.required' => 'Please select one of the examples.',
    ];

    function try_example($file, $temp){
//        dd($file);
        $this->data_file=$file;
        $this->temperature=$temp;
        $this->parseFile();
    }

    function parseFile()
    {
        $this->validate();
        $path = storage_path('cd-examples/large-n/'.$this->data_file);
        $pythonpath = base_path('read-data.py');
        $process = new Process([env('PYTHON3_COMMAND','/var/www/html/fitting-app/venv/bin/python3'),$pythonpath,$path,$this->temperature]);
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

    function fit_data_infinite_N()
    {
        $this->parseFile();
        $this->output_data = [];

        if (!$this->format_error) {
            $pythonpath = base_path('fit-helicity-degree-large-N.py');
            $path = storage_path('app/public/examples/large-n/'.$this->data_file);
            $process = new Process([env('PYTHON3_COMMAND','/var/www/html/fitting-app/venv/bin/python3'), $pythonpath, $path, $this->temperature]);
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
            $this->output_data = $output;
            $this->dispatchBrowserEvent('plot1ContentChanged', ['output_data' => $this->output_data]);
        }
    }

    public function render()
    {
        $dir = storage_path('cd-examples/large-n/');
        $contents = json_decode(file_get_contents($dir.'examples.json'),true);
        return view('livewire.fit-data-example',compact('contents','dir'));
    }
}
