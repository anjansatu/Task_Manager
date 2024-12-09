@extends('emails.master')
@section('content')
    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 40px 30px 0px 30px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">
            <p style="margin: 0;"><b>Dear {{ $name }},</b></p>
        </td>
    </tr>


    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 15px 25px 15px 25px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align:justify;">
            <p style="margin: 0;">For your security, please ensure that your new password is kept confidential and consider
                updating it regularly to maintain account security.</p>
        </td>
    </tr>

   
    <tr>
        <td bgcolor="#ffffff" align="left"
            style="padding: 0px 25px 15px 25px; color: #666666; font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px; text-align:justify;">
            <p style="margin: 0;">Thank you for taking steps to secure your account. We're here to assist you whenever you
                need.</p>
        </td>
    </tr>
@endsection


@section('footer')
    <span style="font-family: &apos;Lato&apos;, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 25px;">Best regards,</span>
@endsection
