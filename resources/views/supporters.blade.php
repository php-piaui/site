<x-layouts.site title="Apoiadores" current="apoiadores">
    <div class="pp-container pb-18">
        <x-page-head title="Apoiadores" lead="Empresas e instituições que emprestam espaço, café, transmissão e divulgação. Todo apoio aparece com o mesmo destaque, em ordem alfabética." />
        <x-supporter-grid :supporters="$supporters" />
        <section id="apoiar" class="mt-12 flex flex-wrap items-center justify-between gap-6 rounded-xl border border-line bg-card p-[clamp(24px,4vw,40px)]">
            <div class="grid max-w-[56ch] gap-2">
                <h2>Quer apoiar a comunidade?</h2>
                <p class="text-[17px] leading-[26px] text-fg-muted">Um auditório por uma noite, o café do intervalo, a transmissão ao vivo. Escreva para a gente contando como você pode ajudar.</p>
            </div>
            <x-button variant="cta" size="lg" icon="mail" href="mailto:apoio@phppiaui.com.br">Quero apoiar</x-button>
        </section>
    </div>
</x-layouts.site>
