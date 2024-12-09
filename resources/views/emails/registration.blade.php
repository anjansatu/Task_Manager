@extends('emails.master')
@section('content')
   
    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 15px 25px 15px 25px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align:justify;">
            <p style="margin: 0;">Please click the link below to confirm your email and activate your account:</p>
        </td>
    </tr>

    <tr>
        <td bgcolor="#ffffff" align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#ffffff" align="center" style="padding: 15px 25px 25px 25px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td align="center" style="border-radius: 3px;"><a
                                        href="{{ route('userVerifyEmail', $vf_code) }}" target="_blank"
                                        style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-decoration: none;  text-decoration: none;  display: inline-block; background-color: #48FF91;
                                                border-radius: 6px;
                                                padding: 11px 19px;
                                                            color: #000;">Click
                                        To Confirm Account</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

@endsection


@section('footer')
    <span style="font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">Best regards,</span>
@endsection
