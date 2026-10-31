<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['code', 'name', 'location', 'description', 'price',
                           'activity_date', 'difficulty', 'guide_id'];

    // An activity belongs to one guide
    public function guide()
    {
        return $this->belongsTo(Guide::class, 'guide_id', 'guide_id');
    }

    // An activity has many bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'activity_code', 'code');
    }
}