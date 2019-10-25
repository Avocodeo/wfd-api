<?php
return [
  "driver" => "smtp",
  "host" => "smtp.mailtrap.io",
  "port" => 2525,
  "from" => array(
      "address" => "noreply@wfdap.io",
      "name" => "NoReply-WhatsForDinner"
  ),
  "username" => "7b2c33e307f015",
  "password" => "0c11ff29c44228",
  "sendmail" => "/usr/sbin/sendmail -bs"
];