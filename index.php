<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cook GPT</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="script/searchInput.js"></script>
    <script src="script/showRecipesForm.js"></script>
</head>
<body>
    <div id="errors" class=""></div>
    <div id="main-header" class="main-header">
          <h1>This is the header</h1>
          <a href="#add-recipes">Add recipe</a>
    </div>
    <div id="main-content" class="main-content hide-left-menu hide-header"></div>
    <div id="footer" class="footer">
        &copy; <?=date('Y') ?> Truong Nhat Hoang || All right reserve
    </div>

    <script>
        function handleRoute(){
            const hash = window.location.hash.slice(1);
            console.log(hash);
            switch(hash){
                case "add-recipes":
                    showRecipesForm();
                    break;
                default:
                    searchInput();    
            }
        }
        window.addEventListener('load', function(){
            handleRoute();
        })
        window.addEventListener('hashchange', handleRoute);
    </script>
</body>
