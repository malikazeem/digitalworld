<!-- START MAP -->
<section id="map" class=" wow fadeInUp" data-wow-offset="75" data-wow-delay="2s">
 	<div class="container-wide">
 		<div class="row">
        	<div id="map_canvas"></div> <!-- GO TO master.js to edit map -->
        </div><!-- end row -->
  	</div><!-- end container -->
</section>
<!-- END MAP -->

<!-- START -->
<section class="page-block-small BGsecondary">
	<div class="social">
      <ul class="list-inline text-center">
        <li class="wow bounceInDown" data-wow-offset="75" data-wow-delay="0.25s"><a href="#" data-toggle="tooltip" title="Follow Us on Facebook"><i class="fa fa-facebook"></i></a></li>
        <li class="wow bounceInUp" data-wow-offset="75" data-wow-delay="0.50s"><a href="#" data-toggle="tooltip" title="Follow Us on Twitter"><i class="fa fa-twitter"></i></a></li>
        <li class="wow bounceInDown" data-wow-offset="75" data-wow-delay="0.75s"><a href="#" data-toggle="tooltip" title="Watch Our Videos"><i class="fa fa-youtube-play"></i></a></li>
        <li class="wow bounceInUp" data-wow-offset="75" data-wow-delay="1s"><a href="#" data-toggle="tooltip" title="Follow Us On Pinterest"><i class="fa fa-pinterest-square"></i></a></li>
        <li class="wow bounceInDown" data-wow-offset="75" data-wow-delay="1.25s"><a href="#" data-toggle="tooltip" title="Follow Us on LinkedIn"><i class="fa fa-linkedin"></i></a></li>
        <li class="wow bounceInUp" data-wow-offset="75" data-wow-delay="1.50s"><a href="#" data-toggle="tooltip" title="Watch Our gallery"><i class="fa fa-flickr"></i></a></li>
        <li class="wow bounceInDown" data-wow-offset="75" data-wow-delay="1.75s"><a href="#" data-toggle="tooltip" title="Google Plus"><i class="fa fa-google-plus"></i></a></li>
        <li class="wow bounceInUp" data-wow-offset="75" data-wow-delay="1.95s"><a href="#" data-toggle="tooltip" title="Instagram"><i class="fa fa-instagram"></i></a></li>
      </ul>
    </div>
</section>

<!--START CONTACT -->
<section id="contact" class="">
  <div class="highlightBox">
    <div class="boxBg page-block-big">
       <div class="container wow fadeIn" data-wow-offset="50" data-wow-delay="1s">
          <div class="row">
             <div class="col-md-10 col-md-offset-2 col-sm-12 contact">
                
                <div class="contactInfo BGlight">
                    <h1>GET IN TOUCH</h1>
                    <div class="upper">
                      <p class="no-border"><i class="fa fa-clock-o"></i> <strong>Monday - Friday:</strong> <br>9:00am - 6:00pm</p>
                      <p><i class="fa fa-phone"></i> <strong>Phone:</strong><br> 310.555.1213</p>
                    </div>
                    <div class="lower">
                      <p><i class="fa fa-map-marker"></i><strong>Address:</strong><br> BERGSGÅRDSGÄRDET 38 ,<br> 424 33 Angered, <br/> Sweden</p>
                    </div>
                </div>
                
                <div class="contactForm">
                  <p>Fill up form below for appointment. All fields are required.</p>
                  <form id="contact_form" method="post" action="form/contact.php">
                    <div class="form-row">
                      <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" />
                    </div>
                    <div class="form-row">
                      <input type="tel" class="form-control" id="phone" name="phone" placeholder="Your Phone" />
                    </div>
                    <div class="form-row">
                      <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" />
                    </div>
                    <div class="form-row">
                      <input type="datetime" class="form-control" value="" id="datetimepicker" name="datetimepicker" placeholder="Preffered Date & Time" />
                    </div>
                    <div class="form-row">
                      <textarea cols="60" rows="3" id="comment" name="comment" class="form-control" placeholder="Write your comment here..."></textarea>
                    </div>
                    <div class="form-row">
                      <input type="text" id="security" name="security" class="form-control hide" value="" />
                      <input type="submit" value="Submit" class="btn btn-dark btn-lg" id="submit" name="submit" />
                    </div>
                  </form>
             </div>
          </div>
        </div>
      </div>
    </div><!-- end row -->
  </div><!-- end container -->
</section>
<!-- END  CONTACT -->
