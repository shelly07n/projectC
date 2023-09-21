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
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
