<?php

namespace App\Models;

use App\Models\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schools extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'address',
    ];

    public function requests() {
        return $this->belongsToMany(Requests::class);
    }
}
