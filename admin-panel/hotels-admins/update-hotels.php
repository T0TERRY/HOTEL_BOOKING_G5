<?php require "../layouts/header.php";?>
<?php require "../../config/config.php";?>
<?php 
  if(isset($_GET['id'])){
      $id = $_GET['id'];

      // Get existing hotel data
      $hotel = $conn->prepare("SELECT * FROM hotels WHERE id = :id");
      $hotel->execute([':id' => $id]);    
      $hotelSingle = $hotel->fetch(PDO::FETCH_OBJ);
      
      if(isset($_POST['submit'])){
          if(empty($_POST['name']) || empty($_POST['description']) || empty($_POST['location'])){
              echo "<script>alert('All fields are required');</script>";
          } else {
              $name = $_POST['name'];
              $description = $_POST['description'];
              $location = $_POST['location'];

              // Corrected SQL with parameter binding for ID
              $update = $conn->prepare("UPDATE hotels SET 
                  name = :name, 
                  description = :description, 
                  location = :location 
                  WHERE id = :id");
              
              $update->execute([
                  ":name" => $name,
                  ":description" => $description,
                  ":location" => $location,
                  ":id" => $id  // Added ID parameter binding
              ]);
              
              header("Location: show-hotels.php");
              exit();
          }
      }
  }
?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Hotel</h5>
          <form method="POST" action="update-hotels.php?id=<?php echo $id;?>">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" value="<?php echo $hotelSingle->name ?>" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea class="form-control" value="<?php echo $hotelSingle->description ?>" name="description" id="exampleFormControlTextarea1" rows="3"><?php echo $hotelSingle->description; ?></textarea>
                </div>

                <div class="form-outline mb-4 mt-4">
                  <label for="exampleFormControlTextarea1">Location</label>

                  <input type="text" value="<?php echo $hotelSingle->location ?>" name="location" id="form2Example1" class="form-control"/>
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  

<?php require "../layouts/footer.php";?>