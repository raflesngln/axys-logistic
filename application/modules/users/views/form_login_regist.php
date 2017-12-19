<style>
input[type="text"]{
  color: #353434;
  border: 1px #d8d0d0 solid !important;
  padding: 0px 0px 2px 4px;
  padding-left: 8px !important;
  border-radius: 3px !important;
}
.cek_info{
position: absolute;
    background-color: #ffffff;
    border: 1px #ab9dc5 solid;
    margin-top: -20px;
    width: 96%;
    color: #151211;
    visibility: hidden;
    padding: 5px 0px 5px 19px;
}
.success{
 /* border:1px green solid;*/
 color:green;
}
.wrong{
 /* border:1px red solid;*/
 color:red;
}
.card li{
	list-style:none;
}

.text-error{
	border:1px red solid !important;
	border:inherit;
}
.text-success{
	border:1px red #0C0 !important;
	border:inherit;
}
</style>

<div class="section">
<div class="card ">
<div class="card-content white-text">
      <div class="row">
        <div class="col s12 m5">
          <div class="icon-block">
            <h5 class="left">From</h5>
				    <p><input name="origin" type="text" placeholder="originsss" required="required" ></p>
          </div>
        </div>

        <div class="col s12 m5">
          <div class="icon-block">
            <h5 class="left">To</h5>
            <p class="light"><input name="destination" type="text" placeholder=" destinaion" required="required"></p>
          </div>
        </div>

        <div class="col s12 m12">
        <input name="nama" id="nama" class="nama" type="text" placeholder=" nama" required="required" autocomplete="off" onkeydown="mustconsistof(this);cekvalidnama(this);cek_spasi(this);onlycharacter(this);" onkeypress="cekvalidnama(this);cek_spasi(this);onlycharacter(this);" onkeyup="cekvalidnama(this);cek_spasi(this);onlycharacter(this);" >
        
        <div class="cek_info">
          <!-- content validasi -->
        </div>
      </div>

      <div class="col s12 m12">
        <input name="addr" id="addr" type="text" class="addr" placeholder="addr" required="required" autocomplete="off">
        <div class="cek_info">
            <p>satu</p>
            <p>dua</p>
        </div>
      </div>


        
        
        
      </div>

<div class="row">
  
<div class="col s12 m6">
    <div class="icon-block">
    <button type="submit" class="md-btn md-btn-danger md-btn-mini btn-cari" style="height:70px !important"><i class="material-icons md-24">search</i>&nbsp; Cari Tarif</button>
    </div>
    </div>  
         
     </div>
<!-- end of box search -->
      
 </div>
 </div>  
    </div>




<script>
$(document).ready(function(){
  $( "#nama" ).focus(function() {
	 $("#nama").css("border","1px red solid !important");
	  
	 $('.cek_info').html('');
    var input=$(".nama").val();
      $(this).next(".cek_info").css("visibility","visible");
      $(this).next(".cek_info").append(alertName());

      cekvalidnama(input);
	  cek_spasi(input);
	  //onlycharacter(input);
	  mustconsistof(input);
	  console.log(input.length);
	  
/*	  if($(".one i").html()=='clear' || $(".two i").html()=='clear' || $(".three i").html()=='clear'){
		   $("#nama").addClass('text-success').removeClass('text-error');
	  } else {
		   $("#nama").removeClass('text-error').addClass('text-success');
	  }*/
	  
  });


});


function cek_spasi(input){
	var input=$("#nama").val();
	  if(cek_space(input)==true || input >=1){
		  $(".two").addClass('success').removeClass('wrong');
		  $(".two i").html('done');
	  } else {
		   $(".two").addClass('wrong').removeClass('success');
		   $(".two i").html('clear');
	  }	
}
function cekvalidnama(input){
	//var dta=$(input).val();
	var input=$("#nama").val();
  if(input.length <5){
    $(".one").addClass('wrong').removeClass('success');
	$(".one i").html('clear');
      } else{
    $(".one").addClass('success').removeClass('wrong');
	$(".one i").html('done');
      }
}
function alertName(){
  var text='';
  return text += '<li class="one"><i class="material-icons">done</i> Minimum character 5</li>'
        +'<li class="two"><i class="material-icons">clear</i>No Required Space</li>'
        +'<li class="three"><i class="material-icons">clear</i>Must contain at least one character and number,maximal 30 charcter</li>'
}

function cek_space(word) {
    var str =word;
    var pattern = /\s/g;
    var result = str.match(pattern);
  if(result){
  	return false;
	console.log('salah');
  } else {
  	return true;
	console.log('bagus');
  }

}
function onlycharacter(input){
	var kata=$(input).val();
/*	var re = /^\w+$/g;
	if (!re.test(kata)) {
    //alert('Invalid Text');
    console.log('oke');
    return false;
		} else{
    console.log('no');
    return true;
	}*/
}
function mustconsistof(input){
	//var kata=$(input).val();
	var kata=$("#nama").val();
	//var re=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_]{8,10}$/;
	var re=/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d_]{1,30}$/;
	if (!re.test(kata)) {
		    $(".three").addClass('wrong').removeClass('success');
			$(".three i").html('clear');
    		console.log('NOOO');
    		//return false;
		} else{
		    $(".three").addClass('success').removeClass('wrong');
			$(".three i").html('done');
			console.log('OKKK');
			//return true;
		}
}
</script>