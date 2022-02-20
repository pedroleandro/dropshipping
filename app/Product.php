<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'inventory',
        'price',
        'photo'
    ];

    public function getPhotoUrlAttribute()
    {
        return Storage::url(Cropper::thumb($this->photo, 1366, 768));
    }

    public function setPriceAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['price'] = null;
        } else {
            $this->attributes['price'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2, ',', '.');
    }

    private function convertStringToDouble(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        return floatval(str_replace(',', '.', str_replace('.', '', $param)));
    }
}
