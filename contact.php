<?php require "includes/header.php";?>
<?php require "config/config.php";?>

   
<section class="hero-wrap hero-wrap-2" style="background-image: url('<?php echo APPURL;?>/images/image_2.jpg');" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center">
      <div class="col-md-9 ftco-animate text-center">
        <p class="breadcrumbs mb-2">
          <span class="mr-2"><a href="<?php echo APPURL;?>">Home <i class="fa fa-chevron-right"></i></a></span>
          <span>Contact <i class="fa fa-chevron-right"></i></span>
        </p>
        <h1 class="mb-0 bread">Contact Us</h1>
      </div>
    </div>
  </div>
</section>

<section class="ftco-section bg-light">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-md-8">
        <!-- Google Map Embed -->
        <iframe 
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15641.931351933076!2d104.8894506!3d11.5692584!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x310951ce2e2e4b9b%3A0xa51137ea0a3520d4!2sRoyal%20University%20of%20Phnom%20Penh!5e0!3m2!1sen!2skh!4v1715433366967!5m2!1sen!2skh" 
          width="100%" 
          height="500" 
          style="border:0;" 
          allowfullscreen="" 
          loading="lazy" 
          referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>
      <div class="col-md-4 p-4 p-md-5 bg-white">
        <h2 class="font-weight-bold mb-4">Let's get started</h2>
        <p>We’re here to help! Reach out anytime for support or inquiries. We'd love to hear from you.</p>
        <p><a href="<?php echo APPURL;?>" class="btn btn-primary">Book Apartment Now</a></p>
      </div>

      <div class="col-md-12 mt-5">
        <div class="wrapper">
          <div class="row no-gutters">
            <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
              <div class="contact-wrap w-100 p-md-5 p-4">
                <h3 class="mb-4">Get in touch</h3>
                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="label" for="name">Full Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                      </div>
                    </div>
                    <div class="col-md-6"> 
                      <div class="form-group">
                        <label class="label" for="email">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="label" for="subject">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="label" for="message">Message</label>
                        <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message" required></textarea>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary">
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
              <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                <h3>Let's get in touch</h3>
                <p class="mb-4">We're open for any suggestion or just to have a chat.</p>
                <div class="dbox w-100 d-flex align-items-start">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-map-marker"></span>
                  </div>
                  <div class="text pl-3">
                    <p><span>Address:</span> Royal University of Phnom Penh (RUPP)</p>
                  </div>
                </div>
                <div class="dbox w-100 d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-phone"></span>
                  </div>
                  <div class="text pl-3">
                    <p><span>Phone:</span> <a href="tel:+85593338472">+855 93 338 472</a></p>
                  </div>
                </div>
                <div class="dbox w-100 d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-paper-plane"></span>
                  </div>
                  <div class="text pl-3">
                    <p><span>Email:</span> <a href="mailto:ypengly060@gmail.com">ypengly060@gmail.com</a></p>
                  </div>
                </div>
                <div class="dbox w-100 d-flex align-items-center">
                  <div class="icon d-flex align-items-center justify-content-center">
                    <span class="fa fa-globe"></span>
                  </div>
                  <div class="text pl-3">
                    <p><span>Website:</span> <a href="#">yoursite.com</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div> <!-- /.col-md-12 -->
    </div>
  </div>
</section>

<?php require "includes/footer.php"; ?>
