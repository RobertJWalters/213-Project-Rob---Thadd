<?php
session_start();
<<<<<<< Updated upstream
session_destroy();
header("Location: index.php");
exit();
=======
session_unset();
session_destroy();
header('Location: shop.php');
exit;
>>>>>>> Stashed changes
