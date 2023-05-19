<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'season'];
    public $timestamps = false;

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
