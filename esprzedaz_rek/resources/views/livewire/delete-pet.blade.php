<div class="p-4">
    <button wire:click="toggleModal" class="border border-amber-500">Delete a pet</button>

    <div wire:show="showModal">
        <div class="p-4">
            <h1>Pet ID (Has to be entered manually) (Has to be a number)</h1>
            <input type="text" class="bg-[grey]" wire:model="petId"></input>
        </div>
        
        <div>
            <h1>{{ $message }}</h1>
        </div>
        <button wire:click="submit" class="bg-amber-500 border border-amber-400 rounded-2xl">Delete a pet of chosen ID!</button>
    </div>
</div>
