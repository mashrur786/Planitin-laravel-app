<div style="width: 600px; margin: 20px auto; text-align: center">
    <div style="padding: 20px; text-align: left">
        <br>
        <p><strong>Dear Admin,</strong></p>
        <p>A user has sent you a message/inquiry.</p>
        <hr>
        <p><strong>Name: </strong>{{ $contact['name'] }}</p>
        <p><strong>E-mail: </strong>{{ $contact['email'] }}</p>
        <p><strong>Telephone: </strong>{{  $contact['telephone']  }}  </p>
        <p><strong>Message:</strong> {{ $contact['message']  }}</p>
        <hr>
    </div>
    This email has been sent from planitin.com

</div>