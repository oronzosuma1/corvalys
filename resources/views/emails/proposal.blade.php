<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposta Corvalys</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #0F7B6C; padding: 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 600;">Proposta Corvalys</h1>
                            <p style="margin: 8px 0 0 0; color: rgba(255,255,255,0.8); font-size: 14px;">AI Engineering & Consulting</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 30px;">
                            <div style="color: #333; font-size: 15px; line-height: 1.7; white-space: pre-line;">{{ $bodyText }}</div>
                        </td>
                    </tr>

                    {{-- Assessment Details (optional) --}}
                    @if($includeAssessment && $assessment)
                        <tr>
                            <td style="padding: 0 30px 30px 30px;">
                                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f0fdf4; border-radius: 8px; border: 1px solid #dcfce7;">
                                    <tr>
                                        <td style="padding: 20px;">
                                            <h3 style="margin: 0 0 15px 0; color: #166534; font-size: 14px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">Riepilogo analisi</h3>

                                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td style="padding: 8px 0; border-bottom: 1px solid #dcfce7;">
                                                        <span style="color: #555; font-size: 13px;">Ore stimate:</span>
                                                        <span style="color: #166534; font-size: 13px; font-weight: 600; float: right;">{{ $assessment['estimated_hours_min'] ?? '-' }} - {{ $assessment['estimated_hours_max'] ?? '-' }} ore</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px 0; border-bottom: 1px solid #dcfce7;">
                                                        <span style="color: #555; font-size: 13px;">Investimento:</span>
                                                        <span style="color: #166534; font-size: 13px; font-weight: 600; float: right;">EUR {{ number_format($assessment['estimated_cost_min'] ?? 0, 0, ',', '.') }} - {{ number_format($assessment['estimated_cost_max'] ?? 0, 0, ',', '.') }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding: 8px 0;">
                                                        <span style="color: #555; font-size: 13px;">Fattibilita:</span>
                                                        <span style="color: #166534; font-size: 13px; font-weight: 600; float: right;">{{ ucfirst($assessment['feasibility'] ?? '-') }}</span>
                                                    </td>
                                                </tr>
                                            </table>

                                            @if(isset($assessment['next_steps']) && count($assessment['next_steps']))
                                                <h4 style="margin: 15px 0 8px 0; color: #166534; font-size: 13px; font-weight: 600;">Prossimi passi:</h4>
                                                @foreach($assessment['next_steps'] as $step)
                                                    <p style="margin: 4px 0; color: #333; font-size: 13px; padding-left: 15px;">&#8226; {{ $step }}</p>
                                                @endforeach
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endif

                    {{-- CTA --}}
                    <tr>
                        <td style="padding: 0 30px 30px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        @if(config('corvalys.calendly_url'))
                                            <a href="{{ config('corvalys.calendly_url') }}" style="display: inline-block; background-color: #0F7B6C; color: #ffffff; text-decoration: none; padding: 14px 32px; border-radius: 6px; font-size: 14px; font-weight: 600;">Prenota una call</a>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding: 20px 30px; text-align: center; border-top: 1px solid #eee; background-color: #fafafa;">
                            <p style="margin: 0 0 4px 0; color: #555; font-size: 13px; font-weight: 600;">Corvalys</p>
                            <p style="margin: 0 0 4px 0; color: #888; font-size: 12px;">AI Engineering & Consulting</p>
                            <p style="margin: 0; color: #888; font-size: 12px;">
                                <a href="mailto:{{ config('corvalys.enzo_email') }}" style="color: #0F7B6C; text-decoration: none;">{{ config('corvalys.enzo_email') }}</a>
                                &middot;
                                <a href="{{ url('/') }}" style="color: #0F7B6C; text-decoration: none;">corvalys.eu</a>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
