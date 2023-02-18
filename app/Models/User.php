<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'surname',
        'registration_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string
     */
    public static string $registration_code = "K";

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @return Attribute
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn($value) => Hash::make($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function surname(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str()->title($value),
        );
    }
}
