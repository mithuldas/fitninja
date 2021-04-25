<?php
include_once "config.php";
include_once ( ROOT_DIR.'/includes/autoloader.php' );

FlowControl::startSession();
include_once ROOT_DIR."/includes/auto_login.php";
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <title> Privacy Policy - FuNinja </title>
  <?php
  require ROOT_DIR."/includes/frameworks.php";
  ?>
</head>

<body>
<?php
include ROOT_DIR."/header.php";
?>

<script>
// add class to body tag so that white background can be set

$("body").addClass("whiteBackground");

</script>

<div class="container pb-4">
  <center><h5 class="mobileTitle mobCenterDiv pt-3 ">Privacy Policy</h5></center>
  <div class="row">
    <div class="col">

      <h6>GENERAL</h5>
<ul>
<li>Bare Metal Solutions ("FuNinja") is committed to safeguarding personal data of its Users. Users agree that using the Website means that they are giving permission to the collection, storage and use of Users' personal data according to the conditions specified in this document(“Privacy Policy”).</li>
<li>FuNinja does not sell User Data collected to any third party. When a User uses the Services, Users’ IP address and other personal information may automatically get stored. While FuNinja does its best to protect Users’ information, particularly with respect to protection of Users’ personal data, FuNinja cannot ensure the security of Users’ data transmitted via the internet, web network or any other networks.

<li>Access to the contents of FuNinja is conditional upon User’s approval of the Privacy Policy which should be read together with the terms of use of service (“Terms”). Users acknowledge that this Privacy Policy, together with our Terms and Conditions, forms a legally binding agreement with FuNinja in relation to the use of Services (“Agreement”).</li>

<li>FuNinja reserves the right to get in touch with the customer to garner feedback and provide any additional services that customer would be eligible for.</li>
</ul>

<h6>INFORMATION COLLECTED</h6>
<ul>

<li>Personal Information
  <ul>
    In order for Users to access certain areas of the Website, FuNinja can mandate Users to submit FuNinja information that personally identifies such Users ("Personal Information"). Personal Information includes:

    <ul>
<li>Contact Data (such as e-mail address, phone number and any other contact details)</li>
<li>Demographic Data (optional) (such as time zone, postal address and location details).</li>

</ul>
If a User communicates with FuNinja by, for example, e-mail or letter, any information provided in such communication may be retained as Personal Information by FuNinja.</ul>
</li>
<li>FuNinja's website may contain links to external websites (third party). Users agree and understand that privacy policies of these third party websites are not determined by FuNinja. Users understand that once a User leaves FuNinja’s website, any information the User provides will be in accordance to the privacy policy of the third party website.</li>
</ul>

<h6>DISCLOSURE OF PERSONAL INFORMATION</h6>
<ul>
<li>FuNinja reserves the right to disclose Personal Information if required to do so by law or if FuNinja believes that it is necessary to do so to protect and defend the rights, property or personal safety of FuNinja, the Services, or other Users.</li>
<li>FuNinja may disclose to third party services certain personally identifiable information listed below:
<ul>
<li>Personal data such as name, email,  phone number</li>
<li>information we collect as you access and use our service, including device information and location</li>
</ul></li>
<li>This information is shared with third party service providers so that we can:
<ul><li>personalize the Website for you</li>
<li>detect and collect statistics about our userbase to help us serve them better</li>
</ul>
</li>
</ul>

<h6>CONFIDENTIALITY AND SECURITY</h6>
<ul>
<li>Except as otherwise provided in this Privacy Policy, FuNinja will keep all Personal Information private and will not share it with third parties, unless FuNinja believes in good faith that disclosure of such Personal Information or any other information FuNinja collects about Users is necessary for Permitted Use or to:
<ul>
  <li>Comply with a court order or other legal process;</li>
  <li>Protect the rights, property or safety of FuNinja, FuNinja’s officers, employees, agents, consultants and affiliates or another party;</li>
  <li>Enforce the Agreement, including Terms; or</li>
  <li>Respond to claims that any posting or other content violates the rights of third-parties.</li>
</ul>
</li>
</ul>
<h6>SECURITY</h6>
<ul><li>The security of Users’ Personal Information is important to FuNinja. FuNinja follows generally accepted industry standards to protect the Personal Information submitted to FuNinja, both during transmission and after FuNinja receives it.</li>

<li>Although FuNinja makes best possible efforts to store Personal Information in a secure operating environment that is not open to the public, Users should understand that there is no such thing as complete security, and FuNinja does not guarantee that there will be no unintended disclosures of Personal Information. If FuNinja becomes aware that certain Personal Information has been disclosed in a manner not in accordance with this Privacy Policy, FuNinja will use reasonable efforts to notify the concerned User of the nature and extent of such disclosure (to the extent FuNinja is aware of that information) as soon as reasonably possible and as permitted by law.</li>
</li>
</ul>
<h6>UPDATES AND CHANGES TO PRIVACY POLICY</h6>
<ul>
  <li>
FuNinja reserves the right, at any time, to add to, change, update, or modify this Privacy Policy. Users are requested to review this Privacy Policy frequently. If any change has been incorporated in this Privacy Policy by FuNinja, then FuNinja will post such changes on this page. In all cases, use of information FuNinja collects is subject to the Privacy Policy in effect at the time such information is collected by FuNinja.
</li>
</ul>

<h6>USERS’ RIGHTS</h6>
<ul><li>Users have a right to correct any errors in such User’s Personal Information available with FuNinja. A User may request FuNinja in writing that FuNinja ceases to use such User’s Personal Information. FuNinja may stop providing Services to such a User, if so required.</li></ul>

<h6>LIMITATION OF LIABILITY</h6>
<ul>
<li>No warranty of any kind, implied, expressed or statutory, including but not limited to the warranties of non-infringement of third party rights, title, merchantability, fitness for a particular purpose and freedom from computer virus, is given with respect to the Services provided by FuNinja, including provisions of Website.</li>
<li>Any reference on the Website to any specific commercial products, processes, or services, or the use of any trade, firm or corporation name is for the information and convenience of the public, and does not constitute endorsement, recommendation, or favoring by FuNinja.</li>
</ul>

If Users have questions or concerns, they may email FuNinja at hello@FuNinja.in and FuNinja will attempt to address Users’ concerns at the earliest.<br>
<br>
Last updated on: 18 Sep 2020
    </div>

  </div>

</div>

<?php
  require "footer.php";
?>

<script>
// set active link display in the menu bar
$('.aboutLink').addClass("activeMenuLink");


</script>
