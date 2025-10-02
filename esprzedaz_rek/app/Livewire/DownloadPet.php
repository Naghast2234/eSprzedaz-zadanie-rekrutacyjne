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
    
    public $petId = '';

    public $message = '';

    public function render()
    {
        return view('livewire.download-pet');
    }

    public function submit() {
        $this->message = '';
        
        if($this->validateFields()) {
            return;
        }

        $client = new Client();

        $request = new Request('GET',
        "https://petstore.swagger.io/v2/pet/$this->petId",
        ['Accept' => 'application/json'],
        );

        try {
            $response = $client->send($request);

            $content = $response->getBody()->getContents();

            Storage::disk('local')->put("pet_data.txt", $content);
            return Storage::download("pet_data.txt");
        } catch(GuzzleException $e) {
            $this->message = "The pet did not exist";
        }

        $this->message = 'Pet downloaded successfully! (I think.)';
    }

    private function validateFields() {
        
        if (is_null($this->petId) || $this->petId == '') {
            $this->message = 'Pet ID must not be empty';
            return true;
        }
        if (!is_numeric($this->petId)) {
            $this->message = 'Pet ID must be a number';
            return true;
        }
        
        return false; // This essentially means no error was found.
    }

    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

}
