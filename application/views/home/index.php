<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Xsys</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo base_url();?>asset/materialize/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url();?>asset/materialize/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo base_url();?>asset/font-awesome-4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
<!-- tambahan -->
<!--sweetalert-->
<link rel="stylesheet" href="<?php echo base_url();?>asset/sweetalert/dist/sweetalert.css" media="all">
     <script src="<?php echo base_url();?>asset/sweetalert/dist/sweetalert.min.js"></script>
     
    <!-- uikit -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/uikit/css/uikit.almost-flat.css" media="all">
    <!-- altair admin -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/assets/css/main.css" media="all">    
    <!-- common functions -->
    <script src="<?php echo base_url();?>asset/assets/js/common.min.js"></script>    
    <!-- uikit functions -->
    <script src="<?php echo base_url();?>asset/assets/js/uikit_custom.min.js"></script>
    <script src="<?php echo base_url();?>asset/my_function.js"></script>
    
    
  <style>

  .dropdown-content {
    margin-top: 40px;
}
  .slider{
	  z-index:-1;
	 
  }
.img-slider{
	max-width:100%;
	max-height:100%;
	background-size:contain !important;
  }

nav .brand-logo {
    margin-left: 2%;
}
.menu-center{
	margin-left:35%;
	transition:ease 0.5s;
}
#top-menu{
	position:fixed;
	z-index:999;
}
.log-sign{
	margin-top:-60px;
	float:right;
}

#floating-up {
  display: none;
  position: fixed;
  bottom: 285px;
  right: 30px;
  z-index: 99;
  border: none;
  outline: none;
  background-color: #F00;
  color: white;
  cursor: pointer;
  padding: 15px;
  border-radius: 100%;
  transition:all 0.5s;
  box-shadow: 0px 1px 4px #444444;
}

#floating-up:hover {
  background-color: #C10000;
}
#top-menu{
	transition:ease 0.5s;
}
.logo-img{
	height: 48px !important;
    width: 180px !important;
	transition:ease 0.5s;
}
.logo-img2{
	height: 30px !important;
    width: 110px !important;
	transition:ease 0.5s;
}

  </style>
  
</head>
<body>
  <nav class="green accent-4" role="navigation" id="top-menu">
    <div class="nav-wrapper container">
    
    <a id="logo-container" href="<?php echo base_url();?>" class="brand-logo">
    <img src="<?php echo base_url();?>asset/images/xsys-logo.png" class="logo-img" id="imglogo">
    </a>
      
      <!--for desktop-->
    <ul class="menu-center hide-on-med-and-down">
      <li><a href="<?php echo base_url();?>">Home</a></li>
      <li><a href="badges.html">What new's</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown1">Promo<i class="material-icons right">arrow_drop_down</i></a></li>
            <li><a class="dropdown-button" href="#!" data-activates="dropdown3">Courir<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>
     <!-- end for desktop-->
     
     


		<!-- fro mobile -->
      <ul id="nav-mobile" class="side-nav">
      <li><a href="sass.html">Homme</a></li>
      <li><a href="badges.html">What new's</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown2">discount<i class="material-icons right">arrow_drop_down</i></a></li>
      </ul>
      <!--end for mobile-->
      
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
   
   <!--for dropdown div-->
   <!-- Dropdown Structure 1-->
<ul id="dropdown1" class="dropdown-content">
  <li><a href="#!">one</a></li>
  <li><a href="#!">two</a></li>
  <li class="divider"></li>
  <li><a href="#!">three</a></li>
</ul>

   <!-- Dropdown Structure 2-->
<ul id="dropdown2" class="dropdown-content">
  <li><a href="#!">one</a></li>
  <li><a href="#!">two</a></li>
  <li class="divider"></li>
  <li><a href="#!">three</a></li>
</ul>
   <!-- Dropdown Structure 3-->
<ul id="dropdown3" class="dropdown-content">
  <li><a href="#!">Courir one</a></li>
  <li><a href="#!">Courir two</a></li>
  <li class="divider"></li>
  <li><a href="#!">Courir three</a></li>
</ul>
  <!--end for dropdown div-->
    </div>
    
    
    
    <!--LOGIN AND SIG UP-->
    <div class="log-sign">
    <ul class="right hide-on-med-and-down">
      <li><a href="sass.html">Login</a></li>
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown5">Sign-Up<i class="material-icons right">arrow_drop_down</i></a></li>
    </ul>

   <!-- Dropdown Structure 5-->
<ul id="dropdown5" class="dropdown-content">
  <li><a href="#">My Profile</a></li>
  <li><a href="#">My Profil</a></li>
  <li class="divider"></li>
  <li><a href="#">Logout</a></li>
</ul>
</div>
<!--LOGIN AND SIG UP-->


  </nav>
 
<!--  slider-->
 
 <?php echo $this->load->view('home/slider');?>
 
<!-- end slider-->


  <div class="container" id="container-search">
  
   <!--   widget Section   -->
     <?php echo $this->load->view('home/box-search');?>
    <!--   end widget Section   -->
    
    <br><br>
 </div>
 
 <!--isi kontent body-->
<div class="container">
    <div class="section" id="content-body">

      <!--   Icon Section   -->
      <?php echo $this->load->view($content);?>
     <!-- section end-->

    </div>
    <br><br>
 </div>
<!--end isi kontent body--> 

<!--floating btn up-->
<div class="container">
<button onclick="topFunction()" id="floating-up" title="Scroll-up"><i class="material-icons">expand_less</i></button>
</div>
<!--floating btn up-->

  <footer class="page-footer  green accent-4">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h3 class="white-text">Axys Logistic</h3>
          <p>24 HOUR Customer Service 0804-1500-308</p>
           <p class="grey-text text-lighten-4">We are the lead of cargo and expedition at Indonesian</p>
          <h6>OFFICE</h6>
          <p>Jl.Ringroad Jakarta Blok O 1</p>
          <p>Jakarta Barat</p>
         



        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Info</h5>
          <ul>
            <li><a class="white-text" href="#!"><i class="fa fa-bullhorn"></i>&nbsp; FAQ</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-phone"></i>&nbsp;  Customer Service</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-balance-scale"></i>&nbsp; Term of Condition</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-handshake-o"></i>&nbsp; To be a Partners</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect Us</h5>
          <ul>
            <li><a class="white-text" href="#!"><i class="fa fa-facebook"></i>&nbsp;  Facebook</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-twitter"></i>&nbsp;Twitter</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-instagram"></i>&nbsp; Instagram</a></li>
            <li><a class="white-text" href="#!"><i class="fa fa-envelope"></i>&nbsp; admin@axys.com</a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Copy  Right &copy; <a class="orange-text text-lighten-3" href="http://axys.com">Axys Development</a>
      </div>
    </div>
  </footer>


  <!--  Scripts materialize-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?php echo base_url();?>asset/materialize/js/materialize.js"></script>
  <script src="<?php echo base_url();?>asset/materialize/js/init.js"></script>

<!--altair component -->
    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    
<?php /*?>    <script src="<?php echo base_url();?>asset/bower_components/parsleyjs/dist/parsley.min.js"></script>
    <!-- jquery steps -->
    <script src="<?php echo base_url();?>asset/assets/js/custom/wizard_steps.min.js"></script><?php */?>
    
    
<script>
 $(document).ready(function(){
      $('.slider').slider({
	  	  height: 360,
		  interval:2000,
		  transition:1000
	  }
	  );
	  
	  var logoHeight = $('#myDiv img').height();
    if (logoHeight < 104) {
        var margintop = (104 - logoHeight) / 2;
        $('#myDiv img').css('margin-top', margintop);
    }
	
	
    });
        
	<!--botton scroll up-->
window.onscroll = function() {scrollMenu();scrollFunction()};
	
	function scrollFunction() {
		
		if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
			$("#floating-up").css({"display":"block"});
		} else {
			$("#floating-up").css({"display":"none"});
		}
	}	
	
	function scrollMenu() {
		if (document.body.scrollTop > 60 || document.documentElement.scrollTop > 60) {
			$("#top-menu").css({"height":"46px"});
			$(".menu-center").css({"margin-top":"-8px"});
			$(".log-sign").css({"margin-top":"-45px"});
			$("#imglogo").removeClass('logo-img').addClass('logo-img2');
	
		} else {
			$("#top-menu").css({"height":"66px"});
			$(".menu-center").css({"margin-top":"2px"});
			$(".log-sign").css({"margin-top":"-60px"});
			$("#imglogo").removeClass('logo-img2').addClass('logo-img');
		}
	}	

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
	 $('html,body').animate({scrollTop: 0}, 800);
}
function toContent() {
	 $('html,body').animate({scrollTop: 500}, 800);
}	
</script>
  </body>
</html>
