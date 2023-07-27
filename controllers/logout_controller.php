<?php
session_start();
session_unset();
session_destroy();
header('Location: /carrinho/views/login.php');
exit();
