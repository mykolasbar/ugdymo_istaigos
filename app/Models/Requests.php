<?php

namespace App\Models;

use App\Models\Schools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = ['idnumber', 'user_id', 'dateofbirth', 'name', 'class'];

    public function schools() {
        return $this->belongsToMany(Schools::class);
    }
}
