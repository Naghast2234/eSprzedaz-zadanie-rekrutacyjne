<?php

namespace App\Livewire;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class AddPet extends Component {
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
            $errorMessage = 'Pet ID must be a number';
            return;
        }
        if (!is_null($this->petCategoryId) && !is_numeric($this->petCategoryId)) {
            $errorMessage = 'Pet category ID must be a number';
            return;
        }
        if (!is_null($this->petTagId) && !is_numeric($this->petTagId)) {
            $errorMessage = 'Pet tag ID must be a number';
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

        $request = new Request('POST',
        'https://petstore.swagger.io/v2/pet',
        ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        json_encode($data));

    //     $response = $client->request('POST', 'https://petstore.swagger.io/v2/pet', ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
    // json_encode($data));
        $response = $client->send($request);

        
    }

    public function render() {
        return view('livewire.add-pet');
    }
}
