<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['user_id', 'activity_code', 'participants',
                           'safety_notes', 'status'];

    // A booking belongs to one user (the customer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A booking belongs to one activity
    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_code', 'code');
    }
}