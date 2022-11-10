<?php

    session_start();
    // add box button is brings here from foodDetail page to here and starts to add food on
    // foodbox procedure first have control if in food box has an array or not if yes
    // there will create new array its contains to food infos and if food infos not pairs whic is
    // before already added will add new array but if its already added will execute an allert and
    // will send to user back to tracker.php page...

    if(isset($_POST["addbox"])){

        if(isset($_SESSION["food_box"])){

            $uniq_food = array_column($_SESSION["food_box"], "food_name");

            if(!in_array($_SESSION["food"], $uniq_food)){

                $count = count($_SESSION["food_box"]);

                $foodInfo = array(
                    'food_name' => $_SESSION["food"],
                    'food_protein' => $_SESSION["protein"],
                    'food_carb' => $_SESSION["carb"],
                    'food_fat' => $_SESSION["fat"],
                    'food_gram' => $_POST["gram"]
                );
        
                $_SESSION["food_box"][$count] = $foodInfo;
            }

            else{

                echo '<script> alert("This Food Already Added!"); </script>';
                echo '<script> window.location="foodbox.php" </script>';

            }
        }

        else{

            $foodInfo = array(
                'food_name' => $_SESSION["food"],
                'food_protein' => $_SESSION["protein"],
                'food_carb' => $_SESSION["carb"],
                'food_fat' => $_SESSION["fat"],
                'food_gram' => $_POST["gram"]
            );
    
            $_SESSION["food_box"][0] = $foodInfo;
        }

    }    

    // when Remove buton has clicked will exucute this if statements...
    if(isset($_GET["action"])){

        if($_GET["action"] == "delete"){

            foreach($_SESSION["food_box"] as $keys => $values){
                if($values["food_name"] == $_GET["id"]){
                    unset($_SESSION["food_box"][$keys]);
                    echo '<script>window.location="foodbox.php"</script>';
                }
            }

        }

    }

   

    

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initail-scale=1, maximum-scale=1.0, user-scaleble=no">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Best Food Tracker - Food Box - FitPatients</title>
        <link rel="stylesheet" href="foodbox.css" type="text/css">
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

        <div class="wraper">
            <?php require "header.php"; ?>

            <div class="empty">
                <div class="inEmpty"></div>
            </div>

            <h1 class="pageHead">Food Box</h2>

            <div class="buttons">
                <a href="tracker.php">Add More Food</a>
            </div>




           <div class="tableTab">
                <div class="inTableTab" id="tableTab">
                    <?php
                        $totalKcal = 0;
                        $kcal = 0;
                        $totalProtein = 0;
                        $totalCarb = 0;
                        $totalFat = 0;
                        $totalGram = 0;


                    if(!empty($_SESSION["food_box"])){ ?>

                        
                        <div class="tabDiv">
                            <p>Food</p>
                            <p>Protein</p>
                            <p>Carb</p>
                            <p>Fat</p>
                            <p>Gram</p>
                            <p>Kcal</p>
                            <p>Action</p>
                        </div>

                        <?php foreach($_SESSION["food_box"] as $keys => $values){ ?>
                    
                        
                            <div class="tabDiv">
                                <p><?php echo $values["food_name"]; ?></p>
                                <p><?php echo round(($values["food_protein"] / 100) * $values["food_gram"], 1); ?></p>
                                <p><?php echo round(($values["food_carb"] / 100) * $values["food_gram"],1); ?></p>
                                <p><?php echo round(($values["food_fat"] / 100) * $values["food_gram"], 1); ?></p>
                                <p><?php echo $values["food_gram"]; ?></p>
                                <p><?php echo $kcal + round(($values["food_protein"]/100 * $values["food_gram"] * 4) + 
                                ($values["food_carb"]/100 * $values["food_gram"] * 4) + ($values["food_fat"]/100 * $values["food_gram"] * 9), 1); ?></p>
                                <p><a href="foodbox.php?action=delete&id=<?php echo $values["food_name"]; ?>">Remove</a></p>
                            </div>
                    
                        <?php
                            $totalProtein = $totalProtein + $values["food_protein"];
                            $totalCarb = $totalCarb + $values["food_carb"];
                            $totalFat = $totalFat + $values["food_fat"];
                            $totalGram = $totalGram + $values["food_gram"];
                            $totalKcal = $totalKcal + round(($values["food_protein"]/100 * $values["food_gram"] * 4) + 
                            ($values["food_carb"]/100 * $values["food_gram"] * 4) + ($values["food_fat"]/100 * $values["food_gram"] * 9), 1);
                        }  ?>
                        

                        <div class="clean">
                            <div class="inClean">
                            </div>
                        </div>
                        
                        <div class="totalDiv">
                            <p></p>
                            <p>Total Protein</p>
                            <p>Total Carb</p>
                            <p>Total Fat</p>
                            <p>Total Gram</p>
                            <p>Total Kcal</p>
                        </div>
                        <div class="totalDiv">
                            <p>Total Values</p>
                            <p><?php echo round($totalProtein, 2); ?></p>
                            <p><?php echo round($totalCarb, 2); ?></p>
                            <p><?php echo round($totalFat, 2); ?></p>
                            <p><?php echo round($totalGram, 2); ?></p>
                            <p><?php echo round($totalKcal, 2); ?></p>
                        </div>

                     
                    <?php }
                    else { 
                        echo '<script>alert("No Food in Box Please Add Food Before!");</script>';
                        echo '<script>window.location="tracker.php"</script>';
                    } ?>
                </div>
            </div>
            
            
            <div class="clean">
                <div class="inClean"></div>
            </div>





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