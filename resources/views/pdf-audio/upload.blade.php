@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-semibold mb-4">Upload PDF to Convert</h2>

<form action="{{ route('convert.submit') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded shadow space-y-4">
    @csrf
    <div>
        <label for="pdf_file" class="block font-medium">Select PDF file:</label>
        <input type="file" name="pdf_file" id="pdf_file" class="border w-full p-2 rounded mt-1" required>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
        Convert to Audio
    </button>
</form>
@endsection
