<div class="p-4">
    <!-- <h1>This will be a button to add a new</h1> -->
    <button wire:click="toggleModal" class="border border-amber-500">Edit a pet</button>

    <div wire:show="showModal">
        <h1>
            This is... Basically identical to adding a pet and honestly functions nearly the same on petstore's end, but you have to supply an ID of an existing pet.
            That's it. That's the whole difference. Adding a new pet can override a pet already.
        </h1>
        <div class="p-4">
            <h1>Pet ID (Has to be entered manually) (Has to be a number)</h1>
            <textarea class="bg-[grey]" wire:model="petId"></textarea>
        </div>
        <div class="p-4">
            <h1>Pet category (Contains ID and name of it)</h1>
            <div>
                <div>
                    <h1>ID</h1>
                    <textarea class="bg-[grey]" wire:model="petCategoryId"></textarea>
                </div>
                <div>
                    <h1>Name</h1>
                    <textarea class="bg-[grey]" wire:model="petCategoryName"></textarea>
                </div>
            </div>
        </div>
        <div class="p-4">
            <h1>Pet's name</h1>
            <textarea class="bg-[grey]" wire:model="petName"></textarea>
        </div>
        <div class="p-4">
            <h1>Pet photo URL</h1>
            <textarea class="bg-[grey]" wire:model="petPhotoUrl"></textarea>
        </div>
        <div class="p-4">
            <h1>Pet tags (For now can just add one... Will add ability to add more later)</h1>
            <div>
                <div>
                    <h1>ID</h1>
                    <textarea class="bg-[grey]" wire:model="petTagId"></textarea>
                </div>
                <div>
                    <h1>Name</h1>
                    <textarea class="bg-[grey]" wire:model="petTagName"></textarea>
                </div>
            </div>
        </div>
        <div class="p-4">
            <h1>Pet status</h1>
            <select class="bg-[grey]" wire:model="petStatus">
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <div>
            <h1 class="color-[red]">{{ $errorMessage }}</h1>
        </div>
        <button wire:click="submit">Submit the pet!</button>
    </div>
</div>
