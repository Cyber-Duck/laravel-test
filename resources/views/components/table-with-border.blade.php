@props(['headers', 'data'])

<div class="overflow-x-auto">
    <table class="min-w-full border-collapse border border-gray-300">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th class="px-4 py-2 bg-gray-100 border border-gray-300">{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td class="px-4 py-2 border border-gray-300">{{ $cell }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>