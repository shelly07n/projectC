<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contacts extends Model
{
    use HasFactory;

    protected $table = 'contacts';

    protected $fillable = [
        'id',
        'name',
        'user_id',
        'relationship',
        'dob',
        'mobile',
        'email',
        'status',
        'image'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }



    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }

    public function contacts()
    {
        return $this->hasMany(User::class);
    }
}
