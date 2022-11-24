<?php

namespace App\Models;

use App\Models\Schools;
use App\Models\Requests;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestsSchools extends Model
{
    use HasFactory;

    protected $table = 'requests_schools';

    protected $fillable = [
        'requests_id',
        'schools_id',
    ];

    protected $attributes = [
        'confirmed' => false
    ];

    public function schools() {
        return $this->belongsTo(Schools::class);
    }

    public function requests() {
        return $this->belongsTo(Requests::class);
    }
}
