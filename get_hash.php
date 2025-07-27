<?php
echo "Admin:  " .password_hash("admin1", PASSWORD_DEFAULT). "<br>"; 
echo "Security:  " .password_hash("security1", PASSWORD_DEFAULT);   
?>