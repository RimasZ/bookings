<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\UploadedFile;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'price', 'country_id', 'duration', 'photo'];
    public $timestamps = false;

    const SORT = [
        'default' => 'No sort',
        'name_asc' => 'By name A-Z',
        'name_desc' => 'By name Z-A',
        'price_asc' => 'By price A-Z',
        'price_desc' => 'By price Z-A',
    ];


    public function deletePhoto()
    {
        if ($this->photo) {
            $photo = public_path() . '/hotel-photo/' . $this->photo;
            unlink($photo);
            $photo = public_path() . '/hotel-photo/t_' . $this->photo;
            unlink($photo);
        }
        $this->update([
            'photo' => null,
        ]);
    }

    public function savePhoto(UploadedFile $photo) : string
    {
        $name = $photo->getClientOriginalName();
        $name = rand(1000000, 9999999) . '-' . $name;
        $path = public_path() . '/hotel-photo/';
        $photo->move($path, $name);
        $img = Image::make($path . $name);
        $img->resize(200, 200);
        $img->save($path . 't_' . $name, 90);
        return $name;
    }
}
