<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'email', 'password', 'headline', 'bio', 'github', 'linkedin', 'instagram', 'website'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'is_admin'          => 'boolean',
        ];
    }

    /**
     * @return HasMany<Proposal, $this>
     */
    public function proposals(): HasMany
    {
        return $this->hasMany(Proposal::class);
    }

    public function photoUrl(): ?string
    {
        return $this->photo_path ? Storage::disk('public')->url($this->photo_path) : null;
    }

    /**
     * Redes preenchidas no perfil, no formato do x-speaker-card. Aceita URL completa, "github.com/fulano" ou "@fulano".
     *
     * @return list<array{network: string, url: string}>
     */
    public function socials(): array
    {
        $bases = ['github' => 'https://github.com/', 'linkedin' => 'https://www.linkedin.com/in/', 'instagram' => 'https://www.instagram.com/', 'website' => 'https://'];

        $socials = [];

        foreach ($bases as $field => $base) {
            $value = $this->{$field};

            if (! is_string($value) || $value === '') {
                continue;
            }

            $socials[] = ['network' => $field === 'website' ? 'site' : $field, 'url' => match (true) {
                str_starts_with($value, 'http') => $value,
                str_contains($value, '.')       => 'https://'.$value,
                default                         => $base.ltrim($value, '@'),
            }];
        }

        return $socials;
    }
}
