<?php

    require "dbcon.php";

?>

<!DOCTYPE html>
 <html language="en">
    <head>
        <meta name="viewport" content="width=device-width, initail-scale=1, maximum-scale=1.0, user-scaleble=no">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Your Food $ Best Food Database - FitPatients</title>
        <link rel="stylesheet" href="addFood.css" type="text/css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Mansalva&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Crimson+Pro&family=Literata">
        <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Rubik+Distressed&family=Six+Caps&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Mansalva&family=Rubik+Distressed&display=swap" rel="stylesheet">
        <link rel="icon" href="/imgs/favicon/favicon.ico" type="image">
        <link rel="shortcut icon" href="/imgs/favicon/android-icon-192x192.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Mansalva&family=Oswald:wght@200&family=Rubik+Distressed&family=Six+Caps&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Alegreya+SC:wght@500&family=Fjalla+One&family=Mansalva&family=Oswald:wght@200&family=Roboto+Condensed:ital,wght@1,700&family=Rubik+Distressed&family=Six+Caps&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Raleway:ital@1&display=swap" rel="stylesheet">

       
    </head>

    <body>

        <div class="wrapper">

            <?php require "header.php"; ?>


            <div class="empty">
                <div class="inEmpty"></div>
            </div>

            <h1 class="pageHead">Add Your Food</h1>

            <div class="general">

                <div class="rules">
                    <ol>
                        <li>Food Name Must Be Unique, if Same Name Have on List You can`t Add it!</li>
                        <li>Protein Values is on Back side of Food Packages</li>
                        <li>Carbohydirate Value is Must Be Total Carbohydirate on Package of Food</li>
                        <li>Fat Value Must Be Total Fat Value on Package of Food</li>
                        <li>All of Fields Must Be Entered Before Add!</li>
                    </ol>
                </div>

            
                <div class="addForm">
                    <form action="addFood.php" method="get">
                        <input type="text" name="food" placeholder="Name Of Food like 'egg'" required> 
                        <input type="number" step="0.01" name="protein" min="0.01" max="100" placeholder="Total Protein like '0.01'" required>
                        <input type="number" step="0.01" name="carb" min="0.01" max="100" placeholder="Total Carbohydirate like '0.01'" required>
                        <input type="number" step="0.01" min="0.01" max="100" name="fat" placeholder="Total Fat like '0.01'" required>
                        <input type="submit" name="addFood" value="Add New Food!" class="addBtn"> 
                    </form>
                </div>
            </div>


            <?php

                $minW = 3;

                if(isset($_GET['food'])){
                    $foodLen = strlen($_GET['food']);
                    $food = strip_tags($_GET['food']);
                    $protein = strip_tags($_GET['protein']);
                    $carb = strip_tags($_GET['carb']);
                    $fat = strip_tags($_GET['fat']);

                    if($foodLen > $minW){
                        $newQuery = "INSERT INTO foods(category, food, protein, carb, fat) VALUE('U', '$food', '$protein', '$carb', '$fat')";
                        $add = mysqli_query($connect, $newQuery);

                        if($add){
                            echo '<script>alert("New Food Added Successfuly!");</script>';
                            echo '<script>window.location="tracker.php"</script>';
                        }
                        else{
                            echo '<script>alert("Sorry! It Has Some Mistakes Please Try Again or Send Us Email on Contact Page!");</script>';
                            echo '<script>window.loacation="addFood.php"</script>';
                        }
                    }
                    
                    else{
                        echo '<script>alert("Food Name can`t be Short Than 3 words!");</script>';
                        echo '<script>window.loacation="addFood.php"</script>';
                    }
                }
                


            ?>





             
            <?php require "footer.php"; ?>

        </div>


    </body>

    <script type="text/javascript">
        
        function myFunction() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
                }
            }
            }
        }

    </script>

</html>