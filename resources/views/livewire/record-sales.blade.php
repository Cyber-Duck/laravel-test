<div>
    <div class="grid grid-cols-4 gap-4">
        <form wire:submit.prevent="submit">
            <div>
                <x-label for="quantity" :value="__('Quantity')" />
                <x-input id="quantity" wire:model="quantity" class="block mt-1" type="text" autofocus />
                @error('quantity') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-label for="cost" :value="__('Unit Cost')" />
                <x-input id="unit-cost" wire:model="unitCost" class="block mt-1" type="text" />
                @error('unitCost') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-label for="selling_price" :value="__('Selling Price')" />

                <div>
                    @if ($sellingPrice)
                        £{{ $sellingPrice }}
                    @endif
                </div>
            </div>

            <div>
                <x-button class="ml-4">
                    {{ __('Record Sale') }}
                </x-button>
            </div>
        </form>
    </div>




</div>
