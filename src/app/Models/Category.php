<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['content'];

    /**
     * Category は複数の Contact を持つ (1対多)
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}