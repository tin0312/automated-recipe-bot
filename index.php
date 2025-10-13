<?php

include_once "./includes/session.inc.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook GPT</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="script/router.js"></script>
    <script src="script/registrationForm.js"></script>
</head>

<body>
    <div id="errors" class=""></div>
    <div id="modalOverlay" class="modal-overlay">
        <div class="modal" id="modal">
            <button class="close-btn" id="closeModal" onclick="closeModal()">&times;</button>
        </div>
    </div>
    <div id="main-header" class="main-header">
        <div class="spacer"></div>
        <div class="navigation-menu">
            <a href="#">Home</a>
            <a href="#view-recipes">View recipes</a>
            <a href="#add-recipes">Add recipes</a>
        </div>
        <div class="authentication-btn-container">
            <button onclick="signIn()">Login</button>
            <button onclick="registrationForm()">Sign up</button>
        </div>
    </div>
    <div id="main-content" class="main-content hide-left-menu hide-header"></div>
    <div id="footer" class="footer">
        &copy; <?= date('Y') ?> Truong Nhat Hoang || All right reserve
    </div>
    <script>
        const csrfToken = '<?php echo $csrf_token ?>';

        function closeModal() {
            document.getElementById('modalOverlay').classList.remove("active");
            document.body.style.overflow = 'auto';
        }
    </script>
</body>