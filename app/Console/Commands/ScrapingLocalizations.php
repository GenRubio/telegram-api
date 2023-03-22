<?php

namespace App\Console\Commands;

use Exception;
use voku\helper\HtmlDomParser;
use Illuminate\Console\Command;
use App\Exceptions\GenericException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ScrapingLocalizations extends Command
{
    protected $signature = 'geo:locations';
    protected $description = 'Command description';
    private $disk;
    private $outputJson;
    private $usedNumbers = [];

    public function handle()
    {
        $this->disk = Storage::disk('postal_codes');
        foreach ($this->disk->allFiles('2020') as $file) {
            File::lines(storage_path('postal_codes/2020/' . basename($file)))->each(function ($line) {
                $this->getInfoPagePostalCode($line);
            });
        }
        $this->disk->put('postal_codes_spain.json', json_encode($this->outputJson));
    }

    private function getInfoPagePostalCode($line)
    {
        try {
            $postalCode = explode(":", $line)[0];
            if (!in_array($postalCode, $this->usedNumbers) && strlen($postalCode) == 5){
                array_push($this->usedNumbers, $postalCode);
                dump($postalCode);
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://codigo-postal.co/espana/cp/{$postalCode}/");
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
                $html = curl_exec($curl);
                curl_close($curl);
                $dom = HtmlDomParser::str_get_html($html);
                $this->setDataPostalCode($dom, $postalCode);
            }
        } catch (GenericException | Exception $e) {
            dump("Error: {$e->getMessage()}");
        }
    }

    private function setDataPostalCode($dom, $postalCode)
    {
        $outpuData = [];
        $elements = $dom->find("tbody tr");
        foreach ($elements as $element) {
            $data = $element->find("td");
            array_push($outpuData, [
                'province' => $data[0]->text,
                'city' => $data[1]->text,
                'postal_code' => $data[2]->text
            ]);
        }

        $this->outputJson[$postalCode] = $outpuData;
    }
}
