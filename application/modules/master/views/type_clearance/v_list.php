<script src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- datatables colVis-->
<script src="<?php echo base_url();?>asset/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
<!-- datatables tableTools-->
<script src="<?php echo base_url();?>asset/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
<!-- datatables custom integration -->
<script src="<?php echo base_url();?>asset/assets/js/custom/datatables_uikit.min.js"></script>
 
<style>
.uk-table tr td:hover{
	cursor:pointer;
}
.uk-tab > li.uk-active > a {
  color:#0277bd;
}

</style>
 
  <script type="text/javascript">
    var tbl_status;
 $(document).ready(function() {    
    
          tbl_status = $('#tbl_status').DataTable({ 
            "processing": true, //Feature control the processing indicator.
			"bInfo": true,
			"bFilter":false,
			//"order":[[4,"desc"],[3,"desc"],[1,"asc"]],
 "lengthMenu": [[10, 60, 100, -1], [10, 60, 100, "All"]],
            "serverSide": true, //Feature control DataTables' server-side processing mode
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('master/Type_clearance/listdata')?>",
                "type": "POST",
            },
            "columns": [
            { "data": "no","orderable":false,"visible":true },
			{ "data": "noid"},
            { "data": "Keterangan"},
			{ "data": "action","orderable":false,"visible":true}
            ]
          });  
  
$('#tbl_status tbody').on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tbl_status.row(tr);
		   var id=row.data().noid;
		   edit_data(id);
    //Redirect if click
    //window.location.href = "<?php echo base_url();?>hawb/Awb/awb_detail/"+row.data().Hawb;
	//sidebarNonAktif();
     });
});

//reload/refresh table list
function reload_tbl_status()
    {
      tbl_status.ajax.reload(null,false); //reload datatable ajax 
    }

  </script>

<div class="md-card uk-margin-medium-bottom">
<!--<div class="uk-grid toolbar-box">
 <div class="uk-width-medium-10-10">
                    <div class="md-card">
                        <div class="md-card-toolbar">
                            <div class="md-card-toolbar-actions">    
	



                            </div>
  <h3 class="md-card-toolbar-heading-text">
 <i class="md-list-addon-icon material-icons md-24">list</i> 
 LIST HAWB
                            </h3>
                        </div>
                        
                    </div>
                
	</div>
   
  
  
 
	
</div>-->
<!-- SORTING ---->

        <div class="uk-grid" >
            <div class="uk-width-medium-1-3 uk-width-large-1-3">
               <!-- GRID 1 -->
             </div>
             
             <div class="uk-width-medium-1-3 uk-width-large-1-3">
            <!-- GRID 2 -->
             </div>
             
          <div class="uk-width-medium-1-3 uk-width-large-1-3">
            <label>Type Your Search</label>
            <input type="text" class="md-input" name="txt_search" id="txt_search" onkeyup="cari()"/>
            </div>
        </div>

 
 
<!--============================================== --->

  <div class="md-card-content">
<button   onclick="new_type()" class="md-btn md-btn-success md-btn-wave-light uk-float-right">
 <i class="material-icons md-color-brown-50 ">control_point</i>
  <span>New Data</span>                                        
</button>
<table id="tbl_status" class="uk-table uk-table-hover tbl_status" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                              <th width="9%">No</th>
                                <th width="9%">Noid </th>
                                <th width="73%">Name</th>
                                <th width="9%">#</th>
                            </tr>
                        </thead>
                       <tbody>
                        <tr>
                          <th>No</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                         </tr>
                         
                        </tbody>
                         <tfoot>
                        </tfoot>


                    </table>
                
                    
                </div>
  </div>


<form method="post" action="javascript:void(0);" onsubmit="save_type()" id="form_status" enctype="multipart/form-data" data-parsley-validate="">
 <div id="modal_status" class="uk-modal">
         <div class="uk-modal-dialog uk-modal-dialog-small">
   <button type="button" class="uk-modal-close uk-close"></button>
    <div class="uk-modal-header">
   <h3 class="uk-modal-title title_status">Title status</h3>
    </div>                                  
 
 <!-- header title -->
<div class="md-card-content">
                    
                    <div class="uk-grid" data-uk-grid-margin>
                      <div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
    
                                
                                  
         <div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Name</label>
                                    <textarea name="Keterangan" class="md-input label-fixed" required="required" id="Keterangan"></textarea>
                                    <input type="hidden" name="idclearance" id="idclearance" value="" />
                                  </div>
         
                                </div>
                  </div>
                            
                        </div>
              
                                </div>
                        </div>
                            
                      </div>

                        
        </div>
                    
           </div>
 <!-- end ofheader title -->
<!-- FOOTER -->
<div class="uk-grid">
  <div class="uk-width-medium-1-1">


<div class="uk-modal-footer uk-text-right">
<button type="submit" class="md-btn md-btn-primary md-btn-wave-light">
  <span class="btn-save">Save Status</span>                                        
</button>
                                  </div>
</div>
</div>
<!-- END OF FOOTER -->

                                                                        
                                </div>
                            </div>
                            
                            </form>
                            

<script type="text/javascript">

function new_type(){
	$('#form_status')[0].reset();
	$('.btn-save').html('<i class="material-icons md-color-grey-50">save</i> Save');
	modal=UIkit.modal("#modal_status",{bgclose:false,modal:false});
	modal.show();
	$("#form_status").attr('onsubmit','save_type()');
	$(".title_status").html('<i class="material-icons">note_add</i>New Status Proses');
	
}
function edit_data(mydata){
	$('.btn-save').html('<i class="material-icons md-color-grey-50">refresh</i> Update');
	var id=mydata;
	       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('master/Type_clearance/load_edit_data')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
			   swal.close();
			   	modal=UIkit.modal("#modal_status",{bgclose:false,modal:false});
				modal.show();
				$("#form_status").attr('onsubmit','update_type()');
                for (var i =0; i<data.length; i++){
				   $("#Keterangan").val(data[i].Keterangan);
				   $("#idclearance").val(data[i].noid);
				   $(".title_status").html('<i class="material-icons">edit</i>Edit Status Proses');
                 }
  
               }
       });
}
function update_type(){
   // var t = JSON.stringify($('#myform').serialize());
          swal_process();
          url = '<?php echo base_url();?>master/Type_clearance/update_type';
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_status').serialize(),
            dataType: "JSON",
            success: function(data)
            {
				swal.close();
			   	var modal = UIkit.modal("#modal_status");
   	   			modal.hide();
				$('#form_status')[0].reset();
				UIkit.modal.alert('<i class="fa fa-check"></i>  Success Updated !');
				reload_tbl_status();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}
function save_type(){	
		swal_process();
		//var nm_vendor=$("#nm_vendor").val();
		var formData = new FormData($("#form_status")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('master/Type_clearance/save_type')?>",
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
			   	   var modal = UIkit.modal("#modal_status");
   	   			   modal.hide();
				   UIkit.modal.alert('<i class="fa fa-check"></i>  Success Saved !');
               	   reload_tbl_status();
				   /* reset input and tabel */
				   $('#form_status')[0].reset();				    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });
		
    }
function nonactive_status(mydata){
	var id=mydata;
	var conf = confirm("Sure to Non active data ?");
	if (conf) {
    //Logic to delete the item
	       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('master/Type_clearance/nonactive_status')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
			    UIkit.modal.alert('<i class="fa fa-check"></i>  Data deleted !');
				var modal = UIkit.modal("#modal_status");
   	   			modal.hide();
                reload_tbl_status();
             }
       });
	} else {
		var modal = UIkit.modal("#modal_status");
   	   	modal.hide();
	//return false;	
	}   
}
function filterList(){
	var column='1';
	var tgl='1';
	var txt_search=$("#txt_search").val();
	
	//alert(txt_search);
	if(txt_search==''){
		tbl_status.ajax.url('<?php echo site_url()?>cas/Statusproses/listdata').load();
		return false;
	} else {
		
	var inputan=txt_search+"_"+tgl+"_"+column;
	if(txt_search !=''){	
			tbl_status.ajax.url('<?php echo site_url()?>cas/Statusproses/filter_list/'+inputan).load();
	} else {
			tbl_status.ajax.url('<?php echo site_url()?>cas/Statusproses/listdata').load();		
	}

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
