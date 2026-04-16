<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body style="margin: 0; padding: 0; background-color: #f4f7fa; font-family: Arial, Helvetica, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f7fa; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                    {{-- Header --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #0F7B6C 0%, #1B3A5C 100%); padding: 30px 40px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 24px; font-weight: bold; letter-spacing: 1px;">CORVALYS</h1>
                            <p style="color: rgba(255,255,255,0.8); margin: 5px 0 0; font-size: 13px;">AI & Technology Solutions</p>
                        </td>
                    </tr>

                    {{-- Body --}}
                    <tr>
                        <td style="padding: 40px;">
                            <h2 style="color: #1B3A5C; margin: 0 0 20px; font-size: 20px;">Proposal Approved</h2>

                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 15px;">
                                Dear {{ $lead->name }},
                            </p>

                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 15px;">
                                We are pleased to inform you that your proposal has been approved. Please find the detailed proposal document attached to this email.
                            </p>

                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 15px;">
                                Our team is ready to begin working with you. We will be in touch shortly to discuss the next steps and project timeline.
                            </p>

                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0 0 25px;">
                                If you have any questions, please do not hesitate to reach out to us.
                            </p>

                            <p style="color: #374151; font-size: 15px; line-height: 1.6; margin: 0;">
                                Best regards,<br>
                                <strong style="color: #0F7B6C;">The Corvalys Team</strong>
                            </p>
                        </td>
                    </tr>

                    {{-- Footer --}}
                    <tr>
                        <td style="background-color: #f9fafb; padding: 20px 40px; border-top: 1px solid #e5e7eb;">
                            <p style="color: #9ca3af; font-size: 12px; margin: 0; text-align: center;">
                                Corvalys LTD &middot; AI & Technology Solutions<br>
                                This email was sent to {{ $lead->email }}
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
