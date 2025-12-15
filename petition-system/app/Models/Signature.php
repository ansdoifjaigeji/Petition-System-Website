<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signature extends Model
{
    use HasFactory;

    protected $fillable = [
        'petition_id',
        'name',
        'email',
        'user_id',
        'comment',
    ];

    public function petition()
    {
        return $this->belongsTo(Petition::class);
    }
}
