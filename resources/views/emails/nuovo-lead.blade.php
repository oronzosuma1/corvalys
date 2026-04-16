<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo Lead</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #0F7B6C; padding: 20px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 22px; font-weight: 600;">Corvalys</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 30px;">
                            <h2 style="margin: 0 0 24px 0; color: #1a1a2e; font-size: 20px;">Nuovo lead ricevuto</h2>

                            {{-- Details Table --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 24px;">
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; width: 140px;"><strong style="color: #333;">Nome</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->name }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Email</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->email }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Azienda</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->company ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Tipo servizio</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->service_type }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Budget</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->budget_range }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Urgenza</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->urgency ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee;"><strong style="color: #333;">Fonte</strong></td>
                                    <td style="padding: 10px 12px; border-bottom: 1px solid #eee; color: #555;">{{ $lead->source ?? '—' }}</td>
                                </tr>
                            </table>

                            {{-- Project Description --}}
                            <div style="background-color: #f0f0f3; border-radius: 6px; padding: 16px 20px; margin-bottom: 28px;">
                                <strong style="color: #333; display: block; margin-bottom: 8px;">Descrizione progetto</strong>
                                <p style="margin: 0; color: #555; line-height: 1.6;">{{ $lead->project_description }}</p>
                            </div>

                            {{-- CTA Button --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/admin/leads/' . $lead->id) }}" style="display: inline-block; background-color: #1a1a2e; color: #ffffff; text-decoration: none; padding: 12px 28px; border-radius: 6px; font-size: 14px; font-weight: 600;">Vedi nel pannello admin</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding: 20px 30px; text-align: center; border-top: 1px solid #eee;">
                            <p style="margin: 0; color: #999; font-size: 12px;">Corvalys &mdash; Sistema automatico</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
