<?php

declare(strict_types=1);

test('renders a primary md button by default', function () {
    $this->blade('<x-button>Ver detalhes</x-button>')
        ->assertSee('<button', false)
        ->assertSee('type="button"', false)
        ->assertSee('class="pp-btn pp-btn--primary"', false)
        ->assertSee('Ver detalhes');
});

test('renders variant, size, block and leading icon', function () {
    $this->blade('<x-button variant="cta" size="lg" block icon="send" type="submit">Submeter proposta</x-button>')
        ->assertSee('class="pp-btn pp-btn--cta pp-btn--lg pp-btn--block"', false)
        ->assertSee('type="submit"', false)
        ->assertSee('width="18"', false);
});

test('renders an external link with screen reader hint', function () {
    $this->blade('<x-button variant="cta" href="https://sympla.com.br" external>Inscrever-se</x-button>')
        ->assertSee('<a', false)
        ->assertSee('href="https://sympla.com.br"', false)
        ->assertSee('target="_blank" rel="noopener noreferrer"', false)
        ->assertSee('class="shrink-0 pp-btn__ext"', false)
        ->assertSee('(abre em outro site)');
});

test('renders a disabled href as a disabled button', function () {
    $this->blade('<x-button href="/x" disabled>Indisponível</x-button>')
        ->assertDontSee('<a', false)
        ->assertSee('disabled', false);
});

test('renders loading state with spinner instead of icons', function () {
    $this->blade('<x-button variant="danger" loading icon="send" icon-right="x">Excluindo…</x-button>')
        ->assertSee('aria-busy="true"', false)
        ->assertSee('class="shrink-0 pp-spin"', false)
        ->assertDontSee('M18 6 6 18', false);
});

test('renders icon-only button with accessible label', function () {
    $this->blade('<x-button variant="ghost" size="sm" icon-only icon="x" label="Fechar" />')
        ->assertSee('class="pp-btn pp-btn--ghost pp-btn--sm pp-btn--icon"', false)
        ->assertSee('aria-label="Fechar"', false)
        ->assertSee('<span class="sr-only">Fechar</span>', false)
        ->assertSee('width="16"', false);
});
