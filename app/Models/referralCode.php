<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class referralCode extends Model
{
    use HasFactory;

    protected $table = 'referralCode';

    protected $fillable = [
        'id',
        'contest_id',
        'referral_id',
        'referral_code'
    ];

    public function contest()
    {
        return $this->belongsTo(contests::class);

    }
}
