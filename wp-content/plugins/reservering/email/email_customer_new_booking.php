<?php

function email_customer_new_booking($email) {
  $message = "
    <!doctype html>
    <html lang='en'>
      <head>
        <meta charset='utf-8'>
        <meta content='width=device-width, initial-scale=1' name='viewport'>
        <link crossorigin='anonymous' href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css'
              integrity='sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65' rel='stylesheet'>
      </head>

      <body>
      <h1>Hello, world!</h1>

      <script crossorigin='anonymous' integrity='sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4' src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
      </body>
    </html>
  ";

	$headers = array('Content-Type: text/html; charset=UTF-8');

  $sent = wp_mail(
          sanitize_email($email),
          'Reservering',
          $message,
	        array('Content-Type: text/html; charset=UTF-8'),
  );
  if (!$sent) {
    echo 'Er ging iets mis!';
    return;
  }
  echo 'Er is een reservering gemaakt!';
  return;
}
