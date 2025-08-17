<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject; // Thêm dòng này

class User extends Authenticatable implements JWTSubject // Thêm implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'email_verification_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ===== THÊM 2 PHƯƠNG THỨC BẮT BUỘC CHO JWT =====
    /**
     * Get the JWT identifier (usually the user ID).
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Trả về ID của user (khóa chính)
    }

    /**
     * Get custom claims for JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return []; // Có thể thêm thông tin tùy chỉnh vào token (ví dụ: role)
    }
}