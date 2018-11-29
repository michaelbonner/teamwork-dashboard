<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = [];

    protected $casts = [
        'members' => 'array',
    ];

    public function getTeamMembersAttribute()
    {
        return resolve('Teamwork')->getPeople()->filter(function ($person) {
            return in_array($person->id, $this->members);
        });
    }
}
