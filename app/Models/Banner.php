<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Banner extends Model
{
    protected $fillable = [
        'image',
        'is_active',
        'order'
    ];


    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (!$this->image) {
                    return null;
                }

                // Jika sudah full URL, return as is
                if (str_starts_with($this->image, 'http')) {
                    return $this->image;
                }

                // Generate URL dengan custom domain Cloudflare R2
                return config('filesystems.disks.s3.url') . '/' . $this->image;
            }
        );
    }

    /**
     * Append accessor to array/JSON
     */
    protected $appends = ['image_url'];

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'product_id');
    }
}
