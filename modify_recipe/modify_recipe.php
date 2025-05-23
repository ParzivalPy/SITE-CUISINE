<?php session_start();
require_once "../functions.php";
autoConnect(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style_modify_recipe.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <?php
    require_once "../header.php";
    $recipe = getRecipeById($_GET['id'], connectToDb());
    ?>
    <?php if (isset($_SESSION['LOGGED_USER']) && $_SESSION['LOGGED_USER']['user_id'] === $recipe['id_author']): ?>
        <div class="page">
            <form action="submit_modify_recipe.php" method="POST">
                <div>
                    <label for="title">Titre :</label>
                    <input type="text" id="title" name="title" value="<?php echo $recipe['title'] ?>" autofocus required>
                </div>
                <div>
                    <label for="category">Catégorie :</label>
                    <select id="category" name="category" required>
                        <option value="Entrée" <?php if ($recipe['category'] == "Entrée") {
                            echo "selected";
                        } ?>>Entrée
                        </option>
                        <option value="Plat" <?php if ($recipe['category'] == "Plat") {
                            echo "selected";
                        } ?>>Plat</option>
                        <option value="Accompagnement" <?php if ($recipe['category'] == "Accompagnement") {
                            echo "selected";
                        } ?>>Accompagnement</option>
                        <option value="Sauce" <?php if ($recipe['category'] == "Sauce") {
                            echo "selected";
                        } ?>>Sauce</option>
                        <option value="Dessert" <?php if ($recipe['category'] == "Dessert") {
                            echo "selected";
                        } ?>>Dessert
                        </option>
                    </select>
                </div>
                <div>
                    <label for="desc">Description :</label>
                    <textarea wrap="soft" id="desc" name="desc" required><?php echo $recipe['description'] ?></textarea>
                </div>
                <div>
                    <label for="prep_time">Temps de préparation :</label>
                    <input type="number" min="0" id="prep_time" name="prep_time" value="<?php echo $recipe['prep_time'] ?>"
                        required>
                </div>
                <div>
                    <label for="baking_time">Temps de cuisson :</label>
                    <input type="number" min="0" id="baking_time" name="baking_time"
                        value="<?php echo $recipe['baking_time'] ?>" required>
                </div>
                <div>
                    <label for="people_num">Nombre de personnes :</label>
                    <input type="number" min="0" id="people_num" name="people_num"
                        value="<?php echo $recipe['people_num'] ?>" required>
                </div>
                <div>
                    <label for="ingredients">Ingredients :</label><br>
                    <textarea wrap="soft" id="ingredients" name="ingredients"
                        required><?php echo $recipe['ingredients'] ?></textarea>
                </div>
                <div>
                    <label for="instructions">Instructions :</label><br>
                    <textarea wrap="soft" id="instructions" name="instructions"
                        required><?php echo $recipe['instructions'] ?></textarea>
                </div>
                <input type="hidden" id="id" name="id" value="<?php echo $recipe['id'] ?>">
                <input type="submit" id="submit" value="Modifier la recette"></input>
            </form>
        </div>
    <?php else: ?>
        <div class="alert-container" style="width: 50%; margin: 50px 25%;">
            <div class="alert dialog-box">
                <p>Vous n'avez pas la permission d'être ici<br>Vous serez redirigés dans 3 secondes...</p>
            </div>
        </div>
        <script>
            setTimeout(() => {
                window.location.href = "../login/login.php";
            }, 3000);
        </script>
    <?php endif; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var textareas = document.querySelectorAll('textarea');

            textareas.forEach(function (textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';

                textarea.addEventListener('input', function () {
                    textarea.style.height = 'auto';
                    textarea.style.height = (textarea.scrollHeight) + 'px';
                });
            });
        });
    </script>
    <script src="../script.js"></script>
</body>

</html>