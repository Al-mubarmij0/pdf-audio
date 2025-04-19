<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversionsTable extends Migration
{
    public function up()
    {
        Schema::create('conversions', function (Blueprint $table) {
            $table->id();
            // Foreign key for user_id, automatically references the id column on users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('file_name');
            $table->string('audio_path');
            $table->text('summary')->nullable(); // Make summary field nullable
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('conversions');
    }
}
