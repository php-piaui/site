<x-layouts.site title="Política de privacidade">
    <div class="pp-container pb-18">
        <x-page-head title="Política de privacidade" lead="Atualizado em 1º de setembro de 2026" :crumbs="[['label' => 'Início', 'href' => route('home')], ['label' => 'Política de privacidade']]" />
        <article class="pp-prose">
            <p>Esta política explica quais dados pessoais coletamos no site phppiaui.com.br, por que coletamos e como você pode pedir a exclusão, conforme a Lei Geral de Proteção de Dados (Lei nº 13.709/2018).</p>
            <h2>Dados que coletamos</h2>
            <ul>
                <li><b>Conta:</b> e-mail e senha (guardada com hash).</li>
                <li><b>Perfil de palestrante:</b> nome, foto, mini bio, cargo e redes — só se você preencher.</li>
                <li><b>Propostas:</b> o conteúdo que você envia ao CFP.</li>
            </ul>
            <h2>Para que usamos</h2>
            <p>Para avaliar propostas, montar a programação e avisar você sobre a decisão por e-mail. Não vendemos nem compartilhamos seus dados com apoiadores.</p>
            <h2>Seus direitos</h2>
            <p>Você pode editar seus dados a qualquer momento e excluir sua conta em <a href="{{ route('profile.edit') }}">Perfil › Excluir minha conta</a>. Dúvidas: <a href="mailto:privacidade@phppiaui.com.br">privacidade@phppiaui.com.br</a>.</p>
        </article>
    </div>
</x-layouts.site>
