
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
            <input type="text" class="md-input" name="txt_search" id="txt_search" onkeyup="filterList()"/>
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
                                <th width="33%">Name</th>
                            </tr>
                        </thead>
                       <tbody>
					<tr><th><label for="id"></label>
                <input type="text" name="id" id="id"  value="" /></th>
                <th><input type="text" name="id2" id="id2" value="" /></th>
                <th><input type="text" name="id3" id="id3" value="" /></th>
				<th><button class="md-btn md-btn-success" onclick="add_data()">+</button></th>
				</tr>
                         
                        </tbody>
                         <tfoot>
                        </tfoot>


                    </table>
                
                    
                </div>
  </div>


<form method="post" action="javascript:void(0);" onsubmit="add_data()" id="form_status" enctype="multipart/form-data" data-parsley-validate="">
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
                                    <label>Team Name</label>
                                    <input name="nm_team" type="text" required="required" class="md-input label-fixed" id="nm_team" value="" />
                                    <input type="hidden" name="idteam" id="idteam" value="" />
                                  </div>
         
                                </div>
                  </div>
                            
                        </div>
<div class="uk-width-medium-1-2">
                          <div class="uk-form-row md-input-wrapper md-input-filled">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Type Clearance <sup>( OLD )</sup></label>
                                    <input name="nm_team2" type="text" required="required" class="md-input label-fixed" id="nm_team2" value="" />
                                  </div>
         
                                </div>
                  </div>
                            
                        </div>
<div class="uk-width-medium-1-2">
                          <div class="uk-form-row md-input-wrapper md-input-filled">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Type Clerance <sup>( NEW )</sup></label>
                                    <input name="nm_team3" type="text" required="required" class="md-input label-fixed" id="nm_team3" value="" />
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
	modal=UIkit.modal("#modal_status",{bgclose:false,modal:false});
	modal.show();
	}

function add_data(){
	
	var a=$("#nm_team").val();
	var b=$("#nm_team2").val();
	var c=$("#nm_team3").val();
	var text='';
	  text +='<tr><th><label for="id"></label>'
                +'<input type="text" name="id" id="id"  value="'+a+'" /></th>'
                +'<th><input type="text" name="id2" id="id2" value="'+b+'" /></th>'
                +'<th><input type="text" name="id3" id="id3" value="'+c+'" /></th>'
				+'<th><button class="md-btn md-btn-success" onclick="add_data()">+</button>'
				+'<button class="md-btn md-btn-success" onclick="remove_data(this)"> - </button>'
				+'</th>'
				+'</tr>';
	
	$("#tbl_status tbody").append(text);
	modal=UIkit.modal("#modal_status",{bgclose:false,modal:false});
	modal.hide();
}


function remove_data(myid){
	$(myid).parents("tr").remove() 
	
}
</script>
