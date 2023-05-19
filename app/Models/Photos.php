<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;
    protected $fillable = ['photo', 'hotel_id'];
    public $timestamps = false;

    public static function add(UploadedFile $gallery, int $hotels_id)
    {
        $name = $gallery->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/hotel-photo/';
        $gallery->move($path, $name);
        self::create([
            'hotel_id' => $hotels_id,
            'photo' => $name
        ]);
    }

    public function deletePhoto()
    {
        $photo = public_path() . '/hotel-photo/' . $this->photo;
        unlink($photo);
        $this->delete();
    }
}
