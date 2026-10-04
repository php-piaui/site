# Checklist — production ready

Levantamento feito em 2026-10-04 sobre a `main` (commit `91c59ba`). Estado de partida:
99 testes passando, PHPStan sem erros, cobertura 98,8%.

Prioridades:
- **P0** — bloqueia o lançamento (fluxo quebrado, segurança, dado falso publicado).
- **P1** — deve entrar antes ou logo após o lançamento.
- **P2** — polimento, pode esperar.

Marque `[x]` ao concluir e, se a decisão mudar o escopo, registre em uma ADR.

---

## 1. Fluxos que ainda não funcionam

### Autenticação e conta
- [ ] **P0** Recuperação de senha ("Esqueci minha senha"): não existe rota, tela nem e-mail. Quem esquecer a senha perde a conta e as propostas. (`routes/web.php`, `resources/views/auth/access.blade.php`)
- [ ] **P0** Criar o primeiro admin em produção: hoje só o `DatabaseSeeder` cria admin, e com a senha `password` da factory. Criar um comando (ex.: `php artisan user:admin email@...`) para promover/rebaixar usuário (ADR 0001 §2.1.1).
- [ ] **P1** Trocar e-mail e senha no perfil: o formulário de perfil não tem esses campos. (`resources/views/profile/edit.blade.php`)
- [ ] **P1** Menu da conta no cabeçalho: o botão com o nome do usuário vai só para "Minhas propostas". "Perfil" só aparece pelo formulário de proposta e "Sair" só na página de perfil. (`resources/views/components/layouts/site.blade.php`, `components/site-header.blade.php`)
- [ ] **P2** Decidir se o cadastro exige verificação de e-mail (`MustVerifyEmail`). Sem ela, contas com e-mail digitado errado nunca recebem a resposta da proposta.
- [ ] **P2** "Lembrar de mim" no login.

### Painel — propostas
- [ ] **P0** Ler a proposta antes de decidir: na tabela, propostas **em revisão** só mostram "Aprovar"/"Recusar"; o link "Ver" só aparece depois da decisão e o título não é clicável. O admin decide sem ler resumo e notas. (`resources/views/components/proposal-table/actions.blade.php`, `components/proposal-table.blade.php`)
- [ ] **P1** O painel mostra só o CFP com `opens_at` mais recente. Ao criar um CFP futuro, o CFP aberto agora some do painel; CFPs antigos ficam inacessíveis. Adicionar seletor de CFP. (`app/Http/Controllers/Admin/ProposalController.php:21`)
- [ ] **P1** Aprovar/Recusar pela página de detalhe de uma proposta de CFP antigo não abre o diálogo (o índice só procura no CFP mais recente). (`resources/views/admin/proposal.blade.php`)
- [ ] **P1** Mostrar o e-mail do palestrante no detalhe da proposta: a organização não tem como contatar a pessoa (o e-mail de aprovação promete "a gente manda o horário").
- [ ] **P2** Depois de decidir, o redirect perde filtro de status e busca. (`app/Http/Controllers/Admin/ProposalDecisionController.php:34`)

### Painel — eventos e CFP
- [ ] **P1** Editar ou encerrar CFP: só existe "Abrir CFP". Errou a data ou o formato, não há correção pelo painel. (`app/Http/Controllers/Admin/CfpController.php`)
- [ ] **P1** Lista de CFPs no painel: a coluna "CFP" em Eventos só mostra os abertos; agendado ou encerrado aparece como "—". (`resources/views/admin/events.blade.php:18`)
- [ ] **P1** Imagem do evento (ADR 0001 §2.2): sem coluna, sem upload, sem exibição. Card e página do evento só mostram o placeholder. (`database/migrations/2026_10_04_095016_create_events_table.php`, `components/event-card.blade.php`)
- [ ] **P2** Pré-visualizar rascunho: `events.show` dá 404 para evento sem `published_at`, inclusive para admin. (`app/Http/Controllers/EventController.php:25`)
- [ ] **P2** Excluir evento cadastrado por engano (hoje só despublicar como rascunho).
- [ ] **P2** Link "Ver no site" na lista de eventos do painel.

### Propostas (palestrante)
- [ ] **P1** Edição após o fim do prazo: o código permite editar enquanto estiver em revisão, mesmo depois do CFP fechar, mas o modal pré-login e o e-mail de recebimento dizem "até o fim do prazo". Decidir a regra e alinhar código + textos. (`app/Policies/ProposalPolicy.php`, `cfp/show.blade.php` modal, `emails/proposal-status.blade.php`)
- [ ] **P1** Proposta em dupla: as regras do CFP dizem "Pode ser em dupla", mas a proposta só tem um palestrante. Remover o texto ou implementar coautoria. (`resources/views/cfp/show.blade.php:34`)
- [ ] **P2** Renomear o perfil não atualiza `speaker_name` das propostas já enviadas; a programação mostra o nome antigo.
- [ ] **P2** Vários CFPs abertos ao mesmo tempo: home, página do CFP e envio usam só o primeiro (`Cfp::open()->first()`). Documentar a regra "um CFP aberto por vez" ou suportar escolha.

### Institucional (ADR 0001 §2)
- [ ] **P1** Página "Sobre": a ADR lista quem somos, missão, organização e canais oficiais. Não existe rota nem view; o header padrão do design system até prevê o link "Sobre".
- [ ] **P2** Apoiadores sem descrição curta (ADR §2.4 pede nome, logo, descrição, site). (`app/Support/SiteContent.php`)
- [ ] **P2** Eventos anteriores: o botão "Ver programação" aparece mesmo sem nenhuma palestra aprovada; a página abre sem programação. (`components/event-card.blade.php:51`)

---

## 2. Textos sem informação confirmada

Conferir cada item com a organização. Se não houver confirmação, remover ou trocar por texto neutro.

### Home (`resources/views/home.blade.php`)
- [ ] "Comunidade PHP do Piauí · **desde 2016**"
- [ ] "**Meetups mensais** em Teresina e online"
- [ ] "A gente revisa sua proposta e **ajuda a ensaiar**"
- [ ] "Espaço, café, transmissão, divulgação. Empresas e pessoas apoiam…"

### Eventos
- [ ] "Meetups mensais e **um evento grande por ano**. Os anteriores ficam aqui como histórico, com programação e **gravações**": não há campo de gravação. (`events/index.blade.php:3`)
- [ ] "**Gratuito**" fixo em todo evento: virar campo do evento ou confirmar que todos são gratuitos. (`events/show.blade.php:57`)

### CFP (`resources/views/cfp/show.blade.php` e `app/Enums/ProposalFormat.php`)
- [ ] Durações: palestra "30 a 40 minutos", microtalk "5 a 10 minutos", workshop "2 horas".
- [ ] Workshop "Turma de **até 25 pessoas** com computador".
- [ ] "**Prioridade** para quem é do Piauí e para quem nunca palestrou."
- [ ] "Pode ser em dupla" (ver §1).
- [ ] "Nada de pitch de produto."
- [ ] "Um **comitê de voluntários** lê cada proposta **sem olhar nome ou empresa** na primeira rodada": contradiz a ADR (avaliação cega fora do escopo) e o painel, que mostra o nome. Reescrever.
- [ ] Regras fixas no código **e** campo "Regras e observações" do CFP: decidir qual é a fonte. Hoje uma regra fixa pode contradizer a regra do CFP.
- [ ] Modal pré-login: "Ajuste título e resumo **até o fim do prazo**" e "**Todo mundo recebe resposta**", que só vale se o admin decidir todas.
- [ ] Empty state de "Minhas propostas": "o comitê ajuda a lapidar". (`proposals/index.blade.php`)

### E-mails (`resources/views/emails/proposal-status.blade.php`)
- [ ] Aprovada: "Nos próximos dias a gente manda o horário exato e **combina um ensaio**".
- [ ] Recebida: "Você ainda pode editá-la até o fim do prazo" (ver §1).
- [ ] Rodapé: "Dúvidas? **Responda esta mensagem**": exige `MAIL_FROM_ADDRESS`/reply-to com caixa monitorada.

### Legais (`resources/views/legal/*.blade.php`)
- [ ] Data "Atualizado em 1º de setembro de 2026" nas duas páginas: data inventada, anterior ao próprio projeto.
- [ ] Código de conduta: "camiseta índigo", "Respondemos em **até 48 horas**", ausência de consequências/sanções e de quem compõe o grupo de resposta.
- [ ] Política de privacidade incompleta para LGPD: falta identificar o **controlador** (quem responde pelos dados), base legal, prazo de retenção, operadores (hospedagem, provedor S3, provedor de e-mail), cookie de sessão e o fato de o nome continuar em palestras decididas após a exclusão.
- [ ] Revisão jurídica ou de alguém da organização antes de publicar.

### Contatos e canais (confirmar que existem e são monitorados)
- [ ] `apoio@phppiaui.com.br` (`supporters.blade.php`)
- [ ] `conduta@phppiaui.com.br` (`legal/conduct.blade.php`)
- [ ] `privacidade@phppiaui.com.br` (`legal/privacy.blade.php`)
- [ ] Instagram `@php.piaui`, YouTube `@PHP-Piauí`, LinkedIn `company/phppiaui`, GitHub `php-piaui` (`components/site-footer.blade.php`, home, empty states)
- [ ] Apoiadores Cajutec e Geffin: autorização para exibir a marca; URL da Cajutec aponta para `app.cajutec.com.br` (app, não site institucional). (`app/Support/SiteContent.php`)

---

## 3. Inconsistências e bugs

- [ ] **P0** Layout do painel com atributo HTML quebrado: `class= flex …"` (falta a aspa de abertura), o link "Voltar ao site" fica sem estilo. (`resources/views/components/layouts/admin.blade.php:40`)
- [ ] **P1** Migration deixa `register_url` nullable, mas o formulário o exige; a view ainda testa `if ($event->register_url)`. Escolher um lado. (`create_events_table.php`, `Admin/EventRequest.php:30`)
- [ ] **P1** Exclusão de conta (LGPD) apaga só propostas em revisão. Propostas **recusadas** ficam com nome e conteúdo, sem finalidade pública. Avaliar apagar também.
- [ ] **P1** Pedido de remoção do nome em palestras já apresentadas: o perfil promete "a menos que você peça a remoção", mas não há processo nem ferramenta no painel.
- [ ] **P1** Nomes de atributos de validação em pt-BR: `opens_at`, `closes_at`, `register_url`, `formats`, `event_id`, `summary`, `headline`, `starts_at`, `ends_at`, `place`, `terms` etc. aparecem crus nas mensagens ("O campo opens at…"). (`lang/pt_BR/validation.php` → `attributes`)
- [ ] **P2** Prazo do CFP formatado de dois jeitos: `d/m` no banner da página do evento e "30 de outubro, 23h59" no resto. (`events/show.blade.php:30`)
- [ ] **P2** Logo do e-mail em SVG: Gmail e Outlook não renderizam. Trocar por PNG 2x. (`emails/proposal-status.blade.php:41`)
- [ ] **P2** Link de privacidade fixo `https://phppiaui.com.br/privacidade` no e-mail: usar `route('privacy')`.
- [ ] **P2** Indentação fora do padrão: `proposals/form.blade.php:9` e `:35`, `Admin/ProposalController.php:30`.
- [ ] **P2** Arquivos sem uso: `public/images/supporters/cajutec-color.png`, `public/images/brand/*`, pasta `Identidade Visual/` (sobe no FTP), `routes/console.php` com o `inspire` padrão.
- [ ] **P2** Testes boilerplate `tests/Feature/ExampleTest.php` e `tests/Unit/ExampleTest.php` (remover só com aprovação).
- [ ] **P2** `Admin\EventController` edit/update sem teste (cobertura 71%).

---

## 4. Robustez

- [ ] **P1** E-mail síncrono no envio da proposta: se o SMTP falhar, a proposta já foi salva e o palestrante vê erro 500 (e tende a reenviar). O mesmo vale para a decisão no painel. Tratar a falha (log + seguir) ou usar fila com `queue:work --stop-when-empty` via cron. (`ProposalController.php:49`, `ProposalDecisionController.php:31`)
- [ ] **P1** Páginas de erro próprias em pt-BR com o layout do site: 404, 403, 419 (sessão expirada no formulário), 429, 500, 503. Hoje não existe `resources/views/errors/`. Incluir o 409 "proposta já decidida".
- [ ] **P2** Corrida no limite de 5 propostas por CFP (já marcada com `ponytail:` em `Cfp::acceptsMoreProposalsFrom`).
- [ ] **P2** Falha de upload no S3 vira 500 genérico no perfil. Mostrar mensagem amigável. (`ProfileController.php:31`)

---

## 5. Infra, deploy e configuração

### `.env` de produção (criar no servidor; `.env.example` hoje é de desenvolvimento)
- [ ] `APP_NAME="PHP Piauí"` (hoje `Laravel`, vai no remetente dos e-mails)
- [ ] `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://phppiaui.com.br`, `APP_KEY` gerada
- [ ] `LOG_LEVEL=warning` (ou `error`) e `LOG_STACK=daily`
- [ ] `SESSION_SECURE_COOKIE=true`; avaliar `SESSION_ENCRYPT=true`
- [ ] `MAIL_MAILER=smtp` + credenciais; `MAIL_FROM_ADDRESS` em domínio próprio com SPF/DKIM/DMARC configurados (senão cai no spam)
- [ ] S3 de produção: escolher provedor, criar bucket, `AWS_*` e `AWS_URL` públicos; rodar `php artisan storage:bucket` uma vez
- [ ] `DB_*` do banco da hospedagem; confirmar versão do MySQL (Sail 8.4, CI 8.0)
- [ ] `FILESYSTEM_DISK`: o código usa `s3` explicitamente; manter `local` ou alinhar

### Pipeline (`.github/workflows/deploy.yml`)
- [ ] **P0** Deploy desligado: dispara só na branch `disabled` ou manual. Definir a branch de produção.
- [ ] Configurar `vars.FTP_HOST`, `vars.FTP_USER`, `secrets.FTP_PASSWORD` (e `SSH_HOST`/`SSH_PORT` se diferentes).
- [ ] Confirmar PHP 8.5 na hospedagem e `composer.phar` no diretório remoto (o post-deploy depende dele).
- [ ] `composer pint` no CI corrige em vez de checar: hoje há ~30 arquivos fora do padrão (configs, lang, migrations padrão) e o gate não falha. Rodar `pint` uma vez e trocar o step por `pint --test`.
- [ ] `queue:restart` no post-deploy é inútil sem worker: remover ou casar com a decisão da §4.
- [ ] Excluir `Identidade Visual/` e `docs/` do FTP sync.

### Segurança e operação
- [ ] Forçar HTTPS (redirect no `.htaccess` ou `URL::forceScheme('https')`) e HSTS.
- [ ] Cabeçalhos de segurança: `X-Frame-Options`/`frame-ancestors`, `X-Content-Type-Options`, `Referrer-Policy`.
- [ ] Nunca rodar `db:seed` em produção (seeder cria admin `admin@phppiaui.com.br` com senha `password` e dados fictícios). Considerar guard `app()->isProduction()` no seeder.
- [ ] Backup do banco (rotina do cPanel ou cron com `mysqldump`) e do bucket S3.
- [ ] Monitorar `/up` (UptimeRobot ou similar) e receber erros (e-mail de log, Sentry, Nightwatch…).
- [ ] Throttle no envio/edição de proposta e no upload de foto.

---

## 6. SEO, compartilhamento e acessibilidade

- [ ] **P1** `<meta name="description">` por página e Open Graph/Twitter Card (título, descrição, imagem). Links de evento e CFP são compartilhados no Instagram/WhatsApp. (`components/layouts/base.blade.php`)
- [ ] **P1** Imagem OG padrão (logo + fundo índigo) em PNG.
- [ ] **P2** `sitemap.xml` com home, eventos, CFP, apoiadores e páginas legais.
- [ ] **P2** `robots.txt`: bloquear `/admin`, `/perfil`, `/propostas`, `/entrar`, `/cadastro`; `noindex` nas telas de auth.
- [ ] **P2** `<link rel="canonical">`.
- [ ] **P2** Favicon PNG/ICO e `apple-touch-icon` (hoje só SVG; `public/favicon.ico` está vazio, 0 bytes).
- [ ] **P2** Rodar auditoria de acessibilidade (Lighthouse/axe) nas telas principais: modais sem trap de foco (CFP pré-login, confirmação), toast com `setTimeout` sem pausa no hover.

---

## 7. Antes de abrir o site

- [ ] Rodar a suíte completa: `php artisan test --compact`
- [ ] `composer quality` limpo
- [ ] Cadastrar o primeiro admin pelo comando da §1
- [ ] Cadastrar eventos reais (próximo e histórico) e, se for o caso, o primeiro CFP
- [ ] Teste ponta a ponta em produção: cadastro → proposta → e-mail recebido → aprovação no painel → e-mail de decisão → palestra na página do evento → exclusão de conta
- [ ] Testar recuperação de senha com e-mail real
- [ ] Conferir layout em celular (header, painel, modais)
