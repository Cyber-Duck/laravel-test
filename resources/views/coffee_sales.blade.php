<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 w-full">
                    <form method="POST" class="inline-flex w-full" id="create_sale_form" action="{{ route('coffee.sales.create') }}">
                        @csrf
                        <div class="sales-form-field">
                            <x-label for="coffee_type" :value="__('Coffee Type')"/>
                            {{Form::select(
                                'coffee_type',
                                $coffeeTypeOptions,
                                null,
                                ['class' => "block mt-1 w-30", 'id' => 'selectCoffeeType', 'placeholder' => '']
                            )}}
                        </div>

                        <div class="sales-form-field">
                            <x-label for="quantity" :value="__('Quantity')"/>
                            <x-input id="quantity" class="block mt-1 w-30" min="0" type="number" name="quantity"
                                     required autofocus/>
                        </div>

                        <div class="sales-form-field">
                            <x-label for="unit_cost" :value="__('Unit Cost (£)')"/>
                            <x-input id="unit_cost" class="block mt-1 w-30" min="0" step="0.01" type="number"
                                     name="unit_cost" required autofocus/>
                        </div>

                        <div class="sales-form-field">
                            <x-label for="selling_price" :value="__('Selling Price (£)')"/>
                            {{Form::number('selling_price', '0.00', ['class' => 'w-30 mt1 block selling-price', 'step' => 0.01, 'readonly=true' ])}}
                        </div>

                        <x-button class="ml-3 flex-column-reverse" id="record_sale_button">
                            {{ __('Record Sale') }}
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Previous Sales') }}
        </h2>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 w-full">
                    <table class="table table-bordered w-full">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Shipping Cost (£)</th>
                            <th>Unit Cost (£)</th>
                            <th>Selling Price (£)</th>
                            <th>Sold At</th>
                        </tr>
                        @foreach($sales as $key => $sale)
                            @if ($key !== 'meta')
                            <tr>
                                <td>{{ $sale['product'] }}</td>
                                <td>{{ $sale['quantity'] }}</td>
                                <td>{{ $sale['shipping_cost'] }}</td>
                                <td>{{ $sale['unit_price'] }}</td>
                                <td>{{ $sale['selling_price']}}</td>
                                <td>{{ $sale['sold_at']}}</td>
                            </tr>
                            @endif
                        @endforeach
                    </table>
                    {{-- Pagination --}}
                    <div class="d-flex justify-content-center">
                        {!! $sales['meta']['links'] ?? null !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="{{ asset('js/ajax.js')}}"></script>
