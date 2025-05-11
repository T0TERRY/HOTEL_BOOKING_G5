<?php require "includes/header.php";?>
<?php require "config/config.php";?>

<?php 

	//hotels
	$hotels = $conn->query("SELECT * FROM hotels WHERE Status = 1");
	$hotels->execute();

	$allHotels = $hotels->fetchAll(PDO::FETCH_OBJ);

	//rooms
	$rooms = $conn->query("SELECT * FROM rooms WHERE Status = 1");
	$rooms->execute();

	$allRooms = $rooms->fetchAll(PDO::FETCH_OBJ);

?>


    <div class="hero-wrap js-fullheight" style="background-image: url('<?php echo APPURL;?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-md-7 ftco-animate">
          	<h2 class="subheading">Welcome to Vacation Rental</h2>
          	<h1 class="mb-4">Rent an appartment for your vacation</h1>
            <p><a href="<?php echo APPURL;?>/about.php" class="btn btn-primary">Learn more</a> <a href="<?php echo APPURL;?>/contact.php" class="btn btn-white">Contact us</a></p>
          </div>
        </div>
      </div>
    </div>

  
    <section class="ftco-section ftco-services">
    	<div class="container">
    		<div class="row">
			<?php foreach($allHotels as $hotels) : ?>
				<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
					<div class="d-block services-wrap text-center">
					<div class="img" style="background-image: url('images/<?php echo $hotels->image;?>');"></div>
					<div class="media-body py-4 px-3">
						<h3 class="heading"><?php echo $hotels->name;?></h3>
						<p><?php echo $hotels->description;?></p>
						<p><?php echo $hotels->location;?></p>
						<p><a href="rooms.php?id=<?php echo $hotels->id; ?>" class="btn btn-primary">View rooms</a></p>
					</div>
					</div>      
				</div>
				<?php endforeach; ?>
				</div> <!-- closing row -->
    </div> <!-- closing container -->
</section> <!-- closing section --> 


    <section class="ftco-section bg-light">
			<div class="container-fluid px-md-0">
				<div class="row no-gutters justify-content-center pb-5 mb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2>Apartment Room</h2>
          </div>
        </div>
				<div class="row no-gutters">
				<?php foreach($allRooms as $room) : ?>
    			<div class="col-lg-6">
    				<div class="room-wrap d-md-flex">
    					<a href="#" class="img" style="background-image: url('images/<?php echo $room->image;?>');"></a>
    					<div class="half left-arrow d-flex align-items-center">
    						<div class="text p-4 p-xl-5 text-center">
    							<p class="star mb-0"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></p>
    							<!-- <p class="mb-0"><span class="price mr-1">$120.00</span> <span class="per">per night</span></p> -->
	    						<h3 class="mb-3"><a href="<?php echo APPURL;?>/rooms/room-single.php?id=<?php echo $room->id?>"><?php echo $room->name;?></a></h3>
	    						<ul class="list-accomodation">
	    							<li><span>Max:</span> <?php echo $room->num_persons?></li>
	    							<li><span>Size:</span> <?php echo $room->size?></li>
	    							<li><span>View:</span> <?php echo $room->view?></li>
	    							<li><span>Bed:</span> <?php echo $room->num_beds?></li>
									<li><span>Price Per night:</span> $<?php echo $room->price?></li>
	    						</ul>
	    						<p class="pt-1"><a href="<?php echo APPURL;?>/rooms/room-single.php?id=<?php echo $room->id?>" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>
    						</div>
    					</div>
    				</div>
					
    			</div>
				<?php endforeach; ?>
    		</div>
			</div>
		</section>



    <section class="ftco-section bg-light">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 wrap-about">
						<div class="img img-2 mb-4" style="background-image: url('<?php echo APPURL;?>/images/image_2.jpg');">
						</div>
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
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-diet"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Tea Coffee</h3>
		                <p> Complimentary hot beverages to start your day right.</p>
		              </div>
		            </div> 
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-workout"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Hot Showers</h3>
		                <p> Enjoy refreshing hot showers anytime you need.</p>
		              </div>
		            </div>
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-diet-1"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Laundry</h3>
		                <p> Keep your clothes fresh and clean with our laundry facilities.</p>
		              </div>
		            </div>      
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Air Conditioning</h3>
		                <p> Stay cool and comfortable with fully air-conditioned rooms.</p>
		              </div>
		            </div>
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Free Wifi</h3>
		                <p> Fast and reliable internet access throughout the property.</p>
		              </div>
		            </div> 
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Kitchen</h3>
		                <p> A shared kitchen for guests who prefer to cook their own meals.</p>
		              </div>
		            </div> 
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Ironing</h3>
		                <p> Iron and ironing board available for your convenience.</p>
		              </div>
		            </div> 
		            <div class="services-2 col-lg-6 d-flex w-100">
		              <div class="icon d-flex justify-content-center align-items-center">
		            		<span class="flaticon-first"></span>
		              </div>
		              <div class="media-body pl-3">
		                <h3 class="heading">Lovkers</h3>
		                <p> Secure lockers to keep your belongings safe.</p>
		              </div>
		            </div>
		          </div>  
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="ftco-intro" style="background-image: url('<?php echo APPURL;?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-md-9 text-center">
						<h2>Ready to get started</h2>
						<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
						<p class="mb-0"><a href="<?php echo APPURL;?>/about.php" class="btn btn-primary px-4 py-3">Learn More</a> <a href="<?php echo APPURL;?>/contact.php" class="btn btn-white px-4 py-3">Contact us</a></p>
					</div>
				</div>
			</div>
		</section>

		<?php require "includes/footer.php";?>