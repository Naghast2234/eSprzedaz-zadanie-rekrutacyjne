<div class="p-4">
    <button wire:click="toggleModal" class="border border-amber-500">Download pet data to .txt file</button>

    <div wire:show="showModal">
        <div class="p-4">
            <h1>Pet ID (Has to be entered manually) (Has to be a number)</h1>
            <textarea class="bg-[grey]" wire:model="petId"></textarea>
        </div>
        
        <div>
            <h1 class="color-[red]">{{ $errorMessage }}</h1>
        </div>
        <button wire:click="submit">Download pet data</button>
    </div>
</div>
