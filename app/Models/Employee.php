<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'user_id',
    ];

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function services() : HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function schedules() : HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }






}
