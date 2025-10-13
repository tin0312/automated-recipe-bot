<?php

function emailValidation($email): void
{
    global $error;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) or (strlen($email) <= 1)) {
        $error[] = '<span> Email contains invalid characters or is empty"></span>';
    }
}

function usernameValidation($username): void
{
    global $error;

    if (empty($username)) {
        $error[] = "Username is required";
        return;
    }

    if (strlen($username) < 6 || strlen($username) > 30) {
        $error[] = 'Username must be between 6 and 30 characters';
        return;
    }

    if (preg_match('/\s/', $username)) {
        $error[] = 'Username cannot contain spaces';
        return;
    }

    if (preg_match('/[_.\-]{2,}/', $username)) {
        $error[] = 'Username cannot have consecutive special characters';
        return;
    }
    if (preg_match('/[_.\-]$/', $username)) {
        $error[] = 'Username cannot end with a special character';
        return;
    }

    if (preg_match('/^[_.\-]/', $username)) {
        $error[] = 'Username cannot start with a special character';
        return;
    }

    if (!preg_match('/^[a-zA-Z0-9_.\-]+$/', $username)) {
        $error[] = 'Username can only contain letters, numbers, underscores, hyphens, and dots';
        return;
    }
}

function passwordValidation($password): void
{
    global $error;

    // Check if empty
    if (empty($password)) {
        $error[] = 'Password is required';
        return;
    }

    // Strong password validation
    $regex = "/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z@$!%*?&\d]{8,}$/";

    if (!preg_match($regex, $password)) {
        $error[] = 'Password must be at least 8 characters and contain: uppercase letter, number, and special character (@$!%*?&)';
        return;
    }
}




