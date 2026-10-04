@php
    $status ??= 'recebida';
    $mensagem ??= null;
    $variant = [
        'aprovada' => [
            'badgeBg' => '#EAF6EF', 'badgeBorder' => '#A9DDBE', 'badgeColor' => '#17643D', 'badge' => '✓&nbsp; Aprovada',
            'heading' => "Sua proposta foi aprovada, {$nome}!",
            'preheader' => "Boa notícia: “{$titulo}” está na programação do {$evento}.",
            'cta' => 'Ver minha proposta', 'ctaBg' => '#D0440F',
        ],
        'recusada' => [
            'badgeBg' => '#FDEDEB', 'badgeBorder' => '#F4B4AC', 'badgeColor' => '#A12719', 'badge' => '✕&nbsp; Recusada',
            'heading' => "Desta vez sua proposta não entrou, {$nome}",
            'preheader' => "Obrigado por enviar “{$titulo}” ao {$evento}.",
            'cta' => 'Ver próximos eventos', 'ctaBg' => '#40419A',
        ],
        'recebida' => [
            'badgeBg' => '#FFF6DC', 'badgeBorder' => '#F5D27A', 'badgeColor' => '#7A5100', 'badge' => '⏳&nbsp; Em revisão',
            'heading' => 'Recebemos sua proposta',
            'preheader' => "“{$titulo}” chegou ao CFP do {$evento}.",
            'cta' => 'Ver minha proposta', 'ctaBg' => '#D0440F',
        ],
    ][$status];
@endphp
<!doctype html>
<html lang="pt-BR">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="color-scheme" content="light only">
<title>{{ $variant['heading'] }} — PHP Piauí</title>
</head>
<body style="margin:0;padding:0;background:#F3F1EC;">
<div style="display:none;max-height:0;overflow:hidden;">{{ $variant['preheader'] }}</div>
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background:#F3F1EC;">
<tr><td align="center" style="padding:32px 16px;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px;background:#FFFFFF;border-radius:16px;border:1px solid #E6E3DB;">
<tr><td style="background:#40419A;border-radius:16px 16px 0 0;padding:20px 28px;">
<table role="presentation" cellpadding="0" cellspacing="0"><tr>
{{-- ponytail: SVG logo; swap for a 2x PNG if Outlook/Gmail rendering matters --}}
<td style="vertical-align:middle;"><img src="{{ asset('images/logo/symbol-white.svg') }}" width="40" height="32" alt="" style="display:block;border:0;"></td>
<td style="vertical-align:middle;padding-left:12px;font-family:'Bricolage Grotesque',Arial,sans-serif;font-weight:800;font-size:20px;letter-spacing:-0.4px;color:#FFFFFF;">PHP Piauí</td>
</tr></table>
</td></tr>
<tr><td style="padding:32px 28px 8px;font-family:'Instrument Sans',Arial,sans-serif;">
<table role="presentation" cellpadding="0" cellspacing="0"><tr><td style="background:{{ $variant['badgeBg'] }};border:1px solid {{ $variant['badgeBorder'] }};border-radius:999px;padding:5px 12px;font-size:13px;font-weight:700;color:{{ $variant['badgeColor'] }};font-family:'Instrument Sans',Arial,sans-serif;">{!! $variant['badge'] !!}</td></tr></table>
<h1 style="margin:18px 0 12px;font-family:'Bricolage Grotesque',Arial,sans-serif;font-weight:800;font-size:28px;line-height:34px;letter-spacing:-0.5px;color:#1E1D1A;">{{ $variant['heading'] }}</h1>
@switch($status)
    @case('aprovada')
<p style="margin:0 0 16px;font-size:16px;line-height:25px;color:#1E1D1A;">Sua proposta <b>“{{ $titulo }}”</b> está na programação do <b>{{ $evento }}</b>.</p>
<p style="margin:0 0 24px;font-size:16px;line-height:25px;color:#1E1D1A;">Nos próximos dias a gente manda o horário exato e combina um ensaio, se você quiser. A proposta agora fica somente leitura.</p>
        @break
    @case('recusada')
<p style="margin:0 0 16px;font-size:16px;line-height:25px;color:#1E1D1A;">Obrigado por enviar <b>“{{ $titulo }}”</b> ao <b>{{ $evento }}</b>. Recebemos muitas propostas boas e o espaço na grade é curto.</p>
<p style="margin:0 0 24px;font-size:16px;line-height:25px;color:#1E1D1A;">Esperamos ver você no próximo CFP — fica o convite.</p>
        @break
    @default
<p style="margin:0 0 16px;font-size:16px;line-height:25px;color:#1E1D1A;">Sua proposta <b>“{{ $titulo }}”</b> para o <b>{{ $evento }}</b> chegou e está em revisão pelo comitê.</p>
<p style="margin:0 0 24px;font-size:16px;line-height:25px;color:#1E1D1A;">Você ainda pode editá-la até o fim do prazo do CFP.</p>
@endswitch
@if ($mensagem)
<table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#F1F1FD;border-radius:12px;"><tr><td style="padding:16px 18px;font-size:14px;line-height:21px;color:#2D2E66;font-family:'Instrument Sans',Arial,sans-serif;">
<b>Mensagem do comitê</b><br>{{ $mensagem }}</td></tr></table>
@endif
<table role="presentation" cellpadding="0" cellspacing="0" style="margin:28px 0 8px;"><tr><td style="background:{{ $variant['ctaBg'] }};border-radius:10px;">
<a href="{{ $url }}" style="display:inline-block;padding:14px 22px;font-family:'Instrument Sans',Arial,sans-serif;font-weight:600;font-size:16px;color:#FFFFFF;text-decoration:none;">{{ $variant['cta'] }}</a></td></tr></table>
</td></tr>
<tr><td style="padding:24px 28px 28px;font-family:'Instrument Sans',Arial,sans-serif;font-size:13px;line-height:20px;color:#5E5A51;border-top:1px solid #E6E3DB;">
Você recebeu este e-mail porque enviou uma proposta ao CFP em phppiaui.com.br. Dúvidas? Responda esta mensagem.<br>
PHP Piauí · <a href="https://phppiaui.com.br/privacidade" style="color:#40419A;">Privacidade</a>
</td></tr>
</table>
</td></tr></table>
</body>
</html>
