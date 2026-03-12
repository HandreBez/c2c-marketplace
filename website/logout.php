<?php
include "layout/header.php";

session_destroy();

echo "You have been logged out";

include "layout/footer.php";
?>