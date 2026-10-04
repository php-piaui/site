<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProposalStatus;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use RuntimeException;

class ProfileController extends Controller
{
    public function edit(Request $request, #[CurrentUser] User $user): View
    {
        return view('profile.edit', ['user' => $user, 'confirmDelete' => $request->boolean('excluir')]);
    }

    public function update(ProfileRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        $user->fill($request->profileAttributes());

        if ($request->hasFile('photo')) {
            $previous = $user->photo_path;
            $path     = $request->file('photo')->store(User::PHOTO_DIRECTORY, 's3');

            if ($path === false) {
                throw new RuntimeException('Não foi possível salvar a foto de perfil.');
            }

            $user->photo_path = $path;

            if ($previous) {
                Storage::disk('s3')->delete($previous);
            }
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'Perfil atualizado');
    }

    /**
     * Exclusão pela LGPD: apaga conta, foto e propostas em revisão. Palestras decididas ficam só com o nome.
     */
    public function destroy(Request $request, #[CurrentUser] User $user): RedirectResponse
    {
        $request->validate(['confirmation' => ['required', 'regex:/^\s*excluir\s*$/i']], ['confirmation.*' => 'Digite EXCLUIR para confirmar.']);

        $user->proposals()->where('status', ProposalStatus::Review)->delete();

        if ($user->photo_path) {
            Storage::disk('s3')->delete($user->photo_path);
        }

        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'Conta excluída');
    }
}
