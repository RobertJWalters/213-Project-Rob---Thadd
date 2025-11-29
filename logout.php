<?php
session_start();
<<<<<<< Updated upstream
<<<<<<< Updated upstream
session_destroy();
header("Location: index.php");
exit();
=======
=======
>>>>>>> Stashed changes
session_unset();
session_destroy();
header('Location: shop.php');
exit;
<<<<<<< Updated upstream
>>>>>>> Stashed changes
=======
>>>>>>> Stashed changes
