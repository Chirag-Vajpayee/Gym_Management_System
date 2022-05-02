<?php

require('db.php');

$errors = array(); 
if (isset($_REQUEST['gym'])) {

  $gym_id = mysqli_real_escape_string($conn, $_REQUEST['id']);
  $name = mysqli_real_escape_string($conn, $_REQUEST['name']);
  $address = mysqli_real_escape_string($conn, $_REQUEST['address']);
  $type = mysqli_real_escape_string($conn, $_REQUEST['type']);
  
  $user_check_query = "SELECT * FROM gym WHERE gym_id='$gym_id' LIMIT 1";
  $result = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['gym_id'] === $gym_id) {
      array_push($errors, "<div class='alert alert-warning'><b>ID already exists</b></div>");
    }
  }

  if (count($errors) == 0) {
    $query = "INSERT INTO gym (gym_id,gym_name,address,type) 
          VALUES('$gym_id','$name','$address','$type')";
    $sql=mysqli_query($conn, $query);
    if ($sql) {
    $msg="<div class='alert alert-success'><b>Gym added successfully</b></div>";
    }else{
      $msg="<div class='alert alert-warning'><b>Gym not added</b></div>";
    }
  }
}

?>
<style>
  body{
    background-image: url("img3.jpg");
    background-repeat: no-repeat;
    background-size: 100% 160%;
   }
  .main{
    display: flex;
     justify-content: center;
     align-items: center;
  }
  .la{
    width: 900px;
    height: 40px;
  }
</style>


<div class="w3-container main">
	<form class="form-group mt-3" method="post" action="">
		<div><h3>ADD GYM</h3></div>
		 <?php include('errors.php'); 
    echo @$msg;

    ?>
    
    <div>
    <label class="mt-3">GYM ID</label>
    <div>
    <input type="text" class="la" name="id" class="form-control">
    </div>
		
    </div>
		<div>
    <label class="mt-3">GYM NAME</label>
    <div>
    <input type="text"class="la" name="name" class="form-control">
    </div>
		
    </div>
		<div>
    <label class="mt-3">GYM ADDRESS</label>
    <div>
    <input type="text"class="la" name="address" class="form-control">
    </div>
	
    </div>
	<div>
  <label class="mt-3">GYM TYPE</label>
  
  <select name="type" class="form-control mt-2 la">
    <option value="unisex">UNISEX</option>
    <option value="women">WOMEN</option>
    <option value="men">MEN</option>  
  
		
    </select>
  </div>
	
		<button class="btn btn-dark mt-3" type="submit" name="gym">ADD</button>
	</form>
</div>