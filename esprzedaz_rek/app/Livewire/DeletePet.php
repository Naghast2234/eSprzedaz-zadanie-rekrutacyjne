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

    public $message = '';


    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

    public function submit() {
        $this->message = '';
        
        if ($this->validateFields()) {
            return;
        }

        $client = new Client();

        $request = new Request('DELETE',
        "https://petstore.swagger.io/v2/pet/$this->petId",
        ['Accept' => 'application/json', 'api_key' => 'special-key'],
        );

        try {
            $response = $client->send($request);
        } catch(GuzzleException $e) {
            $this->message = "The pet already did not exist";
        }

        $this->message = 'Pet deleted successfully!';
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

    public function render()
    {
        return view('livewire.delete-pet');
    }
}
