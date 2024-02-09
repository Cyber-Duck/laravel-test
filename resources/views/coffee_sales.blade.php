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
                            <label for="quantity">Quantity:</label>
                            <input type="number" name="quantity" id="quantity" required>
                            <label for="unit_cost">Unit Cost (£):</label>
                            <input type="number" name="unit_cost" id="unit_cost" required>
                            <button type="submit">Calculate</button>
                        </form>
                    </div>
                    <div>
                        <!-- Result -->
                            <table class="border-collapse border border-gray-400 mt-4">
                                <thead>
                                    <tr>
                                        <th class="border border-gray-400 px-4 py-2">Quantity</th>
                                        <th class="border border-gray-400 px-4 py-2">Unit Cost</th>
                                        <th class="border border-gray-400 px-4 py-2">Selling Price</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="border border-gray-400 px-4 py-2"></td>
                                        <td class="border border-gray-400 px-4 py-2"></td>                                    
                                        <td class="border border-gray-400 px-4 py-2"></td>
                                    </tr>
                        </tbody>
                    </table>
                    </div>    
                </div>   
            </div>
        </div>
    </div>
</x-app-layout>
