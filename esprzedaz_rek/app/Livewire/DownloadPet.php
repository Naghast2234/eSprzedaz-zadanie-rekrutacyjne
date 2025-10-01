<?php

namespace App\Livewire;

use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Storage;

class DownloadPet extends Component
{

    public $showModal = false;
    
    public $petId = null;

    public $errorMessage = '';

    public function render()
    {
        return view('livewire.download-pet');
    }

    public function submit() {
        $client = new Client();

        if (!is_numeric($this->petId)) {
            $this->errorMessage = 'Pet ID must be a number';
            return;
        }

        $request = new Request('GET',
        "https://petstore.swagger.io/v2/pet/$this->petId",
        ['Accept' => 'application/json'],
        );

        try {
            $response = $client->send($request);

            // $body = json_decode($response->getBody()->getContents());

            $content = $response->getBody()->getContents();

            Storage::disk('local')->put("pet_data.txt", $content);
            return Storage::download("pet_data.txt");
            // dd($body);
        } catch(GuzzleException $e) {
            $this->errorMessage = "The pet did not exist";
        }
    }

    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

}
