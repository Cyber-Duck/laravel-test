
@props(['options', 'trigger'])

<div class="relative">
    <button class="block w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
        {{ $trigger }}
    </button>
    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg">
        @foreach ($options as $option)
            <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">{{ $option }}</a>
        @endforeach
    </div>
</div>
