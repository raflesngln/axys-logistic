
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
$(document).ready(function(){
       $('.MyProses_1').hide();
//         list = $("#list_inquiry").DataTable({
//                "bFilter": false,
//                "processing": true,
//                "serverSide": true,
//                "order": [[ 2, "desc" ]],
//                "ajax": {
//                    "url": "<?php echo site_url('cas/Ccas_rpt/Monitoring_Ticket')?>",
//                    "type": "POST",
//                    "error": function (xhr, error, thrown) {
//                       // swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
//                    }  
//                },
//                "columns": [
//                { "data": "No"},
//                { "data": "Name"},
//                { "data": "Group"},
//                { "data": "Target"},
//                { "data": "Actual"},
//                { "data": "Selisih"},
//                { "data": "Persen"},
//                ]
//         });
//         
//         colVis_set(list,$("#list_inquiry"));

               list = $('#list').DataTable({
                      "bFilter": false,
                      "bPaginate": false,
                      "bInfo": false,
                      "order": [[ 1, "asc" ]],
                      "columns": [
                        { "data": "No"},
                        { "data": "Name"},
                        { "data": "Group"},
                        { "data": "Target"},
                        { "data": "Actual"},
                        { "data": "Selisih"},
                        { "data": "Persen"},
                        ]
                });
                
             listhawb = $('#listhawb').DataTable({
                      "bFilter": false,
                      "bPaginate": false,
                      "bInfo": false,
                      "order": [[ 0, "asc" ]],
                      "columns": [
                        { "data": "No"},
                        { "data": "Hawb"},
                        { "data": "Date_Hawb"},
                        ]
                });

 var datepicker = UIkit.datepicker('#uk_dp_1', {format:'YYYY-MM-DD'});
 var tgl_sekarang =  new Date().toISOString().slice(0,10);
 $('#uk_dp_1').val(tgl_sekarang);
 load_detail();
});

function load_detail(){    
  var ctgl = $('#uk_dp_1').val();                     
          list.clear().draw();
          $('.MyProses_1').show();
          $('.MyContent_1').hide();
                       $.ajax({
                            url: "<?php echo site_url('cas/Ccas_rpt/Monitoring_Ticket')?>",
                            type:"POST",
                            data:({tgl:ctgl}),
                            dataType: "json",
                            success: function(data) {
                             for (var i =0; i<data.length; i++){
                                    list.row.add({
                                    "No"            : data[i].No,    
                                    "Name"          : data[i].Name,
                                    "Group"         : data[i].Group,
                                    "Target"        : data[i].Target,
                                    "Actual"        : data[i].Actual,
                                    "Selisih"       : data[i].Selisih,
                                    "Persen"        : data[i].Persen,
                                }).draw( );
                             }
                             $('.MyProses_1').hide();
                             $('.MyContent_1').show();
                            }
                        });                     
             
    }
  function ftarget(tlc,digit,type,hawb,sts){
  //  alert(idgroup+'-'+id+'-'+sts);
      UIkit.modal('#modal_detail_hawb').show();
      var ctgl = $('#uk_dp_1').val();                     
          listhawb.clear().draw();
          $('.MyProses_1_h').show();
          $('.MyContent_1_h').hide();
                       $.ajax({
                            url: "<?php echo site_url('cas/Ccas_rpt/Detile_Monitoring_Ticket')?>",
                            type:"POST",
                            data:({tlc:tlc,digit:digit,type:type,hawb:hawb,sts:sts}),
                            dataType: "json",
                            success: function(data) {
                             for (var i =0; i<data.length; i++){
                                    listhawb.row.add({
                                    "No"            : data[i].No,    
                                    "Hawb"          : '<a onclick="link_notif('+"'<?php echo site_url('cas/Ccas/ManifestList_job');?>?idhawb="+data[i].Hawb+"'"+')">'+data[i].Hawb+'</a>',
                                    "Date_Hawb"     : data[i].Date_Hawb,
                                }).draw( );
                             }
                            // $("#jumlahanak1").html(i);
                             $('.MyProses_1_h').hide();
                             $('.MyContent_1_h').show();
                            }
                        }); 
  }
</script>
<!--<h3 class="heading_b uk-margin-bottom">INQUIRY</h3>-->

<div class="md-card">
     <div class="md-card-toolbar" style="height: 55px;">
       <div class="md-card-toolbar-actions"> 
        <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
         <!--<i class="md-icon material-icons md-card-toggle">&#xE316;</i>
         <i class="md-icon material-icons md-card-close">&#xE14C;</i>-->
       </div>
       <h3 id="title" class="md-card-toolbar-heading-text">
         MONITORING TICKET
       </h3>
     </div>
   <div class="md-card-content">
   <div class="uk-grid">
                                <div class="uk-width-large-1-4 uk-width-1-1">
                                    <div class="uk-input-group">
                                        <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                                        <label for="uk_dp_1">Select date</label>
                                        <input class="md-input" type="text" id="uk_dp_1" value=" " />
                                    </div>
                                </div>
                                <div class="uk-width-large-1-4 uk-width-1-1">
                                    <a  onclick="load_detail();" class="md-btn md-btn-small md-btn-success waves-effect waves-button ">
                                    <i class="md-list-addon-icon material-icons md-24 md-color-white">search</i>Search</a>
                                </div>
    </div>
    <span class="MyProses_1">
        <center><div class="proses_loader"></div><br />Processing...!</center>
    </span>
    <span class="MyContent_1">
        <table id="list" class="uk-table uk-table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>No</th>
               <th>Name</th>
               <th>Group</th>
               <th>Target</th>
               <th>Actual</th>
               <th>Not Done</th>
               <th>(%)</th>
            </tr>
          </thead>
        </table>
    </span>
    <!-- MODAL UPDATE STATUS -->                
       <div class="uk-modal" id="modal_detail_hawb">
            <div class="uk-modal-dialog">
              <button type="button" class="uk-modal-close uk-close"></button>
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">HAWB</h3>
              </div>
              <div class="uk-overflow-container">
                <span class="MyProses_1_h">
                    <center><div class="proses_loader"></div><br />Processing...!</center>
                </span>
                <span class="MyContent_1_h">
                <table id="listhawb" class="uk-table uk-table-hover" cellspacing="0" width="100%">
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
   </div>
</div>