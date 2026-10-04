<?php

declare(strict_types=1);

use App\Models\Proposal;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

test('updates the speaker profile and photo', function () {
    Storage::fake('s3');
    $user = User::factory()->create();

    $this->actingAs($user)->put('/perfil', [
        'name'     => 'Ana Sousa',
        'headline' => 'Dev backend',
        'bio'      => 'Escreve PHP desde o 5.6.',
        'github'   => 'github.com/anasousa',
        'website'  => 'https://ana.dev',
        'photo'    => UploadedFile::fake()->image('ana.png'),
    ])->assertRedirect(route('profile.edit'))->assertSessionHas('status', 'Perfil atualizado');

    $user->refresh();
    expect($user)->name->toBe('Ana Sousa')->headline->toBe('Dev backend');
    Storage::disk('s3')->assertExists($user->photo_path);
    $this->actingAs($user)->get('/perfil')->assertSee('value="github.com/anasousa"', false);
});

test('rejects files that are not images', function () {
    $this->actingAs(User::factory()->create())
        ->put('/perfil', ['name' => 'Ana', 'photo' => UploadedFile::fake()->create('ana.pdf', 10, 'application/pdf')])
        ->assertSessionHasErrors('photo');
});

test('asks for confirmation before deleting the account', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/perfil')->assertDontSee('Excluir sua conta de vez?');
    $this->actingAs($user)->get('/perfil?excluir=1')->assertSee('Excluir sua conta de vez?')->assertSee('name="_method" value="DELETE"', false);
    $this->actingAs($user)->delete('/perfil', ['confirmation' => 'apagar'])->assertSessionHasErrors('confirmation');

    expect($user->fresh())->not->toBeNull();
});

test('deletes the account and review proposals, keeping decided talks with the name only', function () {
    $user     = User::factory()->create(['name' => 'Ana Sousa']);
    $review   = Proposal::factory()->for($user)->create();
    $approved = Proposal::factory()->for($user)->approved()->create();

    $this->actingAs($user)->delete('/perfil', ['confirmation' => 'excluir'])
        ->assertRedirect(route('home'))
        ->assertSessionHas('status', 'Conta excluída');

    $this->assertGuest();
    expect(User::find($user->id))->toBeNull()
        ->and(Proposal::find($review->id))->toBeNull()
        ->and($approved->fresh())->user_id->toBeNull()->speaker_name->toBe('Ana Sousa');
});

test('removes old photos from storage when replaced or when the account is deleted', function () {
    Storage::fake('s3');
    $user = User::factory()->create();

    $this->actingAs($user)->put('/perfil', ['name' => 'Ana', 'photo' => UploadedFile::fake()->image('a.png')]);
    $first = $user->fresh()->photo_path;
    $this->actingAs($user)->put('/perfil', ['name' => 'Ana', 'photo' => UploadedFile::fake()->image('b.png')]);
    $second = $user->fresh()->photo_path;

    Storage::disk('s3')->assertMissing($first);
    expect($user->fresh()->photoUrl())->toContain($second);

    $this->actingAs($user->fresh())->delete('/perfil', ['confirmation' => 'EXCLUIR']);
    Storage::disk('s3')->assertMissing($second);
});
