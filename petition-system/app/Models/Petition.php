<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
    'title',
    'description',
    'target',
    'signature_count',
    'user_id',
];
public function signatures()
{
    return $this->hasMany(Signature::class);
}

}