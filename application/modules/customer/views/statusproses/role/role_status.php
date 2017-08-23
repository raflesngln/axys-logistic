<style></style>

<div class="uk-width-medium-1-1">&nbsp;</div>
<form method="post" action="javascript:void(0);" onsubmit="save_role()" id="form_add_role" enctype="multipart/form-data" data-parsley-validate="">
  <div class="uk-grid">
    <div class="uk-width-medium-3-10">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <select name="idgrup" onchange="load_role_group()" class="md-input" id="idgrup"  required>
            <option value="">Select Group</option>

          </select>
        </div>
        
         
        
      </div>
    </div>
 <div class="uk-width-medium-2-10">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <select name="idstat1" class="md-input" id="idstat1">
            <option value="">Select From</option>
          </select>
        </div>
        
         
        
      </div>
    </div>
<div class="uk-width-medium-2-10">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <select name="idstat2" class="md-input" id="idstat2"  required>
            <option value="">Select To</option>

          </select>
        </div>
        
         
        
      </div>
    </div>
<div class="uk-width-medium-3-10">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <button type="submit"  class="md-btn md-btn-primary"><i class="material-icons md-color-grey-50">add</i> Add</button>
        </div>
        
         
        
      </div>
    </div>   
    
    <div class="uk-width-medium-1-1" id="box-role"> <?php echo $this->load->view('cas/statusproses/role_content');?> </div>
  </div>
</form>

<!-- FORM ADD-->


<script type="text/javascript">
$(document).ready(function(e) {
/*        $(document).on("click", ".idmn", function(e) {
        e.preventDefault();
        $(this).parent().remove();
        x--;
    })*/
	load_group_list();
	$("#aktif").html('list role');
	$("#nonaktif").html('list role');
});	
   
/*  $(".idmn1").on("click", function(e) {
	  var nil=$(this).val();
	  var title=$(this).next('.myid1').val();
	 alert(nil);
/*var text='<li><input type="checkbox" name="idstatus[]" class="idmn" id="'+nil+'" value="'+nil+'"  onclick="pindah1(this)"/><input type="hidden" class="myid2" value="'+nil+'" />'+title+'</li>';
	 // var text='<li><input type="checkbox" name="idstatus[]" class="idmn" id="'+nil+'" value="'+nil+'"  onclick="pindah2(this)"/>'+title+'</li>';
	  $("#aktif").append(text);
        e.preventDefault();
        $(this).parent().remove();
        x--;
   })*/

	



function update_role(){	
		swal_process();
		//var nm_vendor=$("#nm_vendor").val();
		var formData = new FormData($("#form_new_group")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('cas/Statusproses/update_role')?>",
            type: "POST",
            data:formData,// $('#form_add_vendor').serialize(),
            dataType: "JSON",
			//for iput file
			cache: false,
			processData: false,
      		contentType: false,
            success: function(data)
            {		
				   swal.close();
			   	   var modal = UIkit.modal("#modal_add");
   	   			   modal.hide();
				   				   
				   UIkit.modal.alert('<i class="fa fa-check"></i> User  Success Saved !');
               	   status_view();
				   /* reset input and tabel */
				  
				   $('#form_new_group')[0].reset();	
				   			    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });
		
    }
function load_group_list(){
	var id=id;
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('user/User/load_group_list')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
			   load_status_combo();
			   
                    $("#idgrup").empty();
                   $("#idgrup").append("<option value=''>Select Group.....</option>");
                     for (var i =0; i<data.length; i++){
                   var option = "<option value='"+data[i].Id+"'>"+data[i].GroupName+"</option>";
                          $("#idgrup").append(option);
                       }
  
               }
       }); 
 }	
function load_status_combo(){
	var id=id;
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('cas/Statusproses/load_status_combo')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
                    $("#idstat1").empty();
					$("#idstat2").empty();
                   $("#idstat1").append("<option value=''>Select From.....</option>");
				   $("#idstat2").append("<option value=''>Select to.....</option>");
                     for (var i =0; i<data.length; i++){
                   var option = "<option value='"+data[i].Noid+"'>"+data[i].CodeStatus+" - "+data[i].Keterangan+"</option>";
                          $("#idstat1").append(option);
						  $("#idstat2").append(option);
                       }
  
               }
       }); 
 }	
 

 function save_role(){	
		swal_process();
		var idstat1=$("#idstat1").val();
		var idstat2=$("#idstat2").val();
	if(idstat1==idstat2 || idstat1 =='' || idstat2 ==''){
		swal.close();   
		UIkit.modal.alert('<i class="material-icons">info</i> Role must complete and cannot same status!');
	} else {
		var formData = new FormData($("#form_add_role")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('cas/Statusproses/save_role')?>",
            type: "POST",
            data:formData,// $('#form_add_vendor').serialize(),
            dataType: "JSON",
			//for iput file
			cache: false,
			processData: false,
      		contentType: false,
            success: function(data)
            {		
				   swal.close();   
				   UIkit.modal.alert('<i class="fa fa-check"></i> Role  Success Saved !');
				   load_role_group();
				   /* reset input and tabel */
				   //$('#form_add_role')[0].reset();	
				   			    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                   swal.close();   
				   UIkit.modal.alert('<i class="fa fa-check"></i> Role has Inserted !');
            }
        });
	}
}
function delete_role(id){
	swal_process();
	//localStorage.setItem('statusView','grid');
 var idrole=id;
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('cas/Statusproses/delete_role'); ?>",
                data: "idrole="+idrole,
                success: function(data){
					swal.close();
					load_role_group();
                }
            }); 
}

function load_role_group(){
	//swal_process();
	//localStorage.setItem('statusView','grid');
	var idgrup=$("#idgrup").val();
	if(idgrup==''){
			$("#aktif").html('list role');
			$("#nonaktif").html('list role');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('cas/Statusproses/load_role_group'); ?>",
                data: "idgrup="+idgrup,
                success: function(data){
					swal.close();
					$("#box-role").html(data);
					load_group_name();
                }
            });  
	}
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
