<?php

session_destroy();
setcookie('remember');
header("Location:index.php");