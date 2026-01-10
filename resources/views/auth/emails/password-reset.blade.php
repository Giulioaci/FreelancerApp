<!DOCTYPE html>
<html>
<head>
    <title>Reset Your Password</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table align="center" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        <!-- Header -->
        <tr>
            <td style="padding: 20px; text-align: center; color: #000000;">
                <!-- Scritta più doppia -->
                <h2 style="margin: 0; font-size: 18px; font-weight: 800;">FreelancerApp</h2>
            </td>
        </tr>
        <!-- Body -->
        <tr>
            <td style="padding: 30px; color: #333333; line-height: 1.6;">
                <p>Hello,</p>
                <p>We received a request to reset your password for your FreelancerApp account. Click the button below to set a new password:</p>
                <p style="text-align: center; margin: 30px 0;">
                    <a href="{{ url('reset-password/'.$token.'?email='.urlencode($email)) }}" 
                       style="background-color: #000000; color: #ffffff; text-decoration: none; padding: 14px 28px; border-radius: 6px; display: inline-block; font-weight: bold; font-size: 16px;">
                        Reset Password
                    </a>
                </p>
                <p>If you did not request a password reset, you can safely ignore this email and your password will remain unchanged.</p>
                <p>Thank you,<br>The <strong>FreelancerApp</strong> Team</p>
            </td>
        </tr>
        <!-- Footer -->
        <tr>
            <td style="background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 10px; color: #888888;">
                © {{ date('Y') }} FreelancerApp. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>



