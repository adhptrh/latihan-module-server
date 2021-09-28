<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'deadline',
        'created_by',
    ];

    public function choices()
    {
        return $this->hasMany(Choice::class);
    }

    public function users()
    {
        return $this->hasOne(User::class,"id","created_by");
        //return $this->belongsToMany(User::class,"users","created_by")->withPivot("username");

    }

    public function scopeDeadline($query) {
        if (auth()->user()->role !== "admin") {
            return $query->where("deadline","<",Date(now()));
        }
        return $query;
    }
}
