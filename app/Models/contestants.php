<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contests;

class contestants extends Model
{
    use HasFactory;

    protected $table = 'contestants';

    protected $fillable = [
        'id',
        'name',
        'contest_id',
        'referral_id',
        'start_position',
        'current_position',
    ];

    public function contest()
    {
        return $this->belongsTo(contests::class);
    }

}
