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
        Schema::create('chatbot_messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conversation_id');
            $table->enum('message_type', ['user', 'bot', 'system']);
            $table->text('content');
            $table->json('metadata')->nullable(); // Store additional message data like intent, entities
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
            
            $table->foreign('conversation_id')->references('id')->on('chatbot_conversations')->onDelete('cascade');
            $table->index(['conversation_id', 'message_type', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_messages');
    }
};
