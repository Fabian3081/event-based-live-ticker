<?php

// execute with:
// php -f sql/passwordGenerator.php

$password = "...";

echo password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
echo "\n";