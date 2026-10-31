<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $primaryKey = 'guide_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['guide_id', 'name', 'phone', 'experience_years'];

    public function activities ()
    {
        return $this->hasMany(Activity::class, 'guide_id', 'guide_id');
    }
    //
}
