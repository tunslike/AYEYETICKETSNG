<?php


 //function to send out forgotten password
 function sendRegistrationNotification($fullname, $newpass, $email, $username){
  
  //Email Subject 
  $subject = 'Vevolt.ng, thank you for your Registration';

  //email body
  $htmlBody = '<!DOCTYPE html>
  <html lang="en" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
  <head>
  <title></title>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <!--[if mso]><xml><o:OfficeDocumentSettings><o:PixelsPerInch>96</o:PixelsPerInch><o:AllowPNG/></o:OfficeDocumentSettings></xml><![endif]-->
  <style>
      * {
        box-sizing: border-box;
      }
  
      body {
        margin: 0;
        padding: 0;
      }
  
      th.column {
        padding: 0
      }
  
      a[x-apple-data-detectors] {
        color: inherit !important;
        text-decoration: inherit !important;
      }
  
      #MessageViewBody a {
        color: inherit;
        text-decoration: none;
      }
  
      p {
        line-height: inherit
      }
  
      @media (max-width:520px) {
        .icons-inner {
          text-align: center;
        }
  
        .icons-inner td {
          margin: 0 auto;
        }
  
        .row-content {
          width: 100% !important;
        }
  
        .stack .column {
          width: 100%;
          display: block;
        }
      }
    </style>
  </head>
  <body style="background-color: #f7f7f7; margin: 0; padding: 0; -webkit-text-size-adjust: none; text-size-adjust: none;">
  <table border="0" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f7f7f7;" width="100%">
  <tbody>
  <tr>
  <td>
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-1" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
  <tbody>
  <tr>
  <td>
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000;" width="500">
  <tbody>
  <tr>
  <th class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
  <table border="0" cellpadding="0" cellspacing="0" class="html_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
  <tr>
  <td>
  <div align="center" style="font-family:Arial, Helvetica Neue, Helvetica, sans-serif;"><div style="background-color:#404257; color:#ffe400; padding:25px; text-align:left;font-weight:bold;"> Vevolt.ng Registration Notification </div></div>
  </td>
  </tr>
  </table>
  <table border="0" cellpadding="10" cellspacing="0" class="text_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; word-break: break-word;" width="100%">
  <tr>
  <td>
  <div style="font-family: sans-serif">
  <div style="font-size: 14px; mso-line-height-alt: 16.8px; color: #555555; line-height: 1.2; font-family: Arial, Helvetica Neue, Helvetica, sans-serif;">
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left;">Hello '.$fullname.'</p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left;">Thank you for your registration with us. Please find below are your registration details, you may either login using your customer number or email address.</p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left;"><u><strong>Login Details</strong></u></p>
  <p style="margin: 0; font-size: 14px; text-align: left;"><br/>Customer Number: <strong>'.$username.'</strong></p>
  <p style="margin: 0; font-size: 14px; text-align: left;">Registered Email Address: <strong>'.$email.'</strong></p>
  <p style="margin: 0; font-size: 14px; text-align: left;">Password: <strong>'.$newpass.'</strong></p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0;">The full scope of our service offering is available to you if you have made more detailed information about your CHP plants and modules in the members area.  A comprehensive specification will help you in finding matching spare parts and also provides you with a good overview of your system. In addition, you will receive individual conditions, offers and information to your cogeneration plants.</p>
  <p style="margin: 0; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0;">Our team will help you if you have any questions. Please contact us.</p>
  <p style="margin: 0; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0; mso-line-height-alt: 16.8px;"> </p>
  <p style="margin: 0;">Thank you</p>
  <p style="margin: 0;"><strong>Vevolt.ng</strong></p>
  <p style="margin: 0; font-size: 14px; text-align: left; mso-line-height-alt: 16.8px;"> </p>
  </div>
  </div>
  </td>
  </tr>
  </table>
  </th>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row row-2" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
  <tbody>
  <tr>
  <td>
  <table align="center" border="0" cellpadding="0" cellspacing="0" class="row-content stack" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; color: #000000;" width="500">
  <tbody>
  <tr>
  <th class="column" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt; font-weight: 400; text-align: left; vertical-align: top; padding-top: 5px; padding-bottom: 5px; border-top: 0px; border-right: 0px; border-bottom: 0px; border-left: 0px;" width="100%">
  <table border="0" cellpadding="0" cellspacing="0" class="icons_block" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
  <tr>
  <td style="color:#9d9d9d;font-family:inherit;font-size:15px;padding-bottom:5px;padding-top:5px;text-align:center;">
  <table cellpadding="0" cellspacing="0" role="presentation" style="mso-table-lspace: 0pt; mso-table-rspace: 0pt;" width="100%">
  <tr>
  <td style="text-align:center;">
  <!--[if vml]><table align="left" cellpadding="0" cellspacing="0" role="presentation" style="display:inline-block;padding-left:0px;padding-right:0px;mso-table-lspace: 0pt;mso-table-rspace: 0pt;"><![endif]-->
  <!--[if !vml]><!-->
  </td>
  </tr>
  </table>
  </td>
  </tr>
  </table>
  </th>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table>
  </td>
  </tr>
  </tbody>
  </table><!-- End -->
  </body>
  </html>';

  //Send Email
  $emailStatus = sendElasticEmail($email, $subject, $htmlBody,"customer@vevolt.com.ng", "Vevolt.NG");

}
  //end of functionn

//send Email API
function sendElasticEmail($to, $subject, $body_html, $from, $fromName)
{

    $res = "";

    $data = "username=".urlencode(EMAIL_USERNAME);
    $data .= "&api_key=".urlencode(EMAIL_API_KEY);
    $data .= "&from=".urlencode($from);
    $data .= "&from_name=".urlencode($fromName);
    $data .= "&to=".urlencode($to);
    $data .= "&subject=".urlencode($subject);
    if($body_html)
      $data .= "&body_html=".urlencode($body_html);
    if($body_text)
      $data .= "&body_text=".urlencode($body_text);

    $header = "POST /mailer/send HTTP/1.0\r\n";
    $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
    $header .= "Content-Length: " . strlen($data) . "\r\n\r\n";
    $fp = fsockopen('ssl://api.elasticemail.com', 443, $errno, $errstr, 30);

    if(!$fp)
      return "ERROR. Could not open connection";
    else {
      fputs ($fp, $header.$data);
      while (!feof($fp)) {
        $res .= fread ($fp, 1024);
      }
      fclose($fp);
    }
    return $res;                  
}
