<div>
    <form wire:submit.prevent="submit">
        <div>
            <x-label for="shipping" :value="__('New cost of shipment')" />
            <x-input id="shipping" wire:model="shipping" class="block mt-1" type="text" />
            @error('shipping') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div>
            <x-button class="ml-4">
                {{ __('Set new price') }}
            </x-button>
        </div>
    </form>

    @if (count($shippings))
        <h2>Log of Shipment Costs</h2>

        <table style="width: 100%;">
            <tr>
                <th style="text-align: left;">Shipment Cost</th>
                <th style="text-align: left;">Active</th>
                <th style="text-align: left;">Set at</th>
                <th style="text-align: left;">Number of Sales</th>
            </tr>

            @foreach ($shippings as $key => $shipping)
                <tr>
                    <td>£{{ $shipping->cost }}</td>
                    <td>
                        {{ $key == 0 ? 'Yes' : 'No' }}
                    </td>
                    <td>
                        {{ $shipping->created_at ? $shipping->created_at->format('jS F Y H:i') : null }}
                    </td>
                    <td>
                        {{ $shipping->sales()->count() }}
                    </td>
                </tr>
            @endforeach
        </table>
    @endif
</div>
