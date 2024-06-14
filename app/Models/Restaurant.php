<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin\Plate;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{

    protected $fillable = ['name', 'address', 'phone_number', 'vat', 'image', 'mail', 'user_id'];


    /**
     * Get the user that owns the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the Projects for the Type
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function plates(): HasMany
    {
        return $this->hasMany(Plate::class);
    }

    use HasFactory;
}
