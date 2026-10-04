# ADR 0001 — Escopo e modelo da plataforma PHP Piauí

- **Status:** Aceito
- **Data:** 2026-10-04
- **Escopo:** o que a plataforma faz, para quem, e o que fica de fora por
  decisão no MVP. Base para as próximas ADRs técnicas.
- **Endereço:** https://phppiaui.com.br/

## 1. Contexto

A **PHP Piauí**, comunidade de desenvolvedores PHP do estado do Piauí,
organiza meetups e eventos, mas as informações estão espalhadas: redes
sociais, grupos de mensagem, formulários avulsos para chamada de palestrantes
e listas de apoiadores que só existem em artes de divulgação.

Isso gera três problemas:

1. **Sem endereço oficial.** Quem chega à comunidade não acha num lugar só o
   que ela é, quem organiza e como participar.
2. **Chamada de palestrantes manual.** Cada evento abre um formulário novo; as
   propostas ficam em planilhas, sem histórico de quem já palestrou e sem
   retorno padronizado para o palestrante.
3. **Apoiadores pouco visíveis.** A empresa que apoia não tem uma vitrine
   permanente, o que enfraquece o argumento na hora de buscar o próximo apoio.

O projeto é uma aplicação Laravel recém-criada (PHP 8.5, Pest, deploy em
hospedagem compartilhada via GitHub Actions). O Livewire ainda será adicionado.

## 2. Decisão

A plataforma é o **endereço oficial da PHP Piauí** e tem quatro áreas:

| Área | O que é | Onde vive o conteúdo |
| --- | --- | --- |
| **Site institucional** | Quem somos, missão, código de conduta, organização, como participar, canais oficiais | Estático, no código |
| **Eventos** | Listagem de meetups e eventos pré-cadastrados (próximos e anteriores), com página de detalhe | Banco, cadastrado no painel |
| **Call for papers (CFP)** | Registro de palestrantes e submissão de propostas para os meetups e eventos da comunidade | Banco; palestrante submete, organização aprova no painel |
| **Apoiadores** | Vitrine das empresas que apoiam a comunidade, com logo, descrição e link | Estático, no código |

### 2.1 Atores

| Ator | O que faz |
| --- | --- |
| **Visitante** | Navega no site, vê eventos e apoiadores. Não precisa de conta |
| **Palestrante** | Cria conta, mantém perfil (bio, foto, redes) e submete propostas aos CFPs abertos |
| **Organização** | Usuário do tipo **admin**. Cadastra eventos e CFPs e aprova propostas no painel; mantém conteúdo institucional e apoiadores no código |

### 2.1.1 Contas e acesso

- Login por **e-mail e senha**, para palestrantes e admins. Sem login social
  nem link mágico no MVP.
- Uma única tabela de usuários com **tipo**: palestrante (padrão no cadastro
  público) ou admin.
- **Ninguém vira admin pelo cadastro público.** O tipo admin é atribuído pela
  própria organização fora do fluxo de cadastro.
- O painel (§2.5) é acessível **somente a admins**. Todo admin pode cadastrar
  eventos, abrir CFPs e aprovar ou recusar propostas.

### 2.2 Eventos

- Eventos são **cadastrados pela organização** no painel. Não há cadastro
  público de eventos nem eventos de terceiros.
- Cada evento tem: título, tipo (meetup ou evento), data e horário, local
  (presencial, online ou híbrido), descrição, imagem e **link externo de
  inscrição**. A inscrição sempre acontece fora da plataforma.
- A listagem separa **próximos** e **anteriores**. Eventos anteriores
  continuam no ar como histórico da comunidade.
- Quando o evento tem propostas aprovadas, a página do evento mostra a
  programação com os palestrantes.

### 2.3 Call for papers

- A organização abre um CFP **vinculado a um evento**, com prazo de submissão
  e formatos aceitos (ex.: palestra, lightning talk, workshop).
- A página pública do CFP mostra regras, prazo e formatos **sem exigir
  login**. Qualquer visitante pode ler antes de decidir submeter.
- **Submeter exige estar logado, e o palestrante precisa entender por quê.**
  Não basta um middleware que redireciona para a tela de login:
  - O botão "Submeter proposta" fica visível para todos. Para quem não está
    logado, a página explica, antes de qualquer redirecionamento, que a conta
    serve para **acompanhar o status da proposta, editá-la enquanto estiver
    em revisão, receber a resposta por e-mail e reaproveitar o perfil nos
    próximos CFPs**.
  - Dali o palestrante escolhe entre entrar ou criar conta, e as telas de
    login e cadastro repetem o contexto ("Entre para submeter sua proposta
    ao CFP do <evento>").
  - Depois de entrar ou criar a conta, ele **volta direto ao formulário de
    submissão** daquele CFP, sem precisar procurá-lo de novo.
- Status da proposta: **em revisão → aprovada** ou **recusada**.
- O palestrante pode **editar a proposta enquanto ela estiver em revisão**.
  Aprovada ou recusada, a proposta fica somente leitura.
- **Aprovação manual** pela organização no painel. A mudança de status gera
  **e-mail automático** ao palestrante.
- Proposta aprovada passa a constar na programação do evento.
- O perfil do palestrante é reutilizado entre CFPs: a comunidade ganha
  histórico de quem já palestrou.

### 2.4 Apoiadores

- Nível único: **apoiador**. Sem cotas nem destaque diferenciado.
- Apoiador é **da comunidade**, não de um evento específico.
- Conteúdo estático no código: nome, logo, descrição curta, site.
- Seção pública com todos os apoiadores e chamada "Quero apoiar" (contato com
  a organização). A negociação do apoio acontece **fora da plataforma**.

### 2.5 Painel da organização (MVP)

Painel básico, só com o que o MVP precisa guardar no banco:

- Cadastro e edição de eventos.
- Abertura de CFP por evento.
- Lista de propostas por CFP, com aprovação ou recusa.

Conteúdo institucional e apoiadores ficam fora do painel (seção 2).

## 3. Fora do escopo por decisão

| Item | Por quê |
| --- | --- |
| Inscrição em eventos, ingressos e pagamentos | Inscrição por link externo. Sem gateway, sem dinheiro passando pela plataforma |
| Níveis de apoio e apoiador por evento | Nível único, da comunidade, por agora |
| Painel do patrocinador e métricas de exposição | Apoio é vitrine, não produto. Volume não justifica |
| Edição de conteúdo institucional e apoiadores pelo painel | Muda pouco; versionar no código basta |
| Avaliadores convidados, nota por critério, avaliação cega | Aprovação manual pela organização basta no MVP |
| Login social, link mágico, papéis além de palestrante/admin | E-mail e senha e dois tipos de usuário bastam no MVP |
| Eventos de outras comunidades / marketplace | A plataforma é da PHP Piauí |
| Check-in, certificados, CRM de participantes | Ficam nas ferramentas de inscrição usadas em cada evento |
| Loja | Fora do propósito da plataforma |
| App mobile | Web responsivo resolve |
| API pública e integrações | Sem consumidor conhecido |

Cada item pode ser reaberto por uma nova ADR.

## 4. Alternativas consideradas

1. **Site estático + Google Forms para o CFP.** Mais barato para começar, mas
   repete o problema atual: propostas em planilha, sem histórico de
   palestrante, sem e-mail de status.
2. **Usar uma plataforma de eventos de terceiros (Sympla, Even3, Sessionize).**
   Resolve partes isoladas, mas deixa a comunidade sem endereço próprio e
   espalha dados entre ferramentas.
3. **Plataforma própria enxuta (escolhida).** Site da comunidade com CFP
   integrado aos eventos e vitrine de apoiadores, sem entrar em inscrições ou
   pagamentos. Só eventos e CFP vão para o banco; o resto é estático.

## 5. Consequências

- **Positivas:** um endereço oficial; CFP padronizado com histórico de
  palestrantes; apoiadores com visibilidade permanente; escopo pequeno o
  bastante para ser mantido por voluntários.
- **Negativas:** inscrição em eventos continua fora da plataforma (o
  participante sai do site para se inscrever); mudar texto institucional ou
  apoiadores exige alteração no código e deploy.
- **Dados pessoais (LGPD):** a plataforma passa a guardar dados de
  palestrantes (nome, e-mail, bio, foto). Exige política de privacidade e
  forma de o palestrante excluir a própria conta.

## 6. Pontos em aberto

Nenhum no momento.
