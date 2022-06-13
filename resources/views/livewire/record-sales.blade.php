<div>
    <div class="grid grid-cols-4 gap-4">
        <form wire:submit.prevent="submit">
            <div>
                <x-label for="product" :value="__('Product')" />

                <select wire:model="product">
                    <option value="">Select</option>
                    @foreach ($products as $productId => $productName)
                        <option value="{{ $productId }}">{{ $productName }}</option>
                    @endforeach
                </select>

                @error('product') <span class="error">{{ $message }}</span> @enderror
            </div>

            <div>
                <x-label for="quantity" :value="__('Quantity')" />
                <x-input id="quantity" wire:model="quantity" class="block mt-1" type="text" />
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

    @if (count($sales))
        <table style="width: 100%;">
            <tr>
                <th style="text-align: left;">Product</th>
                <th style="text-align: left;">Quantity</th>
                <th style="text-align: left;">Shipping Cost</th>
                <th style="text-align: left;">Unit Cost</th>
                <th style="text-align: left;">Selling Price</th>
                <th style="text-align: left;">Sold At</th>
            </tr>

            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->product ? $sale->product->name : null }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>£{{ $sale->shipping ? $sale->shipping->cost : null }}</td>
                    <td>£{{ $sale->unit_cost }}</td>
                    <td>£{{ $sale->selling_price }}</td>
                    <td>{{ $sale->created_at ? $sale->created_at->format('jS F Y H:i') : null }}</td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
