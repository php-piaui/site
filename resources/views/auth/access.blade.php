{{-- Login e cadastro na mesma tela, com abas (AuthScreen em ui_kits/site/CfpScreens.jsx). $cfp repete o contexto de quem veio do CFP. --}}
@php
    $isLogin = $mode === 'login';
    $query = $cfp ? ['cfp' => 1] : [];
@endphp

<x-layouts.site :title="$isLogin ? 'Entrar' : 'Criar conta'">
    <div class="pp-container max-w-[520px] pt-10 pb-18">
        @if ($cfp)
            <div class="mb-6 flex items-center gap-3.5 rounded-md bg-brand-soft px-4 py-3.5">
                <x-logo variant="symbol" :size="28" title="" />
                <p class="text-[15px] leading-[22px]">{{ $isLogin ? 'Entre' : 'Crie sua conta' }} para submeter sua proposta ao CFP do <b>{{ $cfp->event->title }}</b>.</p>
            </div>
        @endif
        <div class="pp-card grid gap-5 p-7">
            <h1 class="text-3xl">{{ $isLogin ? 'Entrar' : 'Criar conta' }}</h1>
            <x-tabs label="Acesso" :value="$mode" :tabs="[
                ['value' => 'signup', 'label' => 'Criar conta', 'href' => route('register', $query)],
                ['value' => 'login', 'label' => 'Entrar', 'href' => route('login', $query)],
            ]" />
            @if ($errors->any())
                <x-alert tone="danger" :title="$isLogin ? 'Não deu para entrar' : 'Confira os dados'">Corrija o campo destacado e tente de novo.</x-alert>
            @endif
            <form method="POST" action="{{ route($isLogin ? 'login.store' : 'register.store') }}" class="grid gap-4.5">
                @csrf
                @if ($cfp)
                    <input type="hidden" name="cfp" value="1">
                @endif
                @unless ($isLogin)
                    <x-text-field name="name" label="Como quer ser chamada(o)?" autocomplete="name" required />
                @endunless
                <x-text-field name="email" type="email" label="E-mail" autocomplete="email" required />
                <x-text-field name="password" type="password" label="Senha" :autocomplete="$isLogin ? 'current-password' : 'new-password'" :hint="$isLogin ? null : 'Pelo menos 8 caracteres.'" required />
                @unless ($isLogin)
                    <x-checkbox name="terms" required>
                        <x-slot:label>Li e aceito o <a href="{{ route('conduct') }}">código de conduta</a> e a <a href="{{ route('privacy') }}">política de privacidade</a>.</x-slot:label>
                    </x-checkbox>
                @endunless
                <x-button :variant="$cfp ? 'cta' : 'primary'" size="lg" block type="submit">{{ $isLogin ? 'Entrar e continuar' : 'Criar conta e continuar' }}</x-button>
            </form>
        </div>
    </div>
</x-layouts.site>
