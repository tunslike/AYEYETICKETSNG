
 <div class="push"></div>
  </div>
  <footer class="footer">

<div class="footerDiv">
  <div class="container">
    <div class="footerRow">
        <div class="footerCol">
            <h1>Logo here</h1>
            <p>Your surest plug to selling and buying tickets online, find exicting events and affordable deals online. Get engaged with paid and free events near you.</p>
        </div>
        <div class="footerCol" style="margin-left:8%;">
              <h3>Quick Links</h3>
              <ul>
                  <a href="#"><li>Sell Tickets</li></a>
                  <a href="#"><li>Find Events</li></a>
                  <a href="#"><li>Retrieve Tickets</li></a>
                  <a href="#"><li>Terms and Conditions</li></a>
                  <a href="#"><li>Privacy Policy</li></a>
                  <a href="#"><li>About ayeyetickets.com</li></a>
                </ul>
        </div>
        <div class="footerCol">
            <h3>Contact Us Now</h3>
            <div class="contactUs">
                <h6>HOTLINE NUMBER</h6>
                <h4>0709 9839 890</h4>
            </div>
            <div style="margin-top:-10px;" class="contactUs">
                <h6>EMAIL</h6>
                <h4 style="font-size:18px;">help@ayeyetickets.com</h4>
            </div>
            <div style="margin-top:20px; margin-left:-17px;">
            <p>
                <a href="#"><i class="fab fa-facebook-f socialicons"></i></a>
                <a href="#"><i class="fab fa-twitter socialicons"></i></a>
                <a href="#"><i class="fab fa-instagram socialicons"></i></a>
                <a href="#"><i class="fab fa-youtube socialicons"></i></a>
            </p>
            </div>
        </div>
        <div class="footerCol">
        <h3>HelloTicket Mobile App</h3>
        <p>Coming to your App Stores soon!</p>
        </div>
    </div>
  </div>
</div>
<div class="footerCopyright">
  © <?php echo date("Y"); ?> <span style="color:#ffe400;">Ayeyetickets.com</span>.  All Rights Reserved.
</div>

</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="<?php echo URLROOT; ?>/public/scripts/jquery-ui.min.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="<?php echo URLROOT; ?>/public/scripts/jquery.mousewheel.min.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="<?php echo URLROOT; ?>/public/scripts/jquery.mCustomScrollbar.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="<?php echo URLROOT; ?>/public/scripts/formatCurrency.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.autoplay').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            arrows: false,
        });
    });
</script>
<script>
		(function($){
			$(window).load(function(){
				$("#uploadProdScroller").mCustomScrollbar({
					scrollButtons:{
						enable:true,
					}
				});
			});
		})(jQuery);
	</script>
<script type="text/javascript">
$(document).scroll(function() {
  var y = $(this).scrollTop();
  if (y > 400){
    $('.menuAreaFixed').fadeIn();
  	}else{
    $('.menuAreaFixed').fadeOut();
  }
});
</script>
<script src="<?php echo URLROOT; ?>/public/JS/app.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="<?php echo URLROOT; ?>/public/JS/autocomplete.js?v=<?php echo rand(10000000000,99999999999); ?>"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
  $( function() {
    $( "#startDate" ).datepicker({
      dateFormat: 'dd-M-yy' 
    });

    $( "#endDate" ).datepicker({
      dateFormat: 'dd-M-yy' 
    });
  } );
  </script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  <script>
  $( function() {
    $('#startTime').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    dynamic: false,
    dropdown: true,
    scrollbar: true
});

$('#endTime').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
  } );
  </script>
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.4.0/highlight.min.js"></script>
  <script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script>
  var quill = new Quill('#editor-container', {
    modules: {
      syntax: true,
      toolbar: '#toolbar-container'
    },
    placeholder: 'Enter description about your event...',
    theme: 'snow'
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>
</html>