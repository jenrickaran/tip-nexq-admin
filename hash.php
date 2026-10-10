
<?php

$normalWord = "tralalA!007";

$hashedWord = password_hash($normalWord, PASSWORD_DEFAULT);

echo "Normal word: " . $normalWord . "<br>";
echo "Hashed word: " . $hashedWord;

?>
