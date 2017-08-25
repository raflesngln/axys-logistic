<style>
#container-search{
	width:60%;
}
.box-search {
    margin-top: -180px;
    z-index: 999 !important;
    background: rgb(255, 255, 255);
    /*box-shadow: 3px 5px 10px #d0d0d0;*/
	box-shadow:3px 5px 10px rgba(0, 0, 0, 0.12);
	min-height:280px;
}
.devider2{
	display: block;
	position: absolute;
	content: '';
	width: 100px;
	height: 100px;
	z-index:-1;
	left: 50%;
	margin-left: -50px;
	background-color: #FFF; /** Change This Value ***/
	-ms-transform: rotate(45deg);
	-webkit-transform: rotate(45deg);
	transform: rotate(45deg);
	border-radius:20px;

}
.btn-search{
	margin-top:-150px;
}
/*.box-search {
    margin-top: -200px;
    z-index: 999 !important;
    background:rgba(16, 77, 156, 0.88);
    box-shadow: 3px 5px 10px rgba(0, 0, 0, 0.42);
    color: white;
	min-height:370px;
}
*/
@media only screen and (max-width: 768px) {
    /* For mobile phones: */
    .btn-search{
		margin-top:10px;
    }
}

</style>

<div class="col col-md-4 devider2">&nbsp;</div>
<div class="col col-md-4">
<form method="post" action="javascript:void(0);" onsubmit="searchRate()" id="form_search">
<div class="section box-search">
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            
            <h5 class="left">From</h5>
				<p><input name="origin" type="text" placeholder="origin" required="required" ></p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
           
            <h5 class="left">To</h5>

            <p class="light"><input name="destination" type="text" placeholder=" destinaion" required="required"></p>
          </div>
        </div>


        
        
        
      </div>

<div class="row">
      
        <div class="col s12 m4">
          <div class="icon-block">
           
            <h5 class="left">Type of Service</h5>
    <select name="service_type" id="service_type" required>
      <option value="" disabled selected>Choose Service</option>
      <option value="Air Freight">Air Freight</option>
      <option value="Sea Freight">Sea Freight</option>
      <option value="Land">Land </option>
    </select>
    <label>Materialize Select</label>
          </div>
        </div>

<div class="col s12 m4">
<div class="icon-block">
           <h5 class="left">Commodity</h5>
    <select name="commodity" id="commodity" required>
      <option value="" disabled selected>Choose Commodity</option>
      <option value="Air Freight">Dangerous Dood</option>
      <option value="Sea Freight">Ekspedisi</option>
      <option value="Land">Cargo </option>
    </select>
    <label>Materialize Select</label>
</div>
</div>

<div class="col s12 m4">
          <div class="icon-block">
           
            <button type="submit"  class="waves-effect waves-light btn-large green btn-search"> 
         <i class="material-icons md-24">search</i> Search</button>
            
            
          </div>
        </div>
        

                
        
      </div>

      
      
    </div>
    </form>
    <!--buat form-->
    </div>
    
    <script>
	$(document).ready(function(e) {
		  $('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			selectYears: 15, // Creates a dropdown of 15 years to control year,
			today: 'Today',
			clear: 'Clear',
			close: 'Ok',
			closeOnSelect: false // Close upon selecting a date,
		  });
  
  	   $('select').material_select();
    });

function searchRate222(){
          //swal_process();
		  var id='';
          url = '<?php echo base_url();?>home/Home/search_rate';
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_search').serialize(),
            dataType: "JSON",
            success: function(data)
            {
				toContent();
				console.log('sukses');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                //swal("Oops... Something went wrong!", "Proses Invalid!", "error");
				return false;
            }
        });    
}

function searchRate(){
	swal_process();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url('home/Home/search_rate');?>",
				data: $('#form_search').serialize(),
                cache:false,
                success: function(data){
					swal.close();
					$('#content-body').html(data);
					toContent();
                }
            });
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
	</script>