
<!-- page specific plugins -->
<!-- datatables -->
<script src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- datatables colVis-->
<script src="<?php echo base_url();?>asset/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
<!-- datatables tableTools-->
<script src="<?php echo base_url();?>asset/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
<!-- datatables custom integration -->
<script src="<?php echo base_url();?>asset/assets/js/custom/datatables_uikit.min.js"></script>
<!--  datatables functions
<script src="<?php echo base_url();?>asset/assets/js/pages/plugins_datatables.min.js"></script>
-->
<!-- angular -->
<script src="<?php echo base_url();?>asset/angular.min.js"></script>
<!-- inputmask -->
<script src="<?php echo base_url();?>asset/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>
<!-- tinymce -->
<script src="<?php echo base_url();?>asset/bower_components/tinymce/tinymce.min.js"></script>
<!--  mailbox functions 
<script src="assets/js/pages/page_mailbox.min.js"></script>
<!-- My Function -->
<script src="<?php echo base_url();?>asset/my_function.js"></script>

<script type="text/javascript">
var username,$username;
$(document).ready(function(){
    
    $.fn.dataTable.ext.errMode = 'throw'; // desable eror datatables

//==========================================
       $.ajax({
           url: '<?php echo base_url();?>cas/Cas/UserNameOp',
           dataType: "json",
           success: function(data){
            console.log(data);
              $username =$('#username').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            username = $username[0].selectize;
            //$('#Sts').parsley();
           }
       });
//=======================================
        
         list = $("#list_inquiry").DataTable({
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "order": [[ 2, "desc" ]],
                "ajax": {
                    "url": "<?php echo site_url('cas/Cas/NotInAssign_Job')?>",
                    "type": "POST",
                    "error": function (xhr, error, thrown) {
                       // swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
                    }  
                },
                "columns": [
                { "data": "Act"},
                { "data": "Sts"},
                { "data": "Hawb"},
                { "data": "FlightDate"},
                { "data": "TrackingNo"},
                { "data": "CategoryHawb","class":"uk-hidden"},
                { "data": "Keterangan","class":"uk-hidden"},
                { "data": "Ket"},
                { "data": "StatusName"},
                { "data": "ShipperName"},
                { "data": "ConsigneeName"},
                { "data": "Description"},
                ]
         });
         
         colVis_set(list,$("#list_inquiry"));
         
         
      list_user = $("#list_user").DataTable({
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "order": [[ 2, "desc" ]],
                "ajax": {
                    "url": "<?php echo site_url('cas/Cas/InAssign_Job')?>",
                    "type": "POST",
                    "error": function (xhr, error, thrown) {
                       // swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
                    }  
                },
                "columns": [
                { "data": "Act"},
                { "data": "Mawb"},
                { "data": "Hawb"},
                { "data": "FlightDate"},
                { "data": "TrackingNo"},
                { "data": "CategoryHawb","class":"uk-hidden"},
                { "data": "Keterangan","class":"uk-hidden"},
                { "data": "Ket"},
                { "data": "StatusName"},
                { "data": "ShipperName"},
                { "data": "ConsigneeName"},
                { "data": "Description"},
                ]
         });
         
         colVis_set(list,$("#list_user"));
         
    
         listuser = $('#listuser').DataTable({
                      "bFilter": false,
                      "bPaginate": false,
                      "bInfo": false,
                      "order": [[ 0, "asc" ]],
                      "columns": [
                        { "data": "No"},
                        { "data": "User"},
                        { "data": "Group"},
                        ]
         });
    
        
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
        

        $dp_start.on('change',function() {
            end_date.options.minDate = $dp_start.val();
        });

        $dp_end.on('change',function() {
            start_date.options.maxDate = $dp_end.val();
        });
        
        var tgl_sekarang =  new Date().toISOString().slice(0,10);
        $('#uk_dp_start').val(tgl_sekarang);
        $('#uk_dp_end').val(tgl_sekarang);
        
  
});

function cari2(){
        var date1=$("#uk_dp_start").val();
        var date2=$("#uk_dp_end").val();
        var idusr= $('#username').val();
        
        var tipeclearance=$("#fie").val();
        var kriteria=$("#eve").val();
		//var cval=$("#val").val();
		var input = $('#val').val().split('\n');
		var txtcari=input[0]+'_____'+input[1]+'_____'+input[2]+'_____'+input[3]+'_____'+input[4]+'_____'+input[5]+'_____'+input[6]+'_____'+input[7]+'_____'+input[8]+'_____'+input[9];
		var parameter=date1+"_____"+date2+"_____"+tipeclearance+"_____"+kriteria+"_____"+idusr+"_____"+txtcari;
		
		if(input==''){
            list.ajax.url( "<?php echo base_url(); ?>cas/Cas/NotInAssign_Job/att/trias/"+date1+"/"+date2+"/"+idusr ).load();

		} else {
			//list.ajax.url("<?php echo base_url();?>cas/Cas/ManifestList_search/"+parameter).load();
            list.ajax.url("<?php echo base_url();?>cas/Cas/ManifestList_search_assign/"+parameter).load();
		}
				//alert(kategori);
}

function getData(){
    idusr= $('#username').val();
    list_user.ajax.url( "<?php echo base_url(); ?>cas/Cas/InAssign_Job/"+idusr).load();
    cari2();
}

function add_assign(cidhawb){
    var cidusr = $('#username').val();
    var cidusr_text = $('select[name="username"] option:selected').text();
    if(cidusr == ' '){
             swal("Oops... User Proses is required", "Please Input Status Proses!...", "error");
             exit();
    }
    
    UIkit.modal.confirm('Are you sure assign hawb '+cidhawb+' to user '+cidusr_text+' ?', function(){
    
    swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>cas/Cas/assignAdd';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({idhawb:cidhawb,idusr:cidusr}),
       dataType: "JSON",
       success: function(data)
       {
           swal("Success Add Assign...!", "", "success");
           cari2();
           getData();
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
   });
}

function remove_assign(cidhawb){
    var cidusr = $('#username').val();
    var cidusr_text = $('select[name="username"] option:selected').text();
    if(cidusr == ' '){
             swal("Oops... User Proses is required", "Please Input Status Proses!...", "error");
             exit();
    }
    
    UIkit.modal.confirm('Are you sure remove assign hawb '+cidhawb+' ?', function(){
    
    swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>cas/Cas/assignRemove';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({idhawb:cidhawb,idusr:cidusr}),
       dataType: "JSON",
       success: function(data)
       {
           swal("Remove Assign...!", "", "success");
           cari2();
           getData();
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
   });
}

  function show_assign(hawb){
  //  alert(idgroup+'-'+id+'-'+sts);
      UIkit.modal('#modal_detail_hawb').show();
      var ctgl = $('#uk_dp_1').val();                     
          listuser.clear().draw();
          $('.MyProses_1_h').show();
          $('.MyContent_1_h').hide();
                       $.ajax({
                            url: "<?php echo site_url('cas/Cas/ShowUserAssign')?>",
                            type:"POST",
                            data:({hawb:hawb}),
                            dataType: "json",
                            success: function(data) {
                             for (var i =0; i<data.length; i++){
                                    listuser.row.add({
                                    "No"            : data[i].No,    
                                    "User"          : data[i].Name,//'<a onclick="link_notif('+"'<?php echo site_url('cas/Ccas/ManifestList_job');?>?idhawb="+data[i].Hawb+"'"+')">'+data[i].Hawb+'</a>',
                                    "Group"     : data[i].Group,
                                }).draw( );
                             }
                            // $("#jumlahanak1").html(i);
                             $('.MyProses_1_h').hide();
                             $('.MyContent_1_h').show();
                            }
                        }); 
  }

</script>
<style>
.uk-tab > li > a{
    min-width : 10px;
}

.selectize-dropdown-content{
    z-index: 99999;
}
.md-list > li{
    padding : 2px 1px;
}
.md-list .uk-text-large{
    font-size : 13px;
}
.md-list .uk-text-small{
    font-size : 11px;
}

.dataTables_wrapper .dt-uikit-header{
    margin-bottom:-10px;
}
.md-colVis{
    margin-bottom:-35px;
}
#list_inquiry tbody {
    cursor:pointer;
}

#tblTicket tbody {
    cursor:pointer;
}

.selectize-control .selectize-input.disabled{
    background-color : #d8d8d8;
}




</style>

<!--<h3 class="heading_b uk-margin-bottom">INQUIRY</h3>-->

<div class="md-card">
     <div class="md-card-toolbar" style="height: 55px;">
       <div class="md-card-toolbar-actions">
      <!-- <span id="tombol_nav">
        <a class="md-btn md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="back();"><i class="md-list-addon-icon material-icons md-24 md-color-black">replay</i> Back To List</a>
        
        <a class="md-btn md-btn-danger md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="a();"><i class="md-list-addon-icon material-icons md-24 md-color-white">close</i> Cancel Inquiry</a>
       </span>  -->
        <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
         <!--<i class="md-icon material-icons md-card-toggle">&#xE316;</i>
         <i class="md-icon material-icons md-card-close">&#xE14C;</i>-->
       </div>
       <h3 id="title" class="md-card-toolbar-heading-text">
         ASSIGN JOB
       </h3>
     </div>
   <div class="md-card-content">
   <div class="uk-grid uk-grid-divider"  >
   <div  class="uk-width-large-2-3 uk-width-medium-2-3">
        <div class="uk-grid" >
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Start Date</label>
                    <input class="md-input" type="text" id="uk_dp_start" value=" " />
                </div>
            </div>
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                   <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                   <label for="uk_dp_end">End Date</label>
                  <input class="md-input" type="text" id="uk_dp_end" value=" " />
               </div>
            </div>
            <div  class="uk-width-medium-1-3 uk-width-large-1-3">
                
            </div>
            <div class="uk-width-medium-1-4 uk-width-large-1-4">
               <select name="fie" id="fie" data-md-selectize>
                  <option value="a.trackno">TRACKING NO</option>
                <!--  <option value="b.mawb">MAWB</option> -->
                  <option value="b.hawb">HAWB</option>
                 <!-- <option value="c.Keterangan">TYPE CLEARANCE</option> -->
                  <option value="e.UR_JNS">TYPE CLEARANCE PMK 182</option>
                  <option value="b.consignee_name">CONSIGNEE NAME</option>
                  <option value="b.shipper_name">SHIPPER NAME</option>
                  <option value="xxx">ASSIGN</option>
               </select>
             </div>
             <div class="uk-width-medium-1-4 uk-width-large-1-4">
               <select class="form-control"  name="eve" id="eve" data-md-selectize>
                <option value="contains">Contains</option>
                <option value="equals">Equals</option>
                <option value="notcontains">Not Contains</option>
                <option value="start">Start With</option>
                <option value="end">End With</option>
                <option value="notequals">Not Equals</option>
               </select>
             </div>
             <div class="uk-width-medium-1-4" style="margin-top:-50px">
               <label>Type Search <!--<sup> (Enter Per Number / Max 10)</sup> --></label>
               <textarea name="val" class="md-input" id="val" style="max-height:100px"></textarea>
             </div>
             <div class="uk-width-medium-1-5 uk-width-large-1-5">
               <a  onclick="cari2();" class="md-btn md-btn-small md-btn-success waves-effect waves-button ">
               <i class="md-list-addon-icon material-icons md-24 md-color-white">search</i>Search</a>
             </div>
        </div>
        <br />
        <br />
        <ul style="display: none;" class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
           <li class="uk-active"><a href="#" onclick="getlist(1);"><i class="md-list-addon-icon material-icons md-24">list</i> All</a></li>
           <li><a href="#" onclick="getlist(2);"><i class="md-list-addon-icon material-icons md-24">info_outline</i> Open</a></li>
           <li><a href="#" onclick="getlist(2);"><i class="md-list-addon-icon material-icons md-24">question_answer</i> Quotation</a></li>
           <li><a href="#" onclick="getlist(3);"><i class="md-list-addon-icon material-icons md-24">assignment_turned_in</i> Contract</a></li>
           <li><a href="#" onclick="getlist(4);"><i class="md-list-addon-icon material-icons md-24">clear</i> Cancel</a></li>
        </ul>
        <ul style="display: none;" id="tabs_1" class="uk-switcher uk-margin">
           <li>Content 1</li>
           <li>Content 2</li>
           <li>Content 3</li>
           <li>Content 4</li>
        </ul>
        <table id="list_inquiry" class="uk-table uk-table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th></th>
               <th>Assign</th>
               <th>Hawb</th>
               <th>FlightDate</th>
               <th>TrackingNo</th>
               <th>CategoryHawb</th>
               <th>Type Clerance</th>
               <th>Type Clerance (PMK 182)</th>
               <th>Status</th>
               <th>ShipperName</th>
               <th>ConsigneeName</th>
               <th>Description</th>
            </tr>
          </thead>
        </table>
   </div>
   <div  class="uk-width-large-1-3 uk-width-medium-1-3">
        <br />
        <div class="uk-grid">
            <div class="uk-width-large-1-1">
                <div class="uk-form-row parsley-row">
                    <label for="">User Name<span class="req"> *</span></label>
                    <select id="username" name="username" onchange="getData();" required>
                       <option value=" ">...</option>
                    </select>
                </div>
            </div>
        </div>
        <br />
        <br />
        <div class="uk-width-large-1-1">
        <table id="list_user" class="uk-table uk-table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th></th> 
               <th>Mawb</th>
               <th>Hawb</th>
               <th>FlightDate</th>
               <th>TrackingNo</th>
               <th>CategoryHawb</th>
               <th>Type Clerance</th>
               <th>Type Clerance (PMK 182)</th>
               <th>Status</th>
               <th>ShipperName</th>
               <th>ConsigneeName</th>
               <th>Description</th>
            </tr>
          </thead>
        </table>
        </div>
   </div>
   <div class="uk-width-large-1-3 uk-width-medium-1-3">

   </div>
  </div>
</div>
</div>

<!-- MODAL UPDATE STATUS -->                
       <div class="uk-modal" id="modal_detail_hawb">
            <div class="uk-modal-dialog">
              <button type="button" class="uk-modal-close uk-close"></button>
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">User</h3>
              </div>
              <div class="uk-overflow-container">
                <span class="MyProses_1_h">
                    <center><div class="proses_loader"></div><br />Processing...!</center>
                </span>
                <span class="MyContent_1_h">
                <table id="listuser" class="uk-table uk-table-hover" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                       <th>No</th>
                       <th>Hawb</th>
                       <th>Date_Hawb</th>
                    </tr>
                  </thead>
                </table>
                </span>
              </div>
            </div>
        </div> 
<!-- end modal --> 