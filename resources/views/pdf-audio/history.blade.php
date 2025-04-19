@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-6">
<a href="{{ route('convert.history') }}">📚 My Conversion History</a>

    

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if($history->count())
        <div class="space-y-6">
            @foreach($history as $item)
                <div class="bg-white p-4 rounded shadow">
                    <div class="flex justify-between items-center mb-2">
                        <div>
                            <p class="text-lg font-semibold text-gray-800">📄 {{ $item->file_name }}</p>
                            <p class="text-sm text-gray-500">Converted on {{ $item->created_at->format('F j, Y, g:i A') }}</p>
                        </div>
                        <form action="{{ route('convert.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this conversion?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700 text-sm">🗑 Delete</button>
                        </form>
                    </div>

                    @if($item->summary)
                        <p class="text-gray-700 text-sm italic mb-2">"{{ $item->summary }}"</p>
                    @endif

                    <audio controls class="w-full mt-2">
                        <source src="{{ asset($item->audio_path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $history->links() }}
        </div>
    @else
        <p class="text-gray-600 text-center">No conversions yet.</p>
    @endif
</div>
@endsection
