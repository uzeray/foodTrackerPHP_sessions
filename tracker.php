<?php
  error_reporting(0);
  require "dbcon.php";
  session_start();
?>


<!DOCTYPE html>
 <html language="en">
  <head>
    <meta name="viewport" content="width=device-width, initail-scale=1, maximum-scale=1.0, user-scaleble=no">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Best Calorie Counter - Simple Food Diary Tracker - Large Food Database - FitPatients</title>
    <link rel="stylesheet" href="tracker.css" type="text/css">
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

      <h1 class="pageHead">Fit Tracker</h1>

    
      <div class="boxBtn">
        <a href="foodbox.php">FoodBox</a>
      </div>
    



      <div class="searcher">
        <div class="inSearcher">
          <form action="tracker.php">
            <input type="text" name="search" id="search" class="searchText" placeholder="Search">
            <input type="submit" name="submit" id="submit" class="searchBtn" value="Search">
          </form>
        </div>
      </div>

      <?php

        if(isset($_GET)){
          $entry = strip_tags($_GET['search']);
        }

        $query2 = "SELECT * FROM foods WHERE food LIKE '%$entry%'";
        $result2 = mysqli_query($connect, $query2);
        
      ?>

      <h2>Food List</h2>

      <div class="container">

        <div class="foodListTab">
          <?php
            $query = "SELECT * FROM foods";
            $result = mysqli_query($connect, $query2);
            if(mysqli_num_rows($result2) > 0){
              while($row = mysqli_fetch_array($result2)) { ?>
                <form action="foodDetail.php" method="post">
                  <h3><?php echo $row["food"]; ?></h3>
                  <h3>Protein : <?php echo $row["protein"]; ?></h3>
                  <h3>Carb : <?php echo $row["carb"]; ?></h3>
                  <h3>Fat : <?php echo $row["fat"]; ?></h3>
                  <input type="hidden" name="hidden-name" id="name<?php echo $row["id"]; ?>" value="<?php echo $row["food"] ?>">
                  <input type="hidden" name="hidden-protein" value="<?php echo $row["protein"] ?>">
                  <input type="hidden" name="hidden-carb" value="<?php echo $row["carb"] ?>">
                  <input type="hidden" name="hidden-fat" value="<?php echo $row["fat"] ?>">
                  <input type="submit" name="addtobox" class="addtobox" value="Add">
                </form>
          <?php } } else { ?>
            <div class="newFood">
              <p>Sorry!!! We Couldn`t Find " <?php echo $entry; ?> ", If You Want to Add Your Food...</p>
              <a href="addFood.php">Add Food</a>
            </div>
          <?php } ?>
        </div>

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