<style>
#container-search{
	width:60%;
}
.box-search {
    margin-top: -210px;
    z-index: 999 !important;
    background: rgb(255, 255, 255);
    /*box-shadow: 3px 5px 10px #d0d0d0;*/
	box-shadow:3px 5px 10px rgba(0, 0, 0, 0.12);
	min-height:400px;
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
<div class="section box-search">
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            
            <h5 class="left">From</h5>
				<p><input name="origin" type="text" placeholder="origin" ></p>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
           
            <h5 class="left">To</h5>

            <p class="light"><input name="destination" type="text" placeholder=" destinaion"></p>
          </div>
        </div>


        
        
        
      </div>

<div class="row">
      
        <div class="col s12 m8">
          <div class="icon-block">
           
            <h5 class="left">Type of Service</h5>
    <select>
      <option value="" disabled selected>Choose Service</option>
      <option value="1">Air Freight</option>
      <option value="2">Sea Freight</option>
      <option value="3">Land </option>
    </select>
    <label>Materialize Select</label>
          </div>
        </div>

<div class="col s12 m4">
          <div class="icon-block">
           
            <a class="waves-effect waves-light btn-large green btn-search"> 
         <i class="material-icons md-24">search</i> Search</a>
            
            
          </div>
        </div>
        

                
        
      </div>

      
      
    </div>
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
	</script>