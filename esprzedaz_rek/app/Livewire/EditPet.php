<?php

namespace App\Livewire;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class EditPet extends Component {
    public $showModal = false;
    
    public $petId = null;
    public $petCategoryId = null;
    public $petCategoryName = '';

    public $petName = ''; // This is a string
    public $petPhotoUrl = ''; // This is also a string, but also a link that is SUPPOSED to point to an image.

    public $petTagId = null; // Array, same structure as category;
    public $petTagName = '';


    public $petStatus = 'available'; // String but technically from 3 options: 'available', 'pending', 'sold'.

    public $errorMessage = '';


    public function toggleModal() {
        $this->showModal = !$this->showModal;
    }

    public function submit() {
        $client = new Client();

        // Quick validation
        if (!is_numeric($this->petId)) {
            $this->errorMessage = 'Pet ID must be a number';
            return;
        }
        if (!is_null($this->petCategoryId) && !is_numeric($this->petCategoryId)) {
            $this->errorMessage = 'Pet category ID must be a number';
            return;
        }
        if (!is_null($this->petTagId) && !is_numeric($this->petTagId)) {
            $this->errorMessage = 'Pet tag ID must be a number';
            return;
        }

        $data = [
            'id' => intval($this->petId),
            'category' => [
                'id' => intval($this->petCategoryId),
                'name' => $this->petCategoryName,
            ],
            'name' => $this->petName,
            'tags' => [
                [
                    'id'=> intval($this->petTagId),
                    'name' => $this->petTagName,
                ]
            ],
            'photoUrls' => [
                $this->petPhotoUrl
            ],
            'status' => $this->petStatus,
        ];

        $request = new Request('PUT',
        'https://petstore.swagger.io/v2/pet',
        ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        json_encode($data));


        try {
            $response = $client->send($request);
        } catch (GuzzleException $e) {
            $code = $e->getCode();
            if ($code == 400) {
                $this->errorMessage = 'Invalid ID';
            } else if ($code == 404) {
                $this->errorMessage = 'Pet not found';
            } else {
                $this->errorMessage = $e->getMessage();
            }
        }


    }

    public function render() {
        return view('livewire.edit-pet');
    }
}
