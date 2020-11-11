<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../config.php';
require_once ROOT_DIR.'/includes/autoloader.php';
require_once ROOT_DIR.'/includes/dbh.php';

use Mailgun\Mailgun;

class Email{

  private static $baseURL;

  static function setBaseURL(){
    if($_SERVER['HTTP_HOST']=="localhost"){
      self::$baseURL='localhost/';
    } else {
      self::$baseURL='https://FuNinja.in/';
    }
  }

  // standard e-mail header containing in-line css
  private static $header = '
  <!doctype html>
  <html>
    <head>
      <meta name="viewport" content="width=device-width">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Verify your email with FuNinja</title>
      <style>
      /* -------------------------------------
          INLINED WITH htmlemail.io/inline
      ------------------------------------- */
      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important;
        }
        table[class=body] p,
              table[class=body] ul,
              table[class=body] ol,
              table[class=body] td,
              table[class=body] span,
              table[class=body] a {
          font-size: 16px !important;
        }
        table[class=body] .wrapper,
              table[class=body] .article {
          padding: 10px !important;
        }
        table[class=body] .content {
          padding: 0 !important;
        }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important;
        }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important;
        }
        table[class=body] .btn table {
          width: 100% !important;
        }
        table[class=body] .btn a {
          width: 100% !important;
        }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important;
        }
      }

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%;
        }
        .ExternalClass,
              .ExternalClass p,
              .ExternalClass span,
              .ExternalClass font,
              .ExternalClass td,
              .ExternalClass div {
          line-height: 100%;
        }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important;
        }
        #MessageViewBody a {
          color: inherit;
          text-decoration: none;
          font-size: inherit;
          font-family: inherit;
          font-weight: inherit;
          line-height: inherit;
        }
        .btn-primary table td:hover {
          background-color: #34495e !important;
        }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important;
        }
      }
      </style>
    </head>
    <body class="" style="background-color: #f6f6f6; font-family: sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">

      <table border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background-color: #f6f6f6;">
        <tr>
          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
          <td class="container" style="font-family: sans-serif; font-size: 14px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;">
            <div class="content" style="box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;">

              <!-- START CENTERED WHITE CONTAINER -->
              <table class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;">
  ';

  // standard footer
  private static $footer ='

                  <!-- START FOOTER -->
                  <div class="footer" style="clear: both; Margin-top: 10px; text-align: center; width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                      <tr>
                        <td class="content-block" style="font-family: sans-serif; vertical-align: top; padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999; text-align: center;">
                          <span class="apple-link" style="color: #999999; font-size: 12px; text-align: center;">www.FuNinja.in</span>

                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- END FOOTER -->

                <!-- END CENTERED WHITE CONTAINER -->
                </div>
              </td>
              <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">&nbsp;</td>
            </tr>
          </table>
        </body>
      </html>
  ';


  static function sendEmail($to, $subject, $text, $html){

    $mailgun_API_key='9dbf4c59884d274f6b2de94cb5c38b93-2fbe671d-a5d69610';
    $mailgun_domain='mail.FuNinja.in';
    $mg = Mailgun::create($mailgun_API_key);
    $from = 'FuNinja <no-reply@FuNinja.in>';

    $mg->messages()->send($mailgun_domain, [
      'from'    => $from,
      'to'      => $to,
      'subject' => $subject,
      'text'    => $text,
      'html' => $html
    ]);

  }

  static function sendVerificationEmail($email, $conn){

    self::setBaseURL();

    // generate token and save it
    $tokenDuration =  7200; // seconds (2 hours)
    $tokenType = 'verify_email'; // store in DB as pwd_reset i.s.o email_verify
    $tokenString = Token::getTokenStringForURL($email, $tokenType, $tokenDuration, $conn);
    $URLQualifier = "verify_email.php";
    $url = self::$baseURL.$URLQualifier."?" . $tokenString;

    // create the e-mail content
    $subject = 'Confirm Your Email and Get Started ';
    $message = self::$header . '
    <!-- START MAIN CONTENT AREA -->
    <tr>
      <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
    <center><a href="index.php" class="navbar-left p-0 m-0"><img src="https://funinja.in/images/logo2.png" alt="" style="height:40px"></a></center>
        <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
          <tr>
            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hey,</p>
              <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">To help us keep your account secure, confirm your email and let’s get started!</p>

              <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                <tbody>
                  <tr>
                    <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                        <tbody>
                          <tr>
                            <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #EA5421; border-radius: 5px; text-align: center;"> <a href="' .$url. '" target="_blank" style="display: inline-block; color: #ffffff; background-color: #EA5421; border: solid 1px #EA5421; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #EA5421;">Verify</a> </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>

                  </tr>
                </tbody>
              </table>
    <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Regards,<br>The FuNinja Team</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!-- END MAIN CONTENT AREA -->
    </table>
    ' . self::$footer;

    $to = $email;
    self::sendEmail($to, $subject, $message, $message);
    exit();
  }

  static function sendTrainerAdminOnboardEmail($tokenType, $email, $userType, $conn){

    self::setBaseURL();
    $URLQualifier = "new_trainer_or_admin_onboard_email_landing.php";

    $tokenDuration =  7200; // seconds (2 hours)
    $tokenString = Token::getTokenStringForURL($email, $tokenType, $tokenDuration, $conn);
    $url = self::$baseURL.$URLQualifier."?" . $tokenString . "&email=" . $email . "&type=" .$userType;

    $split_names = explode('@', $email, 2);
    $name = $split_names[0];

    // create the e-mail content
    $subject = 'FuNinja Onboarding';
    $message = self::$header . '
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
    				<center><a href="https://funinja.in/" class="navbar-left p-0 m-0"><img src="https://funinja.in/images/logo2.png" alt="" style="height:40px"></a></center>
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi <b>'.$name.'</b>,</p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Welcome to FuNinja!<b></p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Please click the link below to start your onboarding process.</p>

    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Have any questions? </b></p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We would love to <a href="https://funinja.in/contact.php"> connect with you!</a></p>
                              <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                <tbody>
                                  <tr>
                                  <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                      <tbody>
                                        <tr>
                                    <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #EA5421; border-radius: 5px; text-align: center;"> <a href="' .$url. '" target="_blank" style="display: inline-block; color: #ffffff; background-color: #EA5421; border: solid 1px #EA5421; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #EA5421;">Begin Onboarding</a> </td>
                                  </tr>
                                </tbody>
                              </table>
                                  </td>

                                </tr>
                              </tbody>
                            </table>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Regards,<br>The FuNinja Team</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table>
    ' . self::$footer;

    $to = $email;
    self::sendEmail($to, $subject, $message, $message);

  }

  static function sendTraineeWelcomeEmail($name, $email){
    // create the e-mail content
    $subject = 'Welcome to FuNinja!';
    $message = self::$header . '
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
    				<center><a href="https://funinja.in/" class="navbar-left p-0 m-0"><img src="https://funinja.in/images/logo2.png" alt="" style="height:40px"></a></center>
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi <b>'.$name.'</b>,</p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Welcome to FuNinja!<b></p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We are here to get you started on your customized fitness journey with our highly specialized group of trainers.</p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b >A quick note on your <u style="color:green">FREE trial session: </u></b></p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">With your free account, you can enroll yourself for a free trial in a class of your choice with one of our esteemed trainers who will guide you through your session. </p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><a href="https://funinja.in/"><b>Sign in</b></a> to schedule your free trial and explore our various <b> membership plans </b> and payment options.</p>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Have any questions? </b></p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We would love to <a href="https://funinja.in/contact.php"> connect with you!</a></p>
                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                              <tbody>
                                <tr>
                                  <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                      <tbody>
                                        <tr>
                                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #EA5421; border-radius: 5px; text-align: center;"> <a href="https://FuNinja.in" target="_blank" style="display: inline-block; color: #ffffff; background-color: #EA5421; border: solid 1px #EA5421; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #EA5421;">Let\'s begin!</a> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>

                                </tr>
                              </tbody>
                            </table>
    						<p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Regards,<br>The FuNinja Team</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table>' . self::$footer;

    $to = $email;
    self::sendEmail($to, $subject, $message, $message);
  }

  static function sendTrainerWelcomeEmail($name, $email){


    // create the e-mail content
    $subject = 'Welcome to FuNinja!';
    $message = self::$header . '
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
            <center><a href="https://funinja.in/" class="navbar-left p-0 m-0"><img src="https://funinja.in/images/logo2.png" alt="" style="height:40px"></a></center>
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi <b>'.$name.'</b>,</p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Welcome to FuNinja!<b></p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We are here to get you started on helping you curate personalised fitness plans for your clients. </p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b >Access your Trainer Playbook via your dashboard to get to know how we work better...</b></p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><a href="https://funinja.in/"><b>Sign in</b></a> and explore our dynamic dashboard and tools equipped to ensure you have a seamless training delivery experience.</p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"><b>Have any questions? </b></p>
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We would love to <a href="https://funinja.in/contact.php"> connect with you!</a></p>
                            <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box;">
                              <tbody>
                                <tr>
                                  <td align="left" style="font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;">
                                    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                                      <tbody>
                                        <tr>
                                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #EA5421; border-radius: 5px; text-align: center;"> <a href="https://FuNinja.in" target="_blank" style="display: inline-block; color: #ffffff; background-color: #EA5421; border: solid 1px #EA5421; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #EA5421;">Let\'s begin!</a> </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </td>

                                </tr>
                              </tbody>
                            </table>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Regards,<br>The FuNinja Team</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table> ' . self::$footer;

    $to = $email;
    self::sendEmail($to, $subject, $message, $message);
  }

  static function sendTrialRequestConfirmationEmail($name, $trialType, $trialDate, $trialTimeSlot, $email, $phone, $conn){


    // create the e-mail content
    $subject = 'We received your Trial request';
    $message = self::$header . '
                  <!-- START MAIN CONTENT AREA -->
                  <tr>
                    <td class="wrapper" style="font-family: sans-serif; font-size: 14px; vertical-align: top; box-sizing: border-box; padding: 20px;">
            <center><a href="https://funinja.in/" class="navbar-left p-0 m-0"><img src="https://funinja.in/images/logo2.png" alt="" style="height:40px"></a></center>
                      <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;">
                        <tr>
                          <td style="font-family: sans-serif; font-size: 14px; vertical-align: top;">
                            <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Hi <b>'.$name.'</b>,</p>

                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">We just received a request from you for a <b>'. $trialType. '</b> trial session for <b>'.$trialDate. '</b> at <b>'.$trialTimeSlot. '</b></p>
                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;"> Shortly, one of us will give you a call on your number <b>' .$phone. '</b> to schedule the session and finalize timings. Hang tight!</p>

                <p style="font-family: sans-serif; font-size: 14px; font-weight: normal; margin: 0; Margin-bottom: 15px;">Regards,<br>The FuNinja Team</p>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>

                <!-- END MAIN CONTENT AREA -->
                </table> ' . self::$footer;

    $to = $email;
    self::sendEmail($to, $subject, $message, $message);
  }

}
?>
