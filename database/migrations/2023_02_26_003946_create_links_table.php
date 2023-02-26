<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
	    $table->string('url');
	    $table->string('shortcode');
	    $table->unsignedBigInteger('user_id');

	    // Access patterns will be primarily:
	    // * Get one link by shortcode
	    // * Get all links by user_id
	    $table->index(['shortcode', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
