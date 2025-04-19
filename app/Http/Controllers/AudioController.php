<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Smalot\PdfParser\Parser;
use App\Models\Conversion;

class AudioController extends Controller
{
    // Show the PDF upload form
    public function index()
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to upload PDFs.');
        }

        return view('pdf-audio.upload');
    }

    // Convert the uploaded PDF to audio
    public function convert(Request $request)
    {
        // Check if the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to convert PDFs.');
        }

        // Validate the uploaded PDF
        $request->validate([
            'pdf_file' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        // Use PDF Parser to extract text from the PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($request->file('pdf_file')->getRealPath());
        $text = $pdf->getText();

        // Save extracted text to a temporary file
        $tempTxt = public_path('temp_text.txt');
        file_put_contents($tempTxt, $text);

        // Create the audio directory if it doesn't exist
        $outputPath = public_path('audio');
        if (!file_exists($outputPath)) {
            mkdir($outputPath, 0755, true); // Create directory with proper permissions
        }

        // Create a unique file name for the audio file
        $fileName = 'audio_' . time() . '.mp3';
        $audioFile = $outputPath . '/' . $fileName;

        // Generate the audio file using gTTS (Google Text to Speech) command
        $command = "gtts-cli -f {$tempTxt} --output {$audioFile}";
        exec($command);

        // Store the conversion record in the database, associate it with the logged-in user
        $conversion = new Conversion();
        $conversion->user_id = auth()->id();  // Get the authenticated user's ID
        $conversion->file_name = $request->file('pdf_file')->getClientOriginalName();
        $conversion->audio_path = 'audio/' . $fileName;
        $conversion->summary = 'Congratulations, the test passed successfully!'; // Example summary, you can modify this
        $conversion->save();

        // Return the result view with the audio file and extracted text
        return view('pdf-audio.result', [
            'audioPath' => asset('audio/' . $fileName),
            'text' => $text
        ]);
    }

    // Show the conversion history of the authenticated user
    public function history()
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to view conversion history.');
        }

        // Get the currently authenticated user
        $user = auth()->user();
        $history = $user->conversions()->latest()->paginate(5); // Get the latest 5 conversions

        return view('pdf-audio.history', compact('history')); // Return history view
    }

    // Delete a specific conversion record
    public function destroy($id)
    {
        // Ensure the user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to delete conversions.');
        }

        // Find the conversion by the authenticated user
        $conversion = auth()->user()->conversions()->findOrFail($id);

        // Check if the audio file exists and delete it
        if (file_exists(public_path($conversion->audio_path))) {
            unlink(public_path($conversion->audio_path)); // Delete the audio file from storage
        }

        // Delete the conversion record from the database
        $conversion->delete();

        return back()->with('success', 'Conversion deleted successfully.');
    }
}
