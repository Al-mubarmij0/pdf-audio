
@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 800px;">

    <div class="mb-4">
        <a href="{{ route('convert.history') }}" class="btn btn-outline-secondary">
            📚 My Conversion History
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($history->count())
        <div class="d-grid gap-4">
            @foreach($history as $item)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <h5 class="card-title mb-0">📄 {{ $item->file_name }}</h5>
                                <small class="text-muted">
                                    Converted on {{ $item->created_at->format('F j, Y, g:i A') }}
                                </small>
                            </div>
                            <form action="{{ route('convert.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this conversion?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    🗑 Delete
                                </button>
                            </form>
                        </div>

                        @if($item->summary)
                            <blockquote class="blockquote">
                                <p class="mb-2 text-muted fst-italic">"{{ $item->summary }}"</p>
                            </blockquote>
                        @endif

                        <audio controls class="w-100 mt-2">
                            <source src="{{ asset($item->audio_path) }}" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $history->links() }}
        </div>
    @else
        <div class="alert alert-info text-center">
            No conversions yet.
        </div>
    @endif
</div>
@endsection
