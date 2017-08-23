<style></style>

<div class="uk-width-medium-1-1">&nbsp;</div>
<form method="post" action="<?php echo base_url();?>cas/Statusproses/update_role"  id="form_role" enctype="multipart/form-data" data-parsley-validate="">
  <div class="uk-grid">
    <div class="uk-width-medium-1-3">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <select name="idgrup2" class="md-input" id="idgrup2" onchange="load_role_abjad()" required>
            <option value="">Select User</option>
      
            <option value=""></option>
            
          </select>
          <label for="aa"></label>
        </div>
        
        <!--<div class="uk-width-medium-1-1">
<div class="uk-form-row">
                       <label>Type Clearance</label>
                        <select id="uty_clearance" name="uty_clearance" required>
                              <option value=" asasss">sassasas</option>
                        </select>
                     </div>
</div>--> 
        
      </div>
    </div>
    <div class="uk-width-medium-1-1" id="box-jobs"> <?php echo $this->load->view('master/team/role_abjad/role_content');?> </div>
  </div>
</form>

<script>
$(document).ready(function(e) {
/*        $(document).on("click", ".idmn", function(e) {
        e.preventDefault();
        $(this).parent().remove();
        x--;
    })*/
	load_group_list2();
	$("#aktif2").html('list role');
	$("#nonaktif2").html('list role');
});	

function load_role_abjad(){
	swal_process();
	//localStorage.setItem('statusView','grid');
	var idgrup=$("#idgrup2").val();
	if(idgrup==''){
			$("#aktif2").html('list role');
			$("#nonaktif2").html('list role');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('master/team/load_role_abjad'); ?>",
                data: "idgrup="+idgrup,
                success: function(data){
					swal.close();
					$("#box-jobs").html(data);
                }
            });  
	}
}
function pindah3(idno){
	var idno=$(idno).attr('id');
	swal_process();
	var idgrup=$("#idgrup2").val();
		if(idgrup==''){
		UIkit.modal.alert('<i class="material-icons md-24 md-color-red-A700">highlight_off</i> Please Choose Group !');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('master/team/add_digit'); ?>",
				data: "idno="+idno+"&idgrup="+idgrup,
                success: function(data){
					swal.close();
					//$("#box-role").html(data);
					load_role_abjad();
					UIkit.notify({
						message : '<i class="fa fa-user"></i> Role has Added !',
						status  : 'success',
						timeout : 2000,
						pos     : 'top-center'
						});
                }
            });  
	}
}
function pindah4(idno){
	var idno=$(idno).attr('id');
	swal_process();
	var idgrup=$("#idgrup2").val();
	if(idgrup==''){
		UIkit.modal.alert('<i class="material-icons md-24 md-color-red-A700">highlight_off</i> Please Choose Group !');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('master/team/remove_digit'); ?>",
                data: "idno="+idno,
				data: "idno="+idno+"&idgrup="+idgrup,
                success: function(data){
					swal.close();
					//$("#box-role").html(data);
					//alert(idgrup);
					load_role_abjad();
					UIkit.notify({
						message : 'Role Removed !',
						status  : 'warning',
						timeout : 2000,
						pos     : 'top-center'
						});
                }
            });  
	}
}	

function load_group_list2(){
	var id=id;
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('master/team/load_group_list')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
                    $("#idgrup2").empty();
                   $("#idgrup2").append("<option value=''>Select Team.....</option>");
                     for (var i =0; i<data.length; i++){
                   var option = "<option value='"+data[i].Id_team+"'>"+data[i].nm_team+"</option>";
                          $("#idgrup2").append(option);
                       }
               }
       }); 
 }	
</script>