<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
   <title>El Hotel • Search Page</title>
   <!-- for web icon-->
   <link rel = "icon" href = "images/elhotel.png" type = "image/jpg">

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<!-- header section starts  -->
<?php include 'components/user_header.php'; ?>
<!-- header section ends -->

<!-- search form section starts  -->

<section class="search-form">
   <form method="post" action="">
      <input type="text" name="search_box" placeholder="search here..." class="box">
      <button type="submit" name="search_btn" class="fas fa-search"></button>
   </form>
</section>

<!-- search form section ends -->


<section class="rooms" style="min-height: 100vh; padding-top:0;">

<div class="box-container">

      <?php
         if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
         $search_box = $_POST['search_box'];
         $select_rooms = $conn->prepare("SELECT * FROM `rooms` WHERE category LIKE '%{$search_box}%'");
         $select_rooms->execute();
         if($select_rooms->rowCount() > 0){
            while($fetch_rooms = $select_rooms->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_rooms['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_rooms['description']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_rooms['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_rooms['image']; ?>">
         <img src="uploaded_img/<?= $fetch_rooms['image']; ?>" alt="">
         <center><a href="category.php?category=<?= $fetch_rooms['category']; ?>" class="cat"><?= $fetch_rooms['category']; ?></a></center>
         <div class="name"><?= $fetch_rooms['description']; ?></div>
         <div class="flex">
            <div class="price">₱<?= $fetch_rooms['price']; ?><span> per night</span></div>
         </div>
         <center><button type="submit" class="btn">View Room</button> </center>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">No rooms added yet!</p>';
         }
      }
      ?>

   </div>

</section>











<!-- footer section starts  -->
<?php include 'components/footer.php'; ?>
<!-- footer section ends -->







<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>