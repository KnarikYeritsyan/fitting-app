<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use function Symfony\Component\ErrorHandler\traceAt;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class FitData extends Component
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
        'data_file' => 'required|file|mimes:csv,txt,dat|max:1024',

    ];

    protected $validationAttributes = [
        'data_file' => 'Data File',
    ];

    function parseFile()
    {
        $this->validate();
        $path = $this->data_file->getRealPath();
        $pythonpath = base_path('read-data.py');
        $process = new Process(['source /var/www/html/fitting-app/venv/bin/activate && python3 \'/var/www/html/fitting-app/read-data.py\' \'/var/www/html/fitting-app/storage/cd-examples/large-n/Go et al/go-et-al-1.dat\' \'true\'']);
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
            $path = $this->data_file->getRealPath();
            $process = new Process(['source /var/www/html/fitting-app/venv/bin/activate && python3 \'/var/www/html/fitting-app/fit-helicity-degree-large-N.py\' \'/var/www/html/fitting-app/storage/cd-examples/large-n/Go et al/go-et-al-1.dat\' \'true\'']);
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
        return view('livewire.fit-data');
    }
}
