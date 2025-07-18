<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    protected $fillable = [
        'family_id',
        'name',
        'relation',
        'gender',
        'birth_date',
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
