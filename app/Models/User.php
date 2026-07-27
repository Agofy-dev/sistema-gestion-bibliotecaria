<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributos asignables de forma masiva.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'second_name',
        'last_name',
        'second_last_name',
        'cedula',
        'telefono',
        'email',
        'password',
        'role_id',
    ];

    /**
     * Relación con el Rol del usuario.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Mutador para limpiar espacios y convertir el correo a minúsculas automáticamente.
     */
    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => strtolower(trim($value)),
        );
    }

    /**
     * Accesor para obtener el nombre completo del usuario limpiando espacios sobrantes.
     */
    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => trim(preg_replace('/\s+/', ' ', "{$this->name} {$this->second_name} {$this->last_name} {$this->second_last_name}"))
        );
    }

    /**
     * Verifica si el usuario posee un rol específico.
     * Soporta 'super_admin', 'superadmin', 'admin', 'lector', etc.
     */
    public function hasRole(string|array $roles): bool
    {
        if (!$this->role) {
            return false;
        }

        $rolesToCheck = is_array($roles) ? $roles : [$roles];

        $userKey = strtolower(str_replace([' ', '_', '-'], '', $this->role->key ?? ''));
        $userName = strtolower(str_replace([' ', '_', '-'], '', $this->role->name ?? ''));

        foreach ($rolesToCheck as $role) {
            $targetRole = strtolower(str_replace([' ', '_', '-'], '', $role));

            if ($userKey === $targetRole || $userName === $targetRole) {
                return true;
            }
        }

        return false;
    }

    /**
     * Atributos que deben ser casteados.
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
}