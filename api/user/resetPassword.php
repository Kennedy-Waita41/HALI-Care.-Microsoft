<?php
require("master.inc.php");
require("auth.inc.php");

$oldPassword = isset($_POST["old-password"])?$_POST["old-password"]:"";
$newPassword = isset($_POST["new-password"])?$_POST["new-password"]:"";

$user = UserFactory::makeUser($currentUsername);
exit($user->changePassword($oldPassword, $newPassword));
exit(Respond::UEO());

?>