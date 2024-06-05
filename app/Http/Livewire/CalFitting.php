<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Livewire\Component;

class CalFitting extends Component
{
    use WithFileUploads;

    public $data_file;
    public $temperature = false;
    public $unit = 'j_mol';
    public $csv_data;
    public $csv_header_cols = [];
    public $csv_fields;
    public $repeat_units;
    public $init_t0;
    public $init_h;
    public $init_h_ps;
    public $init_Q;
    public $fileHasHeader = true;
    public $output_data=[];
    public $format_error;

    public $rules = [
        'data_file' => 'required|file|mimes:csv,txt,dat|max:1024',

    ];

    protected $validationAttributes = [
        'init_t0' => 'Initial value for t<sub>0</sub>',
        'init_h' => 'Initial value for h',
        'init_h_ps' => 'Initial value for h<sub>ps</sub>',
        'init_Q' => 'Initial value for Q'
    ];

    function parseFile()
    {
        $this->validate();
        $path = $this->data_file->getRealPath();
        $pythonpath = base_path('read-cal-data.py');
        $process = new Process([env('PYTHON3_COMMAND','/var/www/html/fitting-app/venv/bin/python3'),$pythonpath,$path,$this->temperature,$this->unit]);
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
            $this->init_t0 = $output['t0'];
            $this->init_h = $output['h'];
            $this->init_h_ps = $output['h_ps'];
            $this->init_Q = $output['Q'];
            $data = [];

            foreach ($output['xexp'] as $key=>$dat)
            {
                $data[$key][0]=floatval($output['xexp'][$key]);
                $data[$key][1]=floatval($output['yexp'][$key]);
            }

            $this->csv_data = $data;
        }
    }

    function fit_cal_data()
    {
        $this->validate([
            'data_file' => 'required|file|mimes:csv,txt,dat',
            'repeat_units' => 'required|numeric',
            'init_t0' => 'required|numeric',
            'init_h' => 'required|numeric',
            'init_h_ps' => 'required|numeric',
            'init_Q' => 'required|numeric',
        ]);
//        $this->parseFile();
        $this->output_data = [];
        if (!$this->format_error) {
            $pythonpath = base_path('fit-cal-water-model.py');
            $path = $this->data_file->getRealPath();
            $process = new Process([env('PYTHON3_COMMAND','/var/www/html/fitting-app/venv/bin/python3'), $pythonpath, $path, $this->temperature, $this->unit, $this->repeat_units,$this->init_t0,$this->init_h,$this->init_h_ps,$this->init_Q]);
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

                $data = [];
                foreach ($output['xexp'] as $key=>$dat)
                {
                    $data[$key][0]=floatval($output['xexp'][$key]);
                    $data[$key][1]=floatval($output['yexp'][$key]);
                }
                $this->csv_data = $data;

                foreach ($output['yexp'] as $key=>$dat)
                {
                    $output['yexp'][$key]=$output['yexp'][$key]/$this->repeat_units;
                }
                foreach ($output['yopt'] as $key=>$dat)
                {
                    $output['yopt'][$key]=$output['yopt'][$key]/$this->repeat_units;
                }

            }

            $this->output_data = $output;
            $this->dispatchBrowserEvent('contentChanged', ['output_data' => $this->output_data]);
        }
    }
    
    public function render()
    {
        return view('livewire.cal-fitting');
    }
}
