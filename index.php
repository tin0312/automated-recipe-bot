<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook GPT</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="module" src="script/router.js"></script>
</head>

<body>
    <div id="errors" class=""></div>
    <div id="main-header" class="main-header">
        <a href="#view-recipes">View recipes</a>
        <a href="#add-recipes">Add recipes</a>
    </div>
    <div id="main-content" class="main-content hide-left-menu hide-header"></div>
    <div id="footer" class="footer">
        &copy; <?= date('Y') ?> Truong Nhat Hoang || All right reserve
    </div>
</body>