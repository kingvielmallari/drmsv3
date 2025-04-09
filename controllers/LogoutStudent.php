<?php
session_start();
session_unset();
session_destroy();

// Redirect to homepage or login
header("Location: ../");
exit();
