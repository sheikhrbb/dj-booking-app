<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['title', 'description', 'service_type'];

    public const SERVICE_TYPES = [
        'floor' => 'Floor',
        'baraat' => 'Baraat',
        'events' => 'Events',
        'others' => 'Others',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function media()
    {
        return $this->hasMany(\App\Models\ServiceMedia::class);
    }

    public static function getServiceTypeKeys()
    {
        return array_keys(self::SERVICE_TYPES);
    }
}
