<?php 
ob_start(); // Start output buffering at the very top
require "../includes/header.php";
require "../config/config.php";

if(!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    ob_end_clean(); // Clean the buffer
    header("Location: ".APPURL);
    exit;
}

// Rest of your code...
$id = $_GET['id'];

// Validate the ID is numeric
if(!is_numeric($id)) {
    header("Location: ".APPURL);
    exit;
}

$rooms = $conn->prepare("SELECT * FROM rooms WHERE status = 1 AND id = :id");
$rooms->execute([':id' => $id]);
$singleRoom = $rooms->fetch(PDO::FETCH_OBJ);

if (!$singleRoom) {
    ob_end_clean();
    header("Location: " . APPURL . "/404.php");
    exit;
}


// Utilities query remains the same
$utilities = $conn->query("SELECT * FROM utilities WHERE room_id='$id'");
$allUtilities = $utilities->fetchAll(PDO::FETCH_OBJ);

// In your booking form processing section (around line 52 in your code)
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['phone_number']) || empty($_POST['full_name']) 
        || empty($_POST['check_in']) || empty($_POST['check_out'])) {
        echo "<script>alert('One or more inputs are empty');</script>";
    } else {
        $check_in = date('Y-m-d', strtotime($_POST['check_in']));
        $check_out = date('Y-m-d', strtotime($_POST['check_out']));
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $full_name = $_POST['full_name'];
        $hotel_name = $_POST['hotel_name'] ?? '';
        $room_name = $_POST['room_name'] ?? '';
        $status = "Pending";
        
        // Calculate number of days
        $date1 = new DateTime($check_in);
        $date2 = new DateTime($check_out);
        $interval = $date1->diff($date2);
        $days = $interval->days;
        
        // Calculate total price
        $daily_price = $singleRoom->price;
        $payment = $daily_price * $days;
        
        $_SESSION['price'] = $payment; // Store calculated price in session

        if(!isset($_SESSION['id'])) {
            echo "<script>alert('You must be logged in to book');</script>";
        } else {
            $user_id = $_SESSION['id'];

            if (date("Y-m-d") > $check_in || date("Y-m-d") > $check_out) {
                echo "<script>alert('Pick a date that is not in the past.');</script>";
            } elseif ($check_in >= $check_out) {
                echo "<script>alert('Invalid date range.');</script>";
            } else {
                $booking = $conn->prepare("INSERT INTO bookings (check_in, check_out, email, phone_number, full_name, hotel_name, room_name, status, payment, user_id)
                    VALUES (:check_in, :check_out, :email, :phone_number, :full_name, :hotel_name, :room_name, :status, :payment, :user_id)");
    
                $booking->execute([
                    ":check_in" => $check_in,
                    ":check_out" => $check_out,
                    ":email" => $email,
                    ":phone_number" => $phone_number,
                    ":full_name" => $full_name,
                    ":hotel_name" => $hotel_name,
                    ":room_name" => $room_name,
                    ":status" => $status,
                    ":payment" => $payment,
                    ":user_id" => $user_id
                ]);

                echo "<script>window.location.href='".APPURL."/rooms/pay.php'</script>";
            }
        }
    }
}
?>


<div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL; ?>/images/<?php echo htmlspecialchars($singleRoom->image); ?>');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start">
            <div class="col-md-7 ftco-animate">
                <h2 class="subheading">Welcome to Vacation Rental</h2>
                <h1 class="mb-4"><?php echo htmlspecialchars($singleRoom->name); ?></h1>
                <p><a href="<?php echo APPURL; ?>" class="btn btn-primary">Learn more</a> <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white">Contact us</a></p>
            </div>
        </div>
    </div>
</div>

<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-4">
                <form action="room-single.php?id=<?php echo htmlspecialchars($id); ?>" method="POST" class="appointment-form" style="margin-top: -568px;">
                    <h3 class="mb-3">Book this room</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="full_name" class="form-control" placeholder="Full Name" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="tel" name="phone_number" class="form-control" placeholder="Phone Number" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="input-wrap">
                                    <div class="icon"><span class="ion-md-calendar"></span></div>
                                    <input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In" required>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="icon"><span class="ion-md-calendar"></span></div>
                                <input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out" required>
                            </div>
                        </div>
                        
                        <input type="hidden" name="hotel_name" value="<?php echo htmlspecialchars($singleRoom->hotel_name); ?>">
                        <input type="hidden" name="room_name" value="<?php echo htmlspecialchars($singleRoom->name); ?>">
                    
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Book and Pay Now" class="btn btn-primary py-3 px-4">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="ftco-section bg-light">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-md-6 wrap-about">
                <div class="img img-2 mb-4" style="background-image: url(<?php echo APPURL; ?>/images/image_2.jpg);"></div>
                <h2>The most recommended vacation rental</h2>
                <p>Discover why guests love staying with us! Our vacation rental offers the perfect blend of comfort, convenience, and thoughtful amenities — from air conditioning and free Wi-Fi to a full kitchen and cozy rooms. With top-rated hospitality and a peaceful atmosphere, it’s no wonder we’re one of the most recommended stays in the area. Book your getaway today and feel right at home!</p>
            </div>
            <div class="col-md-6 wrap-about ftco-animate">
                <div class="heading-section">
                    <div class="pl-md-5">
                        <h2 class="mb-2">What we offer</h2>
                    </div>
                </div>
                <div class="pl-md-5">
                    <p>At our place, comfort and convenience come first. We provide a range of amenities to make your stay relaxing and enjoyable:</p>
                    <div class="row">
                        <?php if (!empty($allUtilities)): ?>
                            <?php foreach($allUtilities as $utility): ?>
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <span class="<?php echo htmlspecialchars($utility->icon); ?>"></span>
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading"><?php echo htmlspecialchars($utility->name); ?></h3>
                                        <p><?php echo htmlspecialchars($utility->description); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p>No utilities found for this room.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="ftco-intro" style="background-image: url(<?php echo APPURL; ?>/images/image_2.jpg);">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 text-center">
                <h2>Ready to get started</h2>
                <p class="mb-4">It's safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
                <p class="mb-0"><a href="<?php echo APPURL; ?>" class="btn btn-primary px-4 py-3">Learn More</a> <a href="<?php echo APPURL; ?>/contact.php" class="btn btn-white px-4 py-3">Contact us</a></p>
            </div>
        </div>
    </div>
</section>



<?php require "../includes/footer.php"; ?>
