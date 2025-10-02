<?php

namespace App\Livewire;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;

class EditPet extends Component {
    public $showModal = false;
    
    public $petId = '';
    public $petCategoryId = '';
    public $petCategoryName = '';

    public $petName = '';
    public $petPhotoUrl = '';

    public $petTagId = '';
    public $petTagName = '';


    public $petStatus = 'available';

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
                $this->message = 'Invalid ID';
            } else if ($code == 404) {
                $this->message = 'Pet not found';
            } else {
                $this->message = $e->getMessage();
            }
        }

        $this->message = 'Pet edited successfully!';

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
        if (!(is_null($this->petCategoryId) || $this->petCategoryId == '') && !is_numeric($this->petCategoryId)) {
            $this->message = 'Pet category ID must be a number';
            return true;
        }
        if (!(is_null($this->petTagId) || $this->petTagId == '') && !is_numeric($this->petTagId)) {
            $this->message = 'Pet tag ID must be a number';
            return true;
        }


        if ($this->petCategoryId != '' && $this->petCategoryName == '') {
            $this->message = 'Pet category name must be filled if pet category ID is filled as well';
            return true;
        }
        if ($this->petTagId != '' && $this->petTagName == '') {
            $this->message = 'Pet tag Name must be filled if pet tag ID is filled as well';
            return true;
        }
        


        return false; // This essentially means no error was found.
    }

    public function render() {
        return view('livewire.edit-pet');
    }
}
