<style></style>

<div class="uk-width-medium-1-1">&nbsp;</div>
<form method="post" action="<?php echo base_url();?>cas/Statusproses/update_role"  id="form_role" enctype="multipart/form-data" data-parsley-validate="">
  <div class="uk-grid">
    <div class="uk-width-medium-1-3">
      <div class="uk-grid" data-uk-grid-margin="">
        <div class="uk-width-medium-1-1">
          <select name="idgrup" class="md-input" id="idgrup" onchange="load_role_group()" required>
            <option value="">Select Group</option>
            <?php 
 foreach($group as $grp){
	 ?>
            <option value="<?php echo $grp->Id?>"><?php echo $grp->GroupName?></option>
            <?php } ?>
          </select>
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
    <div class="uk-width-medium-1-1" id="box-role"> <?php echo $this->load->view('cas/statusproses/role_content');?> </div>
  </div>
</form>

<!-- FORM ADD-->

<form method="post" action="javascript:void(0);" onsubmit="save_new_group()" id="form_new_group" enctype="multipart/form-data" data-parsley-validate="">
  <div id="modal_add" class="uk-modal">
    <div class="uk-modal-dialog uk-modal-dialog-small">
      <button type="button" class="uk-modal-close uk-close"></button>
      <div class="uk-modal-header">
        <h3 class="uk-modal-title title_status">Title status</h3>
      </div>
      
      <!-- header title -->
      <div class="md-card-content">
        <div class="uk-grid" data-uk-grid-margin>
          <div class="uk-width-medium-1-2">
            <label>Group Name</label>
            <input name="groupname" type="text" class="md-input" id="groupname" required="required" value=" " />
            <span class="md-input-wrapper md-input-filled">
            <input type="hidden" name="idd" id="idd" />
            </span></div>
          
          <!--                        <div class="uk-width-medium-1-3">
                            <label>Password</label>
                            <input name="Password" type="password" class="md-input" id="Password" value="" />
                        </div>--> 
        </div>
      </div>
      <!-- end ofheader title --> 
      <!-- FOOTER -->
      <div class="uk-grid">
        <div class="uk-width-medium-1-1">
          <div class="uk-modal-footer uk-text-right">
            <button type="button" class="md-btn md-btn-flat uk-modal-close md-btn-danger"><i class="material-icons">close</i> Close</button>
            <button type="submit" class="md-btn md-btn-primary md-btn-wave-light"> <span class="btn-save">Save Status</span> </button>
          </div>
        </div>
      </div>
      <!-- END OF FOOTER --> 
      
    </div>
  </div>
</form>
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

function pindah1(idstatus){
	var idstatus=$(idstatus).attr('id');
	//swal_process();
	var idgrup=$("#idgrup").val();
		if(idgrup==''){
		UIkit.modal.alert('<i class="material-icons md-24 md-color-red-A700">highlight_off</i> Please Choose Group !');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('cas/Statusproses/add_role'); ?>",
                data: "idstatus="+idstatus,
				data: "idstatus="+idstatus+"&idgrup="+idgrup,
                success: function(data){
					//swal.close();
					//$("#box-role").html(data);
					load_role_group();
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
function pindah2(idstatus){
	var idstatus=$(idstatus).attr('id');
	//swal_process();
	var idgrup=$("#idgrup").val();
	if(idgrup==''){
		UIkit.modal.alert('<i class="material-icons md-24 md-color-red-A700">highlight_off</i> Please Choose Group !');
	} else {
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('cas/Statusproses/remove_role'); ?>",
                data: "idstatus="+idstatus,
				data: "idstatus="+idstatus+"&idgrup="+idgrup,
                success: function(data){
					//swal.close();
					//$("#box-role").html(data);
					//alert(idgrup);
					load_role_group();
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

	
function pindah22(idstatus){
	var idstatus=$(idstatus).attr('id');
		//alert(idstatus);
	
	 t = $(idstatus);
     tr = t.parent().parent();
     tr.remove();
	 
/*		var idstatus=document.getElementsByName('idstatus[]');
        for(i=0; i < idstatus.length; i++)  {  
           var aa=idstatus[i].value;
		   alert(aa);
		}*/
	
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
function load_group_name(){
	//swal_process();
	//localStorage.setItem('statusView','grid');
	var idgrup=$("#idgrup").val();
				$.ajax({
                type: "POST",
                url : "<?php echo base_url('cas/Statusproses/load_group_name'); ?>",
                data: "idgrup="+idgrup,
                success: function(data){
                    //$("#usergroupname").empty();
                     for (var i =0; i<data.length; i++){
                          $("#usergroupname").html(data[i].GroupName);
                       }
                }
            });  
}

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
                    $("#idgrup").empty();
                   $("#idgrup").append("<option value=''>Select Group.....</option>");
                     for (var i =0; i<data.length; i++){
                   var option = "<option value='"+data[i].Id+"'>"+data[i].GroupName+"</option>";
                          $("#idgrup").append(option);
                       }
  
               }
       }); 
 }	
 function new_group(){
	//action_method == 'new'
	$('#form_new_group')[0].reset();

	$('.btn-save').html('<i class="material-icons md-color-grey-50">save</i> Save');
	modal=UIkit.modal("#modal_add",{bgclose:false,modal:false});
	modal.show();
	//$("#form_new_group").attr('onsubmit','save_user()');
	//$(".title_status").html('<i class="material-icons">account_box</i> NEW USER');
}
 function save_new_group(){	
		swal_process();
		//var nm_vendor=$("#nm_vendor").val();
		var formData = new FormData($("#form_new_group")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('cas/Statusproses/save_new_group')?>",
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
               	   load_group_list();
				   /* reset input and tabel */
				  
				   $('#form_new_group')[0].reset();	
				   			    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });
		
    }

function ischeck(myid){
	var inputId = $(myid).attr("id");
	if($("#"+inputId).is(':checked')) {
          $("#"+inputId).val(inputId);
      } else {
		  $("#"+inputId).val(inputId);
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
