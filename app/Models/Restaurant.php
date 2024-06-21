<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Plate;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Type;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_name', 'restaurant_slug', 'address', 'phone_number', 'p_iva', 'image', 'user_id'];

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

    /**
     * The types that belong to the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }

    /**
     * Get all of the orders for the Restaurant
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
