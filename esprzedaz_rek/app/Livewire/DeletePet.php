<?php

namespace App\Livewire;

use GuzzleHttp\Exception\GuzzleException;
use Livewire\Component;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class DeletePet extends Component
{

    public $showModal = false;
    
    public $petId = null;

    public $errorMessage = '';


    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

    public function submit() {
        $client = new Client();

        if (!is_numeric($this->petId)) {
            $this->errorMessage = 'Pet ID must be a number';
            return;
        }

        $request = new Request('DELETE',
        "https://petstore.swagger.io/v2/pet/$this->petId",
        ['Accept' => 'application/json', 'api_key' => 'special-key'],
        );

        try {
            $response = $client->send($request);
        } catch(GuzzleException $e) {
            $this->errorMessage = "The pet already did not exist";
        }
    }

    public function render()
    {
        return view('livewire.delete-pet');
    }
}
