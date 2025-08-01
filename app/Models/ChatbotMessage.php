<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatbotMessage extends Model
{
    protected $fillable = [
        'conversation_id',
        'message_type',
        'content',
        'metadata',
        'processed_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'processed_at' => 'datetime',
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(ChatbotConversation::class, 'conversation_id');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('message_type', $type);
    }

    public function scopeUserMessages($query)
    {
        return $query->where('message_type', 'user');
    }

    public function scopeBotMessages($query)
    {
        return $query->where('message_type', 'bot');
    }

    public function markAsProcessed()
    {
        $this->update(['processed_at' => now()]);
    }
}
