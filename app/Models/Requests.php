<?php

namespace App\Models;

use App\Models\User;
use App\Models\Schools;
use App\Models\RequestsSchools;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Requests extends Model
{
    use HasFactory;

    protected $fillable = ['idnumber', 'user_id', 'dateofbirth', 'name', 'class'];

    public function schools() {
        return $this->belongsToMany(Schools::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function requests_schools() {
        return $this->hasMany(RequestsSchools::class);
    }
}
