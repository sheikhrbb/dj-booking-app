<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMedia extends Model
{
    protected $fillable = ['service_id', 'file'];

    protected $appends = ['is_video', 'file_url'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getIsVideoAttribute()
    {
        $extension = strtolower(pathinfo($this->file, PATHINFO_EXTENSION));
        $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'];
        return in_array($extension, $videoExtensions);
    }

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file);
    }
}
