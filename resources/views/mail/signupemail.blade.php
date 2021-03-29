Hello {{$email_data['first_name']}}
<br><br>
Welcome to Imagine!
<br>
Please click the below link to verify your email and activate your account!
<br><br>
<a href="http://localhost:8000/verify?code={{$email_data['verification_code']}}">Click Here!</a>

<br><br>
Thank you!
<br>
The Imagine Team
