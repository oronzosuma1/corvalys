<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferma contatto</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7;">
        <tr>
            <td align="center" style="padding: 40px 0;">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background-color: #0F7B6C; padding: 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 600;">Grazie {{ $name }}!</h1>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 20px 0; color: #333; font-size: 16px; line-height: 1.7;">
                                Ho ricevuto la tua richiesta. Ti rispondo entro 24 ore con una proposta personalizzata.
                            </p>

                            <p style="margin: 0 0 28px 0; color: #555; font-size: 15px; line-height: 1.6;">
                                Nel frattempo puoi scoprire di pi&ugrave; su di me e su come lavoro:
                            </p>

                            {{-- CTA Button --}}
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('/chi-siamo') }}" style="display: inline-block; color: #0F7B6C; text-decoration: none; padding: 12px 28px; border: 2px solid #0F7B6C; border-radius: 6px; font-size: 14px; font-weight: 600;">Scopri chi siamo</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="padding: 20px 30px; text-align: center; border-top: 1px solid #eee;">
                            <p style="margin: 0 0 6px 0; color: #555; font-size: 13px;">Enzo &mdash; Corvalys</p>
                            <a href="https://www.linkedin.com/company/corvalysholding" style="color: #0F7B6C; text-decoration: none; font-size: 12px;">LinkedIn</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
