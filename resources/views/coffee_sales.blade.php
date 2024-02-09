<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div>
                        <form action="{{ url('sales') }}" method="post">
                            @csrf
                            <label for="Coffee Type">Coffee Type:</label>
                            <select name="coffee_type" id="coffee_type">
                                <option value="gold">Gold</option>
                                <option value="arabic">Arabic</option>
                            </select>
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" required>
                            <label for="unit_cost">Unit Cost (£):</label>
                            <input type="number" name="unit_cost" id="unit_cost" step='0.1' required>
                            <button type="submit">Calculate</button>
                        </form>
                    </div>
                    <div>
                       @if($coffeSalesData) 
                       <div> 
                            <x-table-with-border :headers="['Coffee Type','Quantity', 'Unit Cost (£):', 'Selling Price']" :data="$coffeSalesData" />
                        </div>   
                       @endif  
                    </div>    
                </div>   
            </div>
        </div>
    </div>    
</x-app-layout>
