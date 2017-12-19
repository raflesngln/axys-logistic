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
<!--Nprogress bar on top-->
<link href='<?php echo base_url();?>asset/nprogress/nprogress.css' rel='stylesheet' />
<script src='<?php echo base_url();?>asset/nprogress/nprogress.js'></script>

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

/* TAMBAHAN    */
input[type="text"]{
  color: #353434;
  padding: 0px 0px 2px 4px;
  padding-left: 8px !important;
  border-radius: 3px !important;
  border-bottom:2px #CCC solid;
}
.mobile-apps li{
	float:left;
}
.modal.modal-fixed-footer {
    padding: 0;
}
.modal{
	box-shadow: 4px 9px 22px #333;
}
.modal-header{
	background:#673AB7;
	color:#FFF;
}
#modal1,#modal2{
	width:45%;
}
#modal1{
    padding: 0;
	min-height:77%;
	margin-top:-3%;
}
#modal2{
	max-height:100% !important;
	min-height:96%;
	margin-top:-4% !important;
}
.modal .modal-content {
    padding: 7px !important;
}

.btn-block{
	width:99% !important;
}
.cek_info{
	position: absolute;
	background-color: #ffffff;
	margin-top: -20px;
	width: 100%;
	min-height: 90px;
	z-index: 999;
	color: #151211;
	visibility: hidden;
	padding: 5px 0px 5px 19px;
	left: -2px;
	box-shadow:2px 5px 15px #999;
	border-radius:2px;
}

.cek_info li{
	list-style:none;
	line-height:30px;
}

.text-error{
	border:1px red solid !important;
	border:inherit;
}
.text-success{
	border:1px red #0C0 !important;
	border:inherit;
}
.error{
	border-bottom:2px red solid !important;
	color:red;
}
.success{
	border-bottom:2px green solid !important;
	color:green;
}
.txt-error{
	color:red;
}
.txt-success{
	color:green;
}
.togglepass:hover{
	color:blue;
	cursor:pointer;
}
  </style>
  
</head>
<body>
  <nav class="teal" role="navigation" id="top-menu">
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
      <li><a href="sass.html">Home</a></li>
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
  <li><a href="<?php echo base_url();?>">Courir three</a></li>
</ul>
  <!--end for dropdown div-->
    </div>
    
    
    
    <!--LOGIN AND SIG UP-->
    <div class="log-sign">
    <ul class="right hide-on-med-and-down">
    <a class="waves-effect waves-light modal-trigger" href="#modal1">LOGIN</a>

     
      <!-- Dropdown Trigger -->
      <li><a class="dropdown-button" href="#!" data-activates="dropdown5">Hello world<i class="material-icons right">arrow_drop_down</i></a></li>
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
 
 <?php
 if(isset($slider)){
  echo $this->load->view($slider);
 }
  ?>
 
<!-- end slider-->


  <div class="container" id="container-search">
  
   <!--   widget Section   -->
     <?php
	 if(isset($boxsearch)){
	  echo $this->load->view($boxsearch);
	 }
	  ?>
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

  <footer class="page-footer  teal darken-2">
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
        
<div class="col l5 s12 mobile-apps">
          <h2 class="white-text" style="margin-top:20px; margin-bottom:-10px">Download Application:</h2>
          <ul>
      <li><a class="white-text" href="#!">
      <img src="<?php echo base_url();?>asset/images/googleplay.png" style="height:70px; width:150px">
      </a></li>
            <li><a class="white-text" href="#!">
      <img src="<?php echo base_url();?>asset/images/appstore.png" style="height:50px; width:150px; margin-top:10px">
      </a></li>
      
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


<!-- MODAL -->
  <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
          
          <div class="modal-header">
          <button class="modal-close btn-flat" style="position:absolute;top:0;right:0;">X</button>
           <h4 align="center" style="padding:6px">REGISTER OR LOGIN</h4>
            <div class="divider"></div>
          </div>

<div class="modal-content">            
<div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input name="username" type="text" class="validate" id="first_name" placeholder="Username">
          <label for="first_name" class="active">User Name</label>
        </div>
        <div class="input-field col s12">
          <input name="password" type="text" class="validate" id="first_name" placeholder="Password">
          <label for="first_name" class="active">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <a class="waves-effect btn-large btn-block #d32f2f red darken-2"><i class="material-icons ">input</i> Login</a>
        </div>
<div class="input-field col s12">
          <a class="waves-effect btn-large btn-block #1565c0 blue darken-3 waves-effect waves-light modal-trigger" onClick="showmodal2()"><i class="material-icons ">assignment_ind</i> Register</a>
          
          <p style="float:right">Forgot Password? <a href="#">Click Here !</a></p>
        </div>
      </div>
      
      
      
    </form>
  </div>
                
      </div>
            
            
          </div>
          
        </div>
<!-- END OF MODAL -->
<div id="modal2" class="modal modal-fixed-footer">
          
          <div class="modal-header">
<button class="modal-close btn-flat" style="position:absolute;top:0;right:0;">X</button>
           <h4 align="center" style="padding:6px">REGISTER USER</h4>
            <div class="divider"></div>
          </div>

<div class="modal-content">            
<div class="row">
 <form method="post" action="javascript:void(0);" onsubmit="save_user()" id="form_register" enctype="multipart/form-data" data-parsley-validate="">
      <div class="row">
        <div class="input-field col s6">
          <input name="txtfirstname" type="text" class="validate txtfirstname" id="txtfirstname" onKeyDown="valid_firstname(this)" onKeyUp="valid_firstname(this)">
          <label for="first_name" class="active">Firstname</label>
              <div class="cek_info info_first">
              <li class="first_one"><i class="material-icons">clear</i> Only alphabet and number</li>
              <li class="first_two"><i class="material-icons">clear</i> Minimum character 5</li>
                        <!-- content validasi -->
            </div>
        </div>
        <div class="input-field col s6">
          <input name="txtlastname" type="text" class="validate" id="txtlastname" placeholder="Lastname" onKeyDown="valid_lastname(this)" onKeyUp="valid_lastname(this)">
          <label for="first_name" class="active">Lastname</label>
              <div class="cek_info info_last">
              <li class="last_one"><i class="material-icons">clear</i> Only alphabet and number</li>
              <li class="last_two"><i class="material-icons">clear</i> Minimum character 5</li>
                        <!-- content validasi -->
            </div>
        </div>

<div class="input-field col s12">
          <input name="txtemail" type="text" class="validate" id="txtemail" placeholder="Email" onKeyDown="valid_email(this)" onKeyUp="valid_email(this)">
          <label for="first_name" class="active">Email</label>
              <div class="cek_info email">
              <li class="email_one"><i class="material-icons">clear</i> Validate Format email</li>
                        <!-- content validasi -->
            </div>
        </div>
<div class="input-field col s12">
          <input name="txtusername" type="text" class="validate" id="txtusername" placeholder="Username" onKeyDown="valid_username(this)" onKeyUp="valid_username(this)">
          <label for="first_name" class="active">Username</label>
<div class="cek_info info_username">
              <li class="username_one"><i class="material-icons">clear</i> Maksimal 5 character</li>
              <li class="username_two"><i class="material-icons">clear</i> No Required Space</li>
              <li class="username_three"><i class="material-icons">clear</i> Must contain at least one character and number max 30</li>
                        <!-- content validasi -->
            </div>
            
        </div>

<div class="input-field col s5">

          <input name="txtpassword" type="password" class="validate" id="txtpassword" placeholder="Password" onKeyDown="valid_password(this)" onKeyUp="valid_password(this)" autocomplete="off">
          <label for="first_name" class="active">Password</label>
<div class="cek_info info_pass">
              <li class="pass_one"><i class="material-icons">clear</i> Minimum 5 character</li>
			  <li class="pass_two"><i class="material-icons">clear</i> No space required</li>
              <li class="pass_three"><i class="material-icons">clear</i> Must contain at least one Alphabet and number</li>
                        <!-- content validasi -->
            </div>
            
        </div>
<div class="input-field col s5">
          <input name="txtpassword2" type="password" class="validate" id="txtpassword2" placeholder="Retype Password"  autocomplete="off"  onKeyDown="valid_password2(this)" onKeyUp="valid_password2(this)">
          <label for="first_name" class="active">Retype Password</label>
          
          <div class="cek_info info_pass2">
              <li class="pass2_one"><i class="material-icons">clear</i> Password match Above</li>
                        <!-- content validasi -->
            </div>
        </div> 
<div class="input-field col s1"><span class="icon-txt" style="float:right"><i class="material-icons md-24 togglepass" onClick="togglepass()">remove_red_eye</i></span></div>

<!-- for capctha -->        
<div class="input-field col s5">
<?php
    $site_key = '6Lf2BC0UAAAAAHyE392Tif6AFzThAu2z2th3DDY8';
?>
<div class="g-recaptcha" hl="id" data-theme="light"  data-sitekey="<?php echo $site_key; ?>"></div>
</div>
        
                      
      </div>
      <div class="row">
<div class="input-field col s12">
        
<button id="btn-save" type="submit" class="waves-effect btn-large btn-block #1565c0 blue darken-3">
  <i class="material-icons ">assignment_ind</i> Register                                       
</button>
<p style="float:right">You have an Account ? <a href="#" onClick="showLogin()">Login Here !</a></p>
        </div>
      </div>
      
      
      
    </form>
  </div>
                
      </div>
            
            
          </div>

  <!--  Scripts materialize-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="<?php echo base_url();?>asset/materialize/js/materialize.js"></script>
  <script src="<?php echo base_url();?>asset/materialize/js/init.js"></script>
      <!-- Memuat API Google reCaptcha -->
    <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
    <script src="https://www.google.com/recaptcha/api.js?hl=id" async defer></script>

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
	 document.getElementById("btn-save").disabled = true;
	 <!-- MODAL -->
    $('.modal').modal();
	//$('#modal1').modal('open');
<!-- MODAL -->

$("#txtfirstname").focus(function() {
	// $('.cek_info').html('');
     // var input=$(".nama").val();
      $(".info_first").css("visibility","visible");
	  if(less_than(this)==true){
		  $(".first_two").addClass('txt-success').removeClass('txt-error');
		  $(".first_two i").html('done');
	  } else {
		  $(".first_two").addClass('txt-error').removeClass('txt-success');
		  $(".first_two i").html('clear');
	  }
	  
	  if(onlycharacter(this)==true){
		  $(".first_one").addClass('txt-success').removeClass('txt-error');
		  $(".first_one i").html('done');
		  //console.log('OKE');
	  } else {
		  $(".first_one").addClass('txt-error').removeClass('txt-success');
		  $(".first_one i").html('clear');
		  //console.log('NO');
	  }
});

$("#txtfirstname").focusout(function() {
	check_all_data_error();
      $(".info_first").css("visibility","hidden");
	  if($(".first_one i").html()=='clear' || $(".first_two i").html()=='clear'){
			$("#txtfirstname").addClass('error').removeClass('success');
	  } else {
		  $("#txtfirstname").addClass('success').removeClass('error');
	  }
});

$("#txtlastname").focus(function() {
      $(".info_last").css("visibility","visible");
	  if(less_than(this)==true){
		  $(".last_two").addClass('txt-success').removeClass('txt-error');
		  $(".last_two i").html('done');
	  } else {
		  $(".last_two").addClass('txt-error').removeClass('txt-success');
		  $(".last_two i").html('clear');
	  }
	  
	  if(onlycharacter(this)==true){
		  $(".last_one").addClass('txt-success').removeClass('txt-error');
		  $(".last_one i").html('done');
		  //console.log('OKE');
	  } else {
		  $(".last_one").addClass('txt-error').removeClass('txt-success');
		  $(".last_one i").html('clear');
		  //console.log('NO');
	  }
});

$("#txtlastname").focusout(function() {
	check_all_data_error();
      $(".info_last").css("visibility","hidden");
	  if($(".last_one i").html()=='clear' || $(".last_two i").html()=='clear'){
			$("#txtlastname").addClass('error').removeClass('success');
	  } else {
		  $("#txtlastname").addClass('success').removeClass('error');
	  }
});

$("#txtemail").focus(function() {
      $(".email").css("visibility","visible");
	  if(validEmail(this)==false){
		  $(".email_one").addClass('txt-error').removeClass('txt-success');
		  $(".email_one i").html('clear');
	  } else {
		  $(".email_one").addClass('txt-success').removeClass('txt-error');
		  $(".email_one i").html('done');
	  }
});

$("#txtemail").focusout(function() {
	check_all_data_error();
      $(".email").css("visibility","hidden");
	  if($(".email_one i").html()=='clear'){
			$("#txtemail").addClass('error').removeClass('success');
	  } else {
		  $("#txtemail").addClass('success').removeClass('error');
	  }
});

$("#txtusername").focus(function() {
      $(".info_username").css("visibility","visible");
	  if(less_than(this)==true){
		  $(".username_one").addClass('txt-success').removeClass('txt-error');
		  $(".username_one i").html('done');
	  } else {
		  $(".username_one").addClass('txt-error').removeClass('txt-success');
		  $(".username_one i").html('clear');
	  }
	  if(no_space(this)==true){
		  $(".username_two").addClass('txt-success').removeClass('txt-error');
		  $(".username_two i").html('done');
	  } else {
		   $(".username_two").addClass('txt-error').removeClass('txt-success');
		   $(".username_two i").html('clear');
	  }
	 if(mustconsistof(this)==true){
		  $(".username_three").addClass('txt-success').removeClass('txt-error');
		  $(".username_three i").html('done');
	  } else {
		   $(".username_three").addClass('txt-error').removeClass('txt-success');
		   $(".username_three i").html('clear');
	  }
	  
});

$("#txtusername").focusout(function() {
	check_all_data_error();
      $(".info_username").css("visibility","hidden");
	  if($(".username_one i").html()=='clear' || $(".username_two i").html()=='clear' || $(".username_three i").html()=='clear'){
			$("#txtusername").addClass('error').removeClass('success');
	  } else {
		  $("#txtusername").addClass('success').removeClass('error');
	  }
});

$("#txtpassword").focus(function() {
      $(".info_pass").css("visibility","visible");
	  if(less_than(this)==true){
		  $(".pass_one").addClass('txt-success').removeClass('txt-error');
		  $(".pass_one i").html('done');
	  } else {
		  $(".pass_one").addClass('txt-error').removeClass('txt-success');
		  $(".pass_one i").html('clear');
	  }
	  if(no_space(this)==true){
		  $(".pass_two").addClass('txt-success').removeClass('txt-error');
		  $(".pass_two i").html('done');
	  } else {
		   $(".pass_two").addClass('txt-error').removeClass('txt-success');
		   $(".pass_two i").html('clear');
	  }
	 if(mustconsistof(this)==true){
		  $(".pass_three").addClass('txt-success').removeClass('txt-error');
		  $(".pass_three i").html('done');
	  } else {
		   $(".pass_three").addClass('txt-error').removeClass('txt-success');
		   $(".pass_three i").html('clear');
	  }
	  
});

$("#txtpassword").focusout(function() {
	check_all_data_error();
      $(".info_pass").css("visibility","hidden");
	  if($(".pass_one i").html()=='clear' || $(".pass_two i").html()=='clear' || $(".pass_three i").html()=='clear'){
			$("#txtpassword").addClass('error').removeClass('success');
	  } else {
		  $("#txtpassword").addClass('success').removeClass('error');
	  }
});

$("#txtpassword2").focus(function() {
      $(".info_pass2").css("visibility","visible");
	 
	  if(valid_password2(this)==true){
		  $(".pass2_one").addClass('txt-success').removeClass('txt-error');
		  $(".pass2_one i").html('done');
	  } else {
		  $(".pass2_one").addClass('txt-error').removeClass('txt-success');
		  $(".pass2_one i").html('clear');
	  }
	  
});

$("#txtpassword2").focusout(function() {
	check_all_data_error();
      $(".info_pass2").css("visibility","hidden");
	  
	  if(valid_password2(this)==true){
			$("#txtpassword2").addClass('success').removeClass('error');
	  } else {
		  $("#txtpassword2").addClass('error').removeClass('success');
	  }
});
/* ===========VALIDASI  =========================*/
	 //setting slides
      $('.slider').slider({
	  	  height: 460,
		  interval:2000,
		  transition:1000
	  });
	  
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

    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
	
	
	/*================== for validate input=============================  */
	
function valid_firstname(input){
	check_all_data_error();
	//var kata=$("#first_name").val();
	  if(less_than(input)==true){
		  $(".first_two").addClass('txt-success').removeClass('txt-error');
		  $(".first_two i").html('done');
	  } else {
		  $(".first_two").addClass('txt-error').removeClass('txt-success');
		  $(".first_two i").html('clear');
	  }
	  if(onlycharacter(input)==true){
		  $(".first_one").addClass('txt-success').removeClass('txt-error');
		  $(".first_one i").html('done');
		  //console.log('OKE');
	  } else {
		  $(".first_one").addClass('txt-error').removeClass('txt-success');
		  $(".first_one i").html('clear');
		  //console.log('NO');
	  }
}
function valid_lastname(input){
	check_all_data_error();
	//var kata=$("#first_name").val();
	  if(less_than(input)==true){
		  $(".last_two").addClass('txt-success').removeClass('txt-error');
		  $(".last_two i").html('done');
	  } else {
		  $(".last_two").addClass('txt-error').removeClass('txt-success');
		  $(".last_two i").html('clear');
	  }
	  if(onlycharacter(input)==true){
		  $(".last_one").addClass('txt-success').removeClass('txt-error');
		  $(".last_one i").html('done');
		  //console.log('OKE');
	  } else {
		  $(".last_one").addClass('txt-error').removeClass('txt-success');
		  $(".last_one i").html('clear');
		  //console.log('NO');
	  }
}
function valid_email(input){
	check_all_data_error();
	//var kata=$("#first_name").val();
	  if(validEmail(input)==true){
		  $(".email_one").addClass('txt-success').removeClass('txt-error');
		  $(".email_one i").html('done');
	  } else {
		  $(".email_one").addClass('txt-error').removeClass('txt-success');
		  $(".email_one i").html('clear');
	  }
}
function valid_username(input){
	check_all_data_error();
	//var kata=$(input).val();
	  if(less_than(input)==true){
		  $(".username_one").addClass('txt-success').removeClass('txt-error');
		  $(".username_one i").html('done');
	  } else {
		  $(".username_one").addClass('txt-error').removeClass('txt-success');
		  $(".username_one i").html('clear');
	  }
	  if(no_space(input)==true){
		  $(".username_two").addClass('txt-success').removeClass('txt-error');
		  $(".username_two i").html('done');
	  } else {
		   $(".username_two").addClass('txt-error').removeClass('txt-success');
		   $(".username_two i").html('clear');
	  }
	  if(mustconsistof(input)==true){
		  $(".username_three").addClass('txt-success').removeClass('txt-error');
		  $(".username_three i").html('done');
	  } else {
		   $(".username_three").addClass('txt-error').removeClass('txt-success');
		   $(".username_three i").html('clear');
	  }
}
function valid_password(input){
	check_all_data_error();
	//var kata=$(input).val();
		  if(less_than(input)==true){
		  $(".pass_one").addClass('txt-success').removeClass('txt-error');
		  $(".pass_one i").html('done');
	  } else {
		  $(".pass_one").addClass('txt-error').removeClass('txt-success');
		  $(".pass_one i").html('clear');
	  }
	  if(no_space(input)==true){
		  $(".pass_two").addClass('txt-success').removeClass('txt-error');
		  $(".pass_two i").html('done');
	  } else {
		   $(".pass_two").addClass('txt-error').removeClass('txt-success');
		   $(".pass_two i").html('clear');
	  }
	 if(mustconsistof(input)==true){
		  $(".pass_three").addClass('txt-success').removeClass('txt-error');
		  $(".pass_three i").html('done');
	  } else {
		   $(".pass_three").addClass('txt-error').removeClass('txt-success');
		   $(".pass_three i").html('clear');
	  }
	  if($("#txtpassword").val() == $("#txtpassword2").val()){
		  	$("#txtpassword2").addClass('success').removeClass('error');
			$(".pass2_one").addClass('txt-success').removeClass('txt-error');
			$(".pass2_one i").html('done');  
	  } else {
		  	$("#txtpassword2").addClass('error').removeClass('success');
			$(".pass2_one").addClass('txt-error').removeClass('txt-success');
			$(".pass2_one i").html('clear');
	  }
}
function valid_password2(input){
	check_all_data_error();
	var pass2=$(input).val();
	var pass=$("#txtpassword").val();
	if(pass2==pass){
		$(".pass2_one").addClass('txt-success').removeClass('txt-error');
		$(".pass2_one i").html('done');
		return true;
	} else {
		$(".pass2_one").addClass('txt-error').removeClass('txt-success');
		$(".pass2_one i").html('clear');
		return false;
	}
	  
}
/* FUNGSI2 */
function no_space(word) {
	var str=$(word).val();
    var pattern = /\s/g;
    var result = str.match(pattern);
  if(result){
  	return false;
  } else {
  	return true;
  }

}

function validEmail(input){      
	var elementValue=$(input).val();
   var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
   if(!emailPattern.test(elementValue)){
   		return false;
    } else {
   		return true;
    }
 } 
function onlycharacter(input){
	var kata=$(input).val();
	//first_one
	var re = /^\w+$/g;
	if (!re.test(kata)) {
    		//alert('Invalid Text');
    		//console.log('NO');
    		return false;
		} else{
    	//console.log('OKE');
    	return true;
	}
}
function less_than(input){
	var kata=$(input).val();
	if(kata.length <=4 ){
		return false;
	} else {
		return true;
	}
}
function mustconsistof(input){
	var kata=$(input).val();
	var re=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_]{0,30}$/;
	if (!re.test(kata)) {
		    return false;
		} else{
			return true;
		}
}

function togglepass(){
	//var pass=$("#txtpassword2").attr('id');
	 var pass = document.getElementById("txtpassword");
	 var repass = document.getElementById("txtpassword2");
	if(pass.type === "password" || repass.type === "password") {
        pass.type = "text";
		repass.type = "text";
    } else {
        pass.type = "password";
		repass.type = "password";
    }
}
function check_all_data_error(){
	var hitung_error=0;
	//var input=$(".cek_info li i").html();
	
	$('.cek_info li i').each(function(){
		  if($(this).html()=='clear'){
			hitung_error++;
		  } 
	  });
    if(hitung_error >=1){
		document.getElementById("btn-save").disabled = true;
        //alert('ada error');
		return false;
      } else {
		  document.getElementById("btn-save").disabled = false;
          //alert('ga ada error');
		  return true;
      }

}

 function save_user(){	
 		if(check_all_data_error()==true){
			//swal_process();
		var formData = new FormData($("#form_register")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('users/User/save_user')?>",
            type: "POST",
            data:formData,// $('#form_add_vendor').serialize(),
            dataType: "JSON",
			//for iput file
			cache: false,
			processData: false,
      		contentType: false,
            success: function(data)
            {		
				   //swal.close();
				   swal("Saved data!", "Please open your email for activation!", "success");
				   $("#modal2").modal('close');
				   //$('#form_register')[0].reset();		    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });
		
		} else {
			alert('Please Complete your input form correctly !');
		}
	
    }
function showmodal2(){
	$("#modal2").modal('open');
	$("#modal1").modal('close');
}
function showLogin(){
	$("#modal2").modal('close');
	$("#modal1").modal('open');
}
function swal_process(){
	swal({
		title:'<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewBox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"></circle></svg></div>',
		text:'<p>Loading Content.......</p>',
		showConfirmButton:false,
		//type:"success",
		html:true
		});
}
function confirmSave(){
	 swal({
        title: "Sure your data correct?",
        text: "Confirmation for data input ",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function (isConfirm) {
        if (isConfirm) {
          swal("Saved !", "Please open your email for activation", "success");
        } else {
          swal("Cancelled", "Please complete your data !", "error");
        }
      });
	
}
</script>
  </body>
</html>
