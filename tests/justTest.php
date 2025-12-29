<?php
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
echo "\n";

// echo password_hash("12345", PASSWORD_BCRYPT);

// $hash = '$2y$12$4Umg0rCJwMswRw/l.SwHvuQV01coP0eWmGzd61QH2RvAOMANUBGC.';
// $pass = "rasmuslerdorf";

// $hash = '$2y$10$n06kSktjP/KwJnbqnezO5Onnio8qUpH5YrkJp.2m2bbNF5fpjwpzi';
// $pass = "12345";

// echo $pass;

// echo "\n";
// echo password_hash($pass, PASSWORD_DEFAULT);
// echo "\n";
// echo $hash;
// echo "\n";


// if (password_verify($pass, $hash)) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }


echo $_ENV['DB_HOST'];