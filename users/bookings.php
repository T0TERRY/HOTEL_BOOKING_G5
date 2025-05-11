<?php require "../includes/header.php";?>
<?php require "../config/config.php";?>
<?php

    // if($_SESSION['username']){
    //     echo "<script>window.location.href='".APPURL."'</script>";
    // }

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        if($_SESSION['id'] != $id){
            echo "<script>window.location.href='".APPURL."'</script>";
        }

        $bookings = $conn->query("SELECT * FROM bookings WHERE user_id = '$id'");
        $bookings->execute();
        
        $allBookings = $bookings->fetchAll(PDO::FETCH_OBJ);
    }else{
        echo "<script>window.location.href='".APPURL."/404.php'</script>";
    }

?>

<div class="container">
    <?php if(count($allBookings) > 0):?>
<table class="table mt-5">
  <thead>
    <tr>
      
      <th scope="col">Check In</th>
      <th scope="col">Check Out</th>
      <th scope="col">Email</th>
      <th scope="col">Phone Number</th>
      <th scope="col">Full Name</th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Room Name</th>
      <th scope="col">Status</th>
      <th scope="col">Payment</th>
      <th scope="col">Created at</th>
    </tr>
  </thead>
  <tbody>
        <?php foreach($allBookings as $booking): ?>
                <tr>
                <th scope="row"><?php echo $booking->check_in; ?></th>
                <td><?php echo $booking->check_out; ?></td>
                <td><?php echo $booking->email; ?></td>
                <td><?php echo $booking->phone_number; ?></td>
                <td><?php echo $booking->full_name; ?></td>
                <td><?php echo $booking->hotel_name; ?></td>
                <td><?php echo $booking->room_name; ?></td>
                <td><?php echo $booking->status; ?></td>
                <td><?php echo $booking->payment; ?></td>
                <td><?php echo $booking->created_at; ?></td>
                </tr>
        <?php endforeach; ?>

  </tbody>
</table>

        <?php else: ?>
        <br>
        <div class="alert alert-primary" role="alert">
            
               You have not made any bookings just yet!
        </div>
        <?php endif; ?>
</div>














<?php require "../includes/footer.php";?>