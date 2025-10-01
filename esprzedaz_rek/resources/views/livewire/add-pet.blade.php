<div>
    <!-- <h1>This will be a button to add a new</h1> -->
    <button wire:click="toggleModal" class="border border-amber-500">Add a pet</button>

    <div wire:show="showModal">
        <h1>This is a modal</h1>
        <div class="p-8">
            <h1>Pet ID (Has to be entered manually) (Has to be a number)</h1>
            <textarea class="bg-[grey]" wire:model="petId"></textarea>
        </div>
        <div class="p-8">
            <h1>Pet category (Contains ID and name of it)</h1>
            <div>
                <div>
                    <h1>ID</h1>
                    <textarea class="bg-[grey]"></textarea>
                </div>
                <div>
                    <h1>Name</h1>
                    <textarea class="bg-[grey]"></textarea>
                </div>
            </div>
        </div>
        <div class="p-8">
            <h1>Pet's name</h1>
            <textarea class="bg-[grey]"></textarea>
        </div>
        <div class="p-8">
            <h1>Pet photo URL</h1>
            <textarea class="bg-[grey]"></textarea>
        </div>
        <div class="p-8">
            <h1>Pet tags (For now can just add one... Will add ability to add more later)</h1>
            <div>
                <div>
                    <h1>ID</h1>
                    <textarea class="bg-[grey]"></textarea>
                </div>
                <div>
                    <h1>Name</h1>
                    <textarea class="bg-[grey]"></textarea>
                </div>
            </div>
        </div>
        <div class="p-8">
            <h1>Pet status</h1>
            <select class="bg-[grey]">
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
