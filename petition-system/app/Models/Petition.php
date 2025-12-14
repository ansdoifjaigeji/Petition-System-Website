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
    // --- ADD THIS ARRAY ---
    protected $fillable = [
        'title',
        'description',
        'target',
        'signature_count',
        // 'user_id', // You can add this later
    ];

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}