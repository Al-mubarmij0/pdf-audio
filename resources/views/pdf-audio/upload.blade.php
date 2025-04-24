@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 600px;">
    <h2 class="text-center mb-4 fw-bold">📄 Upload PDF to Convert</h2>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('convert.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="pdf_file" class="form-label">Select PDF File:</label>
                    <input 
                        type="file" 
                        name="pdf_file" 
                        id="pdf_file" 
                        accept=".pdf" 
                        required 
                        class="form-control"
                    >
                </div>

                <button type="submit" class="btn btn-primary w-100">
                    🎧 Convert to Audio
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
