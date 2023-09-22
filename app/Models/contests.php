<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\contestants;

class contests extends Model
{
    use HasFactory;

    protected $table = 'contests';

    protected $fillable = [
        'id',
        'name',
        'type',
        'start_date',
        'end_date',
        'contestant_limit',
        'winning_prize',
        'description',
    ];

    public function contestants()
    {
        return $this->hasOne(contestants::class);
    }
    public function referralCode()
    {
        return $this->hasOne(referralCode::class);
    }

}
