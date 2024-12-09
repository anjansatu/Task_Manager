@extends('emails.master')
@section('content')
    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 40px 30px 0px 30px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
            <p style="margin: 0;"><b>Dear {{ $name }},</b></p>
        </td>
    </tr>




    <tr>
        <td bgcolor="#ffffff" align="left">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 30px 30px;">
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                {{--                                            <td align="center" style="border-radius: 3px;" bgcolor="#17b3a3"><a href="{{route("userVerifyEmail",[$user_id,encrypt($vf_code)])}}" target="_blank" style="font-size: 18px; font-family: Helvetica, Arial, sans-serif; text-decoration: none;  text-decoration: none;  display: inline-block;">Confirm Account</a></td> --}}
                                <td align="center" style="border-radius: 3px;"><a
                                        href="{{ route('resetPassword', $remember_token) }}" target="_blank"
                                        style="font-size: 14px; font-family: Helvetica, Arial, sans-serif; text-decoration: none;  text-decoration: none;  display: inline-block; background-color: #48FF91;
                                                border-radius: 6px;
                                                padding: 11px 19px;
                                                            color: #000;">Reset
                                        Password Link</a></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 0px 25px 15px 25px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align:justify;">
            <p style="margin: 0;">Your security is our top priority. If you have any concerns or need help, our support team
                is here to assist you.</p>
        </td>
    </tr>
   
@endsection


@section('footer')
    <span style="font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">Warm regards,</span>
@endsection
