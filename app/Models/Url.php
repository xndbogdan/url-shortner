<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;

    protected $appends = ['shortened_url'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'destination',
        'slug',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function getShortenedUrlAttribute()
    {
        return route('url.show', $this->slug);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
