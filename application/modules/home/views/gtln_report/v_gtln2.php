<link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/jquery.dataTables.min.css" media="all">
<script src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>asset/assets/js/custom/datatables_uikit.min.js"></script>
  
  <link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/themes.css">
  
  <script src="<?php echo base_url();?>asset/ordering_status/jquery-ui.js"></script>
 
  <script type="text/javascript">
 $(document).ready(function() {  
        var $dp_start = $('#uk_dp_start'),
            $dp_end = $('#uk_dp_end');

        var start_date = UIkit.datepicker($dp_start, {
            //format:'DD.MM.YYYY'
            format:'YYYY-MM-DD',
        });

        var end_date = UIkit.datepicker($dp_end, {
            //format:'DD.MM.YYYY'
            format:'YYYY-MM-DD',
        });
       
});

  </script>




<div class="md-card uk-margin-medium-bottom">
  <div class="md-card-content">
  <h3>GTLN - Manifest Status Release & Non-Release  </h3> 
<hr />
  <!--header-->
 <!-- <form method="post" action="<?php// echo base_url();?>cas/Gtln_report_manifest/non_release_excel">-->
  <form method="post" action="<?php echo base_url();?>cas/Gtln_report_manifest/download_xl_report" target="new">
  <div class="uk-grid" >
<?php
$date_now=date('Y-m-d');
$date_before=date('Y-m-d',strtotime('-9 days'));
?>

            <div  class="uk-width-medium-3-10">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Select Date</label>
                    <input class="md-input label-fixed" type="text" id="uk_dp_start" value="<?php echo $date_now ?>" name="tgl1"/>
                </div>
            </div>
     
 
 <div  class="uk-width-medium-3-10" style="display:none">
                    <label for="kategori">Select Status</label>
                    <select name="kategori" class="md-input">
                    <option value="non_release">Non Release</option>
                    <option value="release">Release</option>
                    </select>
                
            </div>
 <div  class="uk-width-medium-3-10">
                    <label>Select Table Source</label>
                    <select name="tabel" class="md-input label-fixed" id="tabel" data-md-selectize data-md-selectize-bottom>
                    <option value="bc_t_shipment">T_Shipment</option>
                    <option value="bc_t_shipment_b">T_Shipment_backup</option>
                    
          </select>
                
        </div>
<div class="uk-width-medium-10-10" style="margin-bottom:20px"><br /></div>   
<div  class="uk-width-medium-3-10">
 					<label>Data for MAWB</label>
                    <select name="mawb" onchange="selectAWB(this)" id="mawb" data-md-selectize data-md-selectize-bottom>
                                <option value="all">All MAWB</option>
                                <option value="custom">Custom MAWB</option>
                            </select>
        </div>  
        
        
 <div class="uk-width-medium-3-10" style="margin-top:-15px" id="box-search">
                            <div class="uk-form-row-filled">
                              <label>Type MAWB<sup> (Enter Per Number)</sup></label>
                                <textarea name="txtsearch" rows="8" class=" label-fixed" id="txtsearch" style="width:99%;border:1px #4caf50 solid;"></textarea>
                            </div>
                        </div>
                               
      
       <div  class="uk-width-medium-2-10" style="padding-top:20px">
        <button type="submit" class="md-btn md-btn-large md-btn-success" style="margin-top:-20px"><i class="material-icons md-24 md-color-grey-50">cloud_download</i>  Excel</button>
      
      </div>
      
    
    <div style="height:300px">
    
    </div>
             
    </div></form>
   


      
 <!-- end header-->
    
  </div>
            </div>
            
            
<script>
$(document).ready(function(e) {
    $("#box-search").hide(200);
});
function selectAWB(val){
	var ch=$(val).val();
	if(ch=='all'){
		$("#box-search").hide(200);
		$('#txtsearch').prop('required', false);
	} else{
		$("#box-search").show(200);
		$('#txtsearch').prop('required', true);
	}
}

$(".md-btn").click(function(){
	var input=$('#txtsearch').val();
	if(input=='' && $("#mawb").val()=='custom'){
		$('#txtsearch').css("border","1px red solid");
	} else{
	$('#txtsearch').css("border","1px #4caf50 solid");
	}
});
</script>
            
            
