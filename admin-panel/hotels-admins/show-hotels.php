<?php require "../layouts/header.php";?>
<?php require "../../config/config.php";?>

<?php

if(!isset($_SESSION['adminname'])) {
    header("Location: " . ADMINURL . "admins/login-admins.php");
    exit();
}

  $hotels = $conn->query("SELECT * FROM hotels");
  $hotels->execute();

  $allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Hotels</h5>
             <a  href="create-hotels.php" class="btn btn-primary mb-4 text-center float-right">Create Hotels</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">name</th>
                    <th scope="col">location</th>
                    <th scope="col">status value</th>
                    <th scope="col">change status</th>
                    <th scope="col">update</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allHotels as $hotels): ?>
                    <tr>
                      <th scope="row"><?php echo $hotels->id;?></th>
                      <td><?php echo $hotels->name;?></td>
                      <td><?php echo $hotels->location;?></td>
                      <td><?php echo $hotels->status;?></td>

                      <td><a  href="status-hotels.php?id=<?php echo $hotels->id;?>" class="btn btn-warning text-white text-center ">status</a></td>
                      <td><a  href="update-hotels.php?id=<?php echo $hotels->id;?>" class="btn btn-warning text-white text-center ">Update </a></td>
                      <td><a href="delete-hotels.php?id=<?php echo $hotels->id;?>" class="btn btn-danger  text-center ">Delete </a></td>
                    </tr>
                  <?php endforeach; ?>
              
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>


<?php require "../layouts/footer.php";?>
