<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set new shipment cost 🚚') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" class="inline-flex w-full" id="create_sale_form" action="{{ route('shipping.cost.create') }}">
                        @csrf
                        <div class="sales-form-field">
                            <x-label for="cost" :value="__('New cost of shipment (£)')"/>
                            <x-input id="cost" class="block mt-1 w-30" min="0" step="0.01" type="number"
                                     name="cost" required autofocus/>
                            <x-button class="mt-5" id="change_shipment_cost_button">
                                {{ __('Set new price') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Log of Shipment costs') }}
        </h2>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 w-full">
                    <table class="table table-bordered w-full">
                        <tr>
                            <th>Shipment Cost (£)</th>
                            <th>Active</th>
                            <th>Set at</th>
                            <th>Number of sales</th>
                        </tr>
                        @foreach($shippingCosts as $key => $cost)
                            @if ($key !== 'meta')
                                <tr>
                                    <td>{{ $cost['cost'] }}</td>
                                    <td>{{ $cost['active'] }}</td>
                                    <td>{{ $cost['set_at'] }}</td>
                                    <td>{{ $cost['sale_count'] }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $shippingCosts['meta']['links'] ?? null !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/shipping-costs.js')}}"></script>
