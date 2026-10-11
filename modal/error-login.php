<?php
$error = $_GET['error'] ?? '';

$errorMessages = [
    'invalid'       => [
        'title' => 'Login Failed',
        'message' => 'Invalid username or password.'
    ],
    'inactive'      => [
        'title' => 'Account Inactive',
        'message' => 'Your account is inactive. Please contact the administrator.'
    ],
    'suspended'     => [
        'title' => 'Account Suspended',
        'message' => 'Your account has been suspended. Please contact the administrator.'
    ],
    'invalid_status' => [
        'title' => 'Account Unavailable',
        'message' => 'Your account status is not recognized. Please contact the administrator.'
    ],
    'empty'         => [
        'title' => 'Missing Information',
        'message' => 'Please enter your username and password.'
    ],
    'server'        => [
        'title' => 'Server Error',
        'message' => 'Something went wrong. Please try again later.'
    ]
];

if (isset($errorMessages[$error])) {
    $title = htmlspecialchars(
        $errorMessages[$error]['title'],
        ENT_QUOTES,
        'UTF-8'
    );

    $message = htmlspecialchars(
        $errorMessages[$error]['message'],
        ENT_QUOTES,
        'UTF-8'
    );

    echo '<script>
        document.addEventListener("DOMContentLoaded", function () {
            const modal = document.getElementById("errorModal");

            if (modal) {
                modal.querySelector("h2").textContent = ' .
        json_encode($title) . ';

                modal.querySelector("p").textContent = ' .
        json_encode($message) . ';

                modal.classList.remove("hidden");
            }
        });
    </script>';
}
