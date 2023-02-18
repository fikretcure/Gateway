<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

/**
 *
 */
class Token extends Model
{
    use HasFactory;
    use HasJsonRelationships;


    /**
     * @var string[]
     */
    protected $fillable = [
        "data",
        "id"
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        "data" => "json",
        "id" => "string"
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "data->user_id");
    }
}
