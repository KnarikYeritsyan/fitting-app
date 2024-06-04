<?php

namespace App\Http\Livewire;
use Livewire\WithFileUploads;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Livewire\Component;

class CalExamples extends Component
{
    use WithFileUploads;

    public $data_file;
    public $temperature = false;
    public $unit;
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
        'data_file' => 'required',
    ];

    protected $messages = [
        'data_file.required' => 'Please select one of the examples.',
    ];

    function try_example($file, $temp, $length, $init_t0, $init_h, $init_h_ps, $init_Q,$unit){
//        dd($file);
        $this->data_file=$file;
        $this->temperature=$temp;
        $this->repeat_units=$length;
        $this->init_t0=$init_t0;
        $this->init_h=$init_h;
        $this->init_h_ps=$init_h_ps;
        $this->init_Q=$init_Q;
        $this->unit=$unit;
        $this->parseFile();
    }

    function parseFile()
    {
        $this->validate();
        $path = storage_path('cal-examples/'.$this->data_file);
        $pythonpath = base_path('read-cal-data.py');
        $process = new Process([env('PYTHON3_COMMAND'),$pythonpath,$path,$this->temperature,$this->unit]);
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

    function fit_cal_data()
    {
        $this->validate([
            'data_file' => 'required',
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
            $path = storage_path('app/public/cal-examples/'.$this->data_file);
            $process = new Process([env('PYTHON3_COMMAND'), $pythonpath, $path, $this->temperature, $this->unit, $this->repeat_units,$this->init_t0,$this->init_h,$this->init_h_ps,$this->init_Q]);
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
        $dir = storage_path('cal-examples/');
        $contents = json_decode(file_get_contents($dir.'examples.json'),true);
        return view('livewire.cal-examples',compact('contents','dir'));
    }
}
