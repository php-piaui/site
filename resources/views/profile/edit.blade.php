<x-layouts.site title="Perfil de palestrante">
    <div class="pp-container max-w-[760px] pb-18">
        <x-page-head title="Perfil de palestrante" lead="Essas informações aparecem na página do evento quando uma proposta sua é aprovada." />
        <form method="POST" enctype="multipart/form-data" class="pp-card grid gap-5.5 p-7">
            @csrf
            <x-photo-upload name="photo" initials="AS" />
            <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,240px),1fr))] gap-4.5">
                <x-text-field name="name" label="Nome" value="Ana Sousa" autocomplete="name" />
                <x-text-field name="role" label="Cargo e empresa" optional value="Dev backend" />
            </div>
            <x-text-area name="bio" label="Mini bio" :max-length="280" :rows="4" value="Escreve PHP desde o 5.6 e hoje cuida de filas e integrações de pagamento. Gosta de testes, café e de explicar as coisas devagar." hint="Em terceira pessoa, até 280 caracteres." />
            <fieldset class="pp-fieldset gap-3.5">
                <legend class="pp-label">Redes <span class="pp-label__opt">(opcional)</span></legend>
                <div class="grid grid-cols-[repeat(auto-fit,minmax(min(100%,240px),1fr))] gap-3.5">
                    <x-text-field name="github" label="GitHub" icon="github" value="github.com/anasousa" />
                    <x-text-field name="linkedin" label="LinkedIn" icon="linkedin" placeholder="linkedin.com/in/…" />
                    <x-text-field name="instagram" label="Instagram" icon="instagram" placeholder="@usuario" />
                    <x-text-field name="site" label="Site" icon="globe" type="url" placeholder="https://" />
                </div>
            </fieldset>
            <div class="flex justify-end"><x-button variant="primary" type="submit">Salvar perfil</x-button></div>
        </form>

        <section class="mt-10 grid gap-3 rounded-lg border border-danger-line p-6">
            <h2 class="text-xl leading-[26px]">Excluir minha conta</h2>
            <p class="max-w-[62ch] text-[15px] text-fg-muted">Apagamos seus dados pessoais, foto e propostas em revisão, como prevê a LGPD. Palestras já apresentadas continuam na programação histórica só com seu nome, a menos que você peça a remoção.</p>
            <div><x-button variant="danger" icon="trash-2" :href="route('profile.edit', ['excluir' => 1])">Excluir minha conta</x-button></div>
        </section>
    </div>

    @if ($confirmDelete)
        <x-confirm-dialog tone="danger" icon="trash-2" title="Excluir sua conta de vez?" :action="route('profile.edit')" method="DELETE" :cancel-href="route('profile.edit')" confirm-label="Excluir minha conta">
            <div class="grid gap-3.5">
                <p>Não dá para desfazer. Você perde o histórico de propostas e precisa criar outra conta para participar de um próximo CFP.</p>
                <x-text-field name="confirmation" label="Digite “EXCLUIR” para confirmar" required pattern="[Ee][Xx][Cc][Ll][Uu][Ii][Rr]" autocomplete="off" />
            </div>
        </x-confirm-dialog>
    @endif
</x-layouts.site>
