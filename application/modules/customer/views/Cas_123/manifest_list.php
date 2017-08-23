<style>
.time{
    color: rgba(153, 153, 153, 0.7);
    font-style: italic;
    text-decoration: underline;
}
p {
  margin: 0;
}

.notice {
  position: relative;
  margin: 1em;
  background: #F9F9F9;
  padding: 1em 1em 1em 2em;
  border-left: 4px solid #DDD;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.125);
}

.notice:before {
  position: absolute;
  top: 50%;
  margin-top: -17px;
  left: -17px;
  background-color: #DDD;
  color: #FFF;
  width: 30px;
  height: 30px;
  border-radius: 100%;
  text-align: center;
  line-height: 30px;
  font-weight: bold;
  font-family: Georgia;
  text-shadow: 1px 1px rgba(0, 0, 0, 0.5);
}

.info {
  border-color: #0074D9;
}

.info:before {
  content: "i";
  background-color: #00bcd4;
}

.success {
  border-color: #2ECC40;
}

.success:before {
  content: "√";
  background-color: #2ECC40;
}

.warning {
  border-color: #FFDC00;
}

.warning:before {
  content: "!";
  background-color: #FFDC00;
}

.error {
  border-color: #FF4136;
}

.error:before {
  content: "x";
  background-color: #FF4136;
}
<!-- end of chat -->

.uk-width-medium-10-10 .md-btn{
	
	margin-top:-4px;
}
.uk-grid .hdr_lbl{
	color:#003;
	font-weight:bold;
}
.uk-modal{
	    margin-top: -42px;
}
#content-modal{
	max-height:450px;
	min-height:450px;
}
#content-modal-list{
	max-height:500px;
	min-height:350px;
}


.nomor{
	font-weight:bolder;
}
.box{
	border-bottom:2px #F0F0F0 solid; padding-bottom:3px; margin-bottom:4px;
}
.uk-datepicker {
    z-index:9999 !important;
    width: auto;
    padding: 0;
}
</style>
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
<!--  mailbox functions -->
<script src="assets/js/pages/page_mailbox.min.js"></script>
<!-- My Function -->
<script src="<?php echo base_url();?>asset/my_function.js"></script>

<script type="text/javascript">

var $PortOrigin, $PortDestination, $mos, $lot, $incoterm, $sot, $commodity, $unit;
var PortOrigin, PortDestination, mos, lot, incoterm, sot, commodity, unit;
var xhr,xhr_1,xhr_2;
var $ststicket,ststicket;
var $ut_statusproses,ut_statusproses;
var $ut_type,ut_type;
var clearanceArr;
var stsArr;
var ststicketArr;
var t,tt;
$(document).ready(function(){
    $('#detail').hide();
    $('#tombol_nav').hide();
    $('#get_detail_ticket').hide();
    $('.MyProses_1').hide();
    $('#v_comment').hide();

         list = $("#list_inquiry").DataTable({
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "order": [[ 2, "desc" ]],
                "ajax": {
                    "url": "<?php echo site_url('Cas/Cas/ManifestList')?>",
                    "type": "POST",  
                },
                "columns": [
                { "data": "Mawb"},
                { "data": "Hawb"},
                { "data": "FlightDate"},
                { "data": "TrackingNo"},
                { "data": "CategoryHawb"},
                { "data": "Keterangan"},
                { "data": "StatusName"},
                { "data": "ShipperName"},
                { "data": "ConsigneeName"},
                { "data": "Description"},
                ]
         });
         
         colVis_set(list,$("#list_inquiry"));
         
        $('#list_inquiry tbody').on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = list.row(tr).data().Hawb;
                getDetail(row);
//            
                $('#detail').show();
                $('#listing').hide();
                $('#tombol_nav').show();
                $('#title').html('DETAIL MANIFEST');
                $('#preview_quotation').hide();
        });
        
        tblStatusTracking = $('#tblStatusTracking').DataTable({
                        "bFilter": false,
                        "processing": true, 
                        "serverSide": true, 
                        "order": [[ 2, "desc" ],[ 0, "desc" ]],
                        "ajax": {
                            "url": "<?php echo site_url('Cas/Cas/StatusTrackingGet')?>",
                            "type": "POST",  
                        },
                      "columns": [
                        { "data": "Id","class":"uk-hidden"},
                        { "data": "StatusProses"},
                        { "data": "DateUpdate"},
                        { "data": "Note"},
                        { "data": "UserName"}
                      ]
        });
        
        
         tblTypeClearance = $('#tblTypeClearance').DataTable({
                        "bFilter": false,
                        "processing": true, 
                        "serverSide": true, 
                        "order": [[ 2, "desc" ],[ 0, "desc" ]],
                        "ajax": {
                            "url": "<?php echo site_url('Cas/Cas/TypeClearanceGet')?>",
                            "type": "POST",  
                        },
                      "columns": [
                        { "data": "Id","class":"uk-hidden"},
                        { "data": "TypeClearance"},
                        { "data": "DateUpdate"},
                        { "data": "Note"},
                        { "data": "UserName"}
                      ]
        });        

         tblAttachment = $('#tblAttachment').DataTable({
                        "bFilter": false,
                        "processing": true, 
                        "serverSide": true, 
                        "order": [[ 2, "desc" ],[ 0, "desc" ]],
                        "ajax": {
                            "url": "<?php echo site_url('Cas/Cas/AttachmentGet')?>",
                            "type": "POST",  
                        },
                      "columns": [
                        { "data": "IdAttachment","class":"uk-hidden"},
                        { "data": "AttachmentName"},
                        { "data": "AttachmentDate"},
                        { "data": "Description"},
                        { "data": "AttachmentType"},
                        { "data": "UserName"},
                        { "data": "Action"}
                      ]
        });
                
        $('#list_quot tbody').on('click','tr', function (){
           // UIkit.modal("#modal_app_qout").show();
           $('#tombol_nav').hide();
           $('#preview_quotation').show();
           $('#detail').hide();
           $('#title').html('Quotation');
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
        var tgl_sekarang =  new Date().toISOString().slice(0,10);;
        $('#uk_dp_start').val(tgl_sekarang);
        $('#uk_dp_end').val(tgl_sekarang);
        $('#ut_date').val(tgl_sekarang);
        $('#uty_date').val(tgl_sekarang);
        
        
            tinymce.init({
               // skin_url: '<?php echo base_url();?>asset/assets/skins/tinymce/material_design',
                selector: "#tcontent",
                menubar: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
            
            tinymce.init({
               // skin_url: '<?php echo base_url();?>asset/assets/skins/tinymce/material_design',
                selector: "#comment_ticket",
                menubar: false,
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
     //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbStatusTicket',
           dataType: "json",
           success: function(data){
          //  console.log(data);
              $ststicket =$('#ststicket').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            ststicket = $ststicket[0].selectize;
            $('#Sts').parsley();
           }
       });
    //=======================================
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbStatusProses',
           dataType: "json",
           success: function(data){
          //  console.log(data);
              $ut_statusproses =$('#ut_statusproses').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            ut_statusproses = $ut_statusproses[0].selectize;
          //  $('#Sts').parsley();
           }
       });
    //=======================================
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbTypeClearance',
           dataType: "json",
           success: function(data){
          //  console.log(data);
              $ut_type =$('#uty_clearance').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            ut_type = $ut_type[0].selectize;
            //$('#Sts').parsley();
           }
       });
    //=======================================
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbTypeAttachment',
           dataType: "json",
           success: function(data){
          //  console.log(data);
              $ut_type =$('#ua_jenis').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            ut_type = $ut_type[0].selectize;
            //$('#Sts').parsley();
           }
       });
    //=======================================
    
    
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbTypeClearance',
           dataType: "json",
           success: function(data){
                clearanceArr = data;
           }
       });
    //=======================================
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbStatusProses',
           dataType: "json",
           success: function(data){
                stsArr = data;
           }
       });
    //=======================================
        //==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbStatusTicket',
           dataType: "json",
           success: function(data){
                ststicketArr = data;
           }
       });
    //=======================================
      $('#tab_detail').on('change.uk.tab', function(e, active, previous) {
          if(active.context.id != 'tab_ticket'){
            clearTimeout(t);
          }
          
          if(active.context.id != 'tab_discusstion'){
            clearTimeout(intv_discusstion);
          }
          
          
      });
  
  
});

function tarikticket(){
    thawb = $('#hawb').val();
 // 3 second
}


function getDetail(Id){
    
          swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
          
          var nmtabel='hawbmanifest';
          var keytabel='Hawb';
          
          $.ajax({
            url : "<?php echo site_url('Cas/Cdatamaster/get_edit')?>",
            type: "POST",
            data:({cid:Id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
                UIkit.switcher('#tab_detail').show(0);
                $('.v_Mavb').html(data.Mawb);
                $('.v_Hawb').html(data.Hawb);
                $('.v_FlightDate').html(data.FlightDate);
                $('.v_CategoryHawb').html(data.CategoryHawb);
                $('.v_Pkg').html(data.Pkg);
                $('.v_Description').html(data.Description);
                $('.v_NoSPPB').html(data.NoSPPB);
                $('.v_DateSPPB').html(data.DateSPPB);
                //console.log(clearanceArr);
                $('.v_TypeClerance').html('');
                clearanceArr.forEach(function(element) {
                    if(element.id==data.TypeClearance){$('.v_TypeClerance').html(element.name)};
                });                                
                //console.log(stsArr);
                $('.v_StatusProses').html('');
                stsArr.forEach(function(element) {
                    if(element.id==data.StatusProses){$('.v_StatusProses').html(element.name)};
                });
                $('.v_StatusDate').html(data.StatusDate);
                $('.v_ShipperName').html(data.ShipperName);
                $('.v_ShipperStreet1').html(data.ShipperStreet1);
                $('.v_ShipperStreet2').html(data.ShipperStreet2);
                $('.v_ShipperCity').html(data.ShipperCity);
                $('.v_ShipperPhone').html(data.ShipperPhone);
                $('.v_ConsigneeName').html(data.ConsigneeName);
                $('.v_ConsigneeStreet1').html(data.ConsigneeStreet1);
                $('.v_ConsigneeStreet2').html(data.ConsigneeStreet2);
                $('.v_ConsigneeCity').html(data.ConsigneeCity);
                $('.v_ConsigneePhone').html(data.ConsigneePhone);
                $('.v_NoSubPos').html(data.NoSubPos);
                $('.v_PTName').html(data.PTName);
                $('.v_API').html(data.API);
                $('.v_Npwp').html(data.Npwp);
                $('.v_HsCode').html(data.HsCode);
                $('.v_SkepKawasan').html(data.SkepKawasan);
                $('.v_Nik').html(data.Nik);
             //=================================================
                $('#Hawb').val(data.Hawb);
                $('#PTName').val(data.PTName);
                $('#API').val(data.API);
                $('#NPWP').val(data.Npwp);
                $('#HsCode').val(data.HsCode);
                $('#ShipperName').val(data.ShipperName);
                $('#ShipperStreet1').val(data.ShipperStreet1);
                $('#ShipperStreet2').val(data.ShipperStreet2);
                $('#ShipperCity').val(data.ShipperCity);
                $('#ShipperPhone').val(data.ShipperPhone);
                $('#ConsigneeName').val(data.ConsigneeName);
                $('#ConsigneeStreet1').val(data.ConsigneeStreet1);
                $('#ConsigneeStreet2').val(data.ConsigneeStreet2);
                $('#ConsigneeCity').val(data.ConsigneeCity);
                $('#ConsigneePhone').val(data.ConsigneePhone);
                $('#NoSubPos').val(data.NoSubPos);
                $('#PTName').val(data.PTName);
                $('#API').val(data.API);
                $('#Npwp').val(data.Npwp);
                $('#HsCode').val(data.HsCode);
                $('#SkepKawasan').val(data.SkepKawasan);
                $('#Nik').val(data.Nik);
                $('#MyTable').empty();
              
                        $.ajax({
                            url: "<?php echo site_url('Cas/Cas/dtracking')?>",
                            type:"POST",
                            data:({cid:Id}),
                            dataType: "json",
                            success: function(data) {
                             for (var i =0; i<data.length; i++){
                                myhtml = '<tr>'+
                                         '<td class="">'+data[i].TrackingNo+'</td>'+
                                         '<td style="display:none;">'+data[i].Pkgs+'</td>'+
                                         '<td>'+data[i].Weight+' '+data[i].WeightUnit+'</td>'+
                                         '</tr>';
                                $('#MyTable').append(myhtml);                                 
                             }
                             swal.close();  
                            }
                        }); 
             
             //=================================================     
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal.close();
                alert('Error get data from ajax');
            }
        });
          
}

function getDesc(){
          var Id=$('#Hawb').val();
          if(Id == ''){
            exit;
          }
 //         swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
          $('.MyProses_1').show();
          $('.MyContent_1').hide();
          var nmtabel='hawbmanifest';
          var keytabel='Hawb';
          
          $.ajax({
            url : "<?php echo site_url('Cas/Cdatamaster/get_edit')?>",
            type: "POST",
            data:({cid:Id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
                $('.v_Mavb').html(data.Mawb);
                $('.v_Hawb').html(data.Hawb);
                $('.v_FlightDate').html(data.FlightDate);
                $('.v_CategoryHawb').html(data.CategoryHawb);
                $('.v_Pkg').html(data.Pkg);
                $('.v_Description').html(data.Description);
                $('.v_NoSPPB').html(data.NoSPPB);
                $('.v_DateSPPB').html(data.DateSPPB);
                $('.v_TypeClerance').html('');
                clearanceArr.forEach(function(element) {
                    if(element.id==data.TypeClearance){$('.v_TypeClerance').html(element.name)};
                });                                
                //console.log(stsArr);
                $('.v_StatusProses').html('');
                stsArr.forEach(function(element) {
                    if(element.id==data.StatusProses){$('.v_StatusProses').html(element.name)};
                });
                
                $('.v_StatusDate').html(data.StatusDate);
                $('.v_ShipperName').html(data.ShipperName);
                $('.v_ShipperStreet1').html(data.ShipperStreet1);
                $('.v_ShipperStreet2').html(data.ShipperStreet2);
                $('.v_ShipperCity').html(data.ShipperCity);
                $('.v_ShipperPhone').html(data.ShipperPhone);
                $('.v_ConsigneeName').html(data.ConsigneeName);
                $('.v_ConsigneeStreet1').html(data.ConsigneeStreet1);
                $('.v_ConsigneeStreet2').html(data.ConsigneeStreet2);
                $('.v_ConsigneeCity').html(data.ConsigneeCity);
                $('.v_ConsigneePhone').html(data.ConsigneePhone);
                $('.v_NoSubPos').html(data.NoSubPos);
                $('.v_PTName').html(data.PTName);
                $('.v_API').html(data.API);
                $('.v_Npwp').html(data.Npwp);
                $('.v_HsCode').html(data.HsCode);
                $('.v_SkepKawasan').html(data.SkepKawasan);
                $('.v_Nik').html(data.Nik);
             //=================================================
                $('#Hawb').val(data.Hawb);
                $('#ShipperName').val(data.ShipperName);
                $('#ShipperStreet1').val(data.ShipperStreet1);
                $('#ShipperStreet2').val(data.ShipperStreet2);
                $('#ShipperCity').val(data.ShipperCity);
                $('#ShipperPhone').val(data.ShipperPhone);
                $('#ConsigneeName').val(data.ConsigneeName);
                $('#ConsigneeStreet1').val(data.ConsigneeStreet1);
                $('#ConsigneeStreet2').val(data.ConsigneeStreet2);
                $('#ConsigneeCity').val(data.ConsigneeCity);
                $('#ConsigneePhone').val(data.ConsigneePhone);
                $('#NoSubPos').val(data.NoSubPos);
                $('#PTName').val(data.PTName);
                $('#API').val(data.API);
                $('#Npwp').val(data.Npwp);
                $('#HsCode').val(data.HsCode);
                $('#SkepKawasan').val(data.SkepKawasan); 
                $('#Nik').val(data.Nik); 
                $('.MyProses_1').hide();
                $('.MyContent_1').show();  
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal.close();
                alert('Error get data from ajax');
            }
        });
}

function back(){
    $('#detail').hide();
    $('#listing').show();
    $('#tombol_nav').hide();
    $('#title').html('LISTING MANIFEST');
    clearTimeout(t);
    clearTimeout(intv_discusstion);
}

function a(){
    UIkit.modal("#modal_cancel").show();
}

function getdis(){      
    get_discusstion($('#Hawb').val());
}

function send_disscution(){
     var cidticket   = $('#Hawb').val();
     var isi = tinyMCE.get('comment_discuction').getContent();
     adddiscuction(cidticket,isi);
}

function quot_exit(){
    $('#detail').show();
    $('#preview_quotation').hide();
    $('#tombol_nav').show();
    $('#title').html('Description Inquiry');
}

function get_mos(){
    
}

function updatedata(){
    var t = JSON.stringify($('#myformUpdate').serialize());
   // alert(t);
          swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
      
          url = '<?php echo base_url();?>Cas/Cas/manifestupdate';
      
          $.ajax({
            url : url,
            type: "POST",
            data: $('#myformUpdate').serialize(),
            dataType: "JSON",
            success: function(data)
            {
               //==================== Sucsess ========
               swal("Success Update Data...!", "", "success");
               //swal.close();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}

function addcoment(){
    var cidticket   = $('#idticket').val();
    var csts        = $('#statusproses').val();
    var ccontent    = tinyMCE.get('comment_ticket').getContent();//tinymce.get('comment_discuction').setContent('');
          
    swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>Cas/Cas/commentAdd';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({idticket:cidticket,contents:ccontent,sts:csts}),
       dataType: "JSON",
       success: function(data)
       {
           //==================== Sucsess ========
           swal("Message Send...!", "", "success");
           tinymce.get('comment_ticket').setContent('');
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
}

function cari(){
        var date1=$("#uk_dp_start").val();
        var date2=$("#uk_dp_end").val();
        
        var cfie=$("#fie").val();
        var ceve=$("#eve").val();
        var cval=$("#val").val();
        
      //  alert(cfie+'  '+ceve+' '+cval);
        var cinp=ceve.replace('v',cval);
        var cwhere= cfie+' '+cinp;
        var cwhere= cwhere.split(".").join("zzz");
        var cwhere= cwhere.split(" ").join("333");
        var cwhere= cwhere.split("'").join("ttt");
        var cwhere= cwhere.split("%").join("xxx");
        var cwhere= cwhere.split("=").join("bbb");
        var cwhere= cwhere.split("<>").join("kkk");
        var cwhere= cwhere.split("(").join("iii");
        var cwhere= cwhere.split(")").join("ooo");
        var cwhere= cwhere.split(",").join("ppp");
        
        var zpt =  'att';//$('#caript').combogrid('getValue');
        
        if (cfie==''){var cwhere='';}
        list.ajax.url( "<?php echo base_url(); ?>"+"Cas/Cas/ManifestList/"+zpt+"/"+cwhere+"/"+date1+"/"+date2 ).load();    
    }
    
    
function addticket(){
    var cidhawb = $('#Hawb').val();
    var cname = $('#tname').val();
    var cphone = $('#tphone').val();
    var cemail = $('#temail').val();
    var ccontent = tinyMCE.get('tcontent').getContent();//tinymce.get('comment_discuction').setContent('');
          
    swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>Cas/Cas/ticketAdd';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({idhawb:cidhawb,name:cname,phone:cphone,email:cemail,content:ccontent}),
       dataType: "JSON",
       success: function(data)
       {
           //==================== Sucsess ========
           swal("Success Create Ticket...!", "", "success");
           showticket();
           UIkit.modal('#modal_newticket').hide();
           tinymce.get('tcontent').setContent('');
           $('#tname').val('');
           $('#tphone').val('');
           $('#temail').val('');
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
}

function showticket(){
    var cidhawb = $('#Hawb').val();
              $('.MyProses_1').show();
              $('.MyContent_1').hide();
    $('#shticket').empty();
       $.ajax({
          url: "<?php echo site_url('Cas/Cas/ticketGet')?>",
          type:"POST",
          data:({idhawb:cidhawb}),
          dataType: "json",
          success: function(data) {
            if(data.sts==1){
                $('#myticketid').val(data.idticket);
                var cidticket = $('#myticketid').val();
                $('#shticket').html(data.isi);  
                    $('#getcomment').html('');
                    //====================== get
                       t = setInterval(function(){
                    	   $("#getcomment").load('<?php echo base_url()?>Cas/Cas/tarikticket'+'/'+cidticket);
                        }, 4000);
//                        cid='';
//                           $.ajax({
//                                url: '<?php echo base_url();?>Cas/Cas/commentGetTicket',
//                                type:"POST",
//                                data:({id:cid}),
//                                dataType: "json",
//                                success: function(data) {
//                                   var myhtml = '';
//                                   
//                                   
//                                   for (var i =0; i<data.length; i++){
//                                      var c ='chat_message_wrapper';
//                                      if(data[i].userid != <?php echo $this->session->userdata('cs_Idusr'); ?>){
//                                        c = 'chat_message_wrapper chat_message_right';
//                                      } 
//                                      myhtml = myhtml + '<div class="'+c+'">'+
//                                            '<div class="chat_user_avatar">'+
//                                                '<img class="md-user-image" src="<?php echo base_url();?>asset/images/customer/avatar.png" alt=""/>'+
//                                            '</div>'+
//                                            '<ul class="chat_message">'+
//                                                '<li><span class="md-list-heading">'+data[i].name+'</span><p>'+data[i].content+'<span class="chat_message_time">'+data[i].date+', '+data[i].time+'</span> </p></li>'+
//                                            '</ul>'+
//                                            '</div>';
//                                      $('#getcomment').html(myhtml);
//                                   }
//                                   $('#getcomment').html(myhtml);  
//                                }
//                           });
                //====================== end get                
                $('#newticket').hide();
                $('#v_comment').show();  
                $('#v_ststicket').html('');
                ststicket.setValue(data.iki);
                ststicketArr.forEach(function(element) {
                    if(element.id==data.iki){$('#v_ststicket').html(element.name)};
                });                         
            }else{
                $('#shticket').empty(); 
                $('#newticket').show();
                $('#v_comment').hide();   
            } 
            $('.MyProses_1').hide();
            $('.MyContent_1').show();           
          }
       });
}

        function get_statustracking(){
            var hid=$('#Hawb').val();
            tblStatusTracking.ajax.url( "<?php echo base_url(); ?>"+"index.php/Cas/Cas/StatusTrackingGet/"+hid ).load();
        }
        function get_typeclearance(){
            var hid=$('#Hawb').val();
            tblTypeClearance.ajax.url( "<?php echo base_url(); ?>"+"index.php/Cas/Cas/TypeClearanceGet/"+hid ).load();
        }
        function get_attachment(){
            var hid=$('#Hawb').val();
            tblAttachment.ajax.url( "<?php echo base_url(); ?>"+"index.php/Cas/Cas/AttachmentGet/"+hid ).load();
        }        
function updatestatusproses(){
          swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 

          url = '<?php echo base_url();?>Cas/Cas/StatusTrackingUpdate';
          var hid=$('#Hawb').val();
          var txtpros =$("#ut_statusproses option:selected").text();
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_updatestatus').serialize()+ '&hawb=' + hid+'&txtstsproses='+txtpros,
            dataType: "JSON",
            success: function(data)
            {
               //==================== Sucsess ========
               swal("Success Update Data...!", "", "success");
               get_statustracking();
               $('.v_StatusProses').html(data.stsproses);   
               $('.v_StatusDate').html(data.datestatus);
               UIkit.modal('#modal_updatestatus').hide();
               $('#ut_statusproses').val('');
               $('#ut_remark').val('');
               //swal.close();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}  

function updatetype(){
          swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
      
          url = '<?php echo base_url();?>Cas/Cas/TypeClearanceUpdate';
          var hid=$('#Hawb').val();
          var txtpros =$("#uty_clearance option:selected").text();
          $.ajax({
            url : url,
            type: "POST",
            data: $('#form_updatetype').serialize()+ '&hawb=' + hid+'&txtstsproses='+txtpros,
            dataType: "JSON",
            success: function(data)
            {
               //==================== Sucsess ========
               swal("Success Update Data...!", "", "success");
               get_typeclearance();
               $('.v_TypeClerance').html(data.stsproses);   
               UIkit.modal('#modal_updatetypeclear').hide();
               $('#uty_remark').val('');
               $('#uty_clearance').val('');
               //swal.close();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}

function download_attachment(id,file){
    cetakTri(file,"<?php echo site_url('Cas/Cas/AttachmentDownload')?>");
}  

</script>
<style>
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
.selectize-control .selectize-input.disabled{
    background-color : #d8d8d8;
}




</style>

<!--<h3 class="heading_b uk-margin-bottom">INQUIRY</h3>-->

<div class="md-card">
     <div class="md-card-toolbar" style="height: 55px;">
       <div class="md-card-toolbar-actions">
       <span id="tombol_nav">
        <a class="md-btn md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="back();"><i class="md-list-addon-icon material-icons md-24 md-color-black">replay</i> Back To List</a>
        
      <!--  <a class="md-btn md-btn-danger md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="a();"><i class="md-list-addon-icon material-icons md-24 md-color-white">close</i> Cancel Inquiry</a> -->
       </span> 
        <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
         <!--<i class="md-icon material-icons md-card-toggle">&#xE316;</i>
         <i class="md-icon material-icons md-card-close">&#xE14C;</i>-->
       </div>
       <h3 id="title" class="md-card-toolbar-heading-text">
         DATA MANIFEST
       </h3>
     </div>
   <div class="md-card-content">
   <span id="listing">
        <div class="uk-grid" >
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Start Date</label>
                    <input class="md-input" type="text" id="uk_dp_start" onchange="cari()" />
                </div>
            </div>
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                   <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                   <label for="uk_dp_end">End Date</label>
                  <input class="md-input" type="text" id="uk_dp_end" onchange="cari()" />
               </div>
            </div>
            <div  class="uk-width-medium-1-3 uk-width-large-1-3">
             </div>
            <div class="uk-width-medium-1-3 uk-width-large-1-3">
               <select onchange="cari()" name="fie" id="fie" data-md-selectize>
                  <option value="a.TrackingNo">TRACKING NO</option>
                  <option value="b.Mawb">MAWB</option>
                  <option value="a.Hawb">HAWB</option>
                  <option value="b.CategoryHawb">CATEGORY HAWB</option>
               </select>
             </div>
             <div class="uk-width-medium-1-3 uk-width-large-1-3">
               <select onchange="cari()" class="form-control"  name="eve" id="eve" data-md-selectize>
                <option value="like '%v%'">Contains</option>
                <option value="not like '%v%'">Not Contains</option>
                <option value="like 'v%'">Start With</option>
                <option value="like '%v'">End With</option>
                <option value="= 'v'">Equals</option>
                <option value="<> 'v'">Not Equals</option>
               </select>
             </div>
             <div class="uk-width-medium-1-3 uk-width-large-1-3">
               <label>Type Your Search</label>
               <input type="text" class="md-input" name="val" id="val" onkeyup="cari()"/>
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
               <th>Mawb</th>
               <th>Hawb</th>
               <th>FlightDate</th>
               <th>TrackingNo</th>
               <th>CategoryHawb</th>
               <th>Type Clerance</th>
               <th>Status</th>
               <th>ShipperName</th>
               <th>ConsigneeName</th>
               <th>Description</th>
            </tr>
          </thead>
        </table>
    </span>
    <span id="detail">
    <div class="uk-grid uk-grid-divider uk-grid-medium">
        <div class="uk-width-large-1-3">
            <ul class="md-list">
                <li>
                  <div class="md-list-content">
                    <span class="uk-text-small uk-text-muted uk-display-block">MAWB</span>
                    <span class="md-list-heading uk-text-large v_Mavb" ></span>
                  </div>
                </li>
                <li>
                   <div class="md-list-content">
                      <span class="uk-text-small uk-text-muted uk-display-block">HAWB</span>
                      <span class="md-list-heading uk-text-large v_Hawb" ></span>
                   </div>
               </li>
                <li>
                  <div class="md-list-content">
                    <span class="uk-text-small uk-text-muted uk-display-block">Flight Date</span>
                    <span class="md-list-heading uk-text-large v_FlightDate" ></span>
                  </div>
                 </li>
                 <li>
                   <div class="md-list-content">
                     <span class="uk-text-small uk-text-muted uk-display-block">Type HAWB</span>
                     <span class="md-list-heading uk-text-large v_CategoryHawb" ></span>
                   </div>
                  </li>
            </ul>
          </div>
          <div class="uk-width-large-1-3">
            <ul class="md-list">
               <li>
                   <div class="md-list-content">
                       <span class="uk-text-small uk-text-muted uk-display-block">No SPPB</span>
                       <span class="md-list-heading uk-text-large v_NoSPPB" ></span>
                   </div>
                </li>
                <li>
                   <div class="md-list-content">
                       <span class="uk-text-small uk-text-muted uk-display-block">SPPB DATE</span>
                       <span class="md-list-heading uk-text-large v_DateSPPB" ></span>
                   </div>
                </li>
               <li>
                   <div class="md-list-content">
                      <span class="uk-text-small uk-text-muted uk-display-block">Package</span>
                      <span class="md-list-heading uk-text-large v_Pkg" ></span>
                   </div>
                </li>
                <li>
                   <div class="md-list-content">
                     <span class="uk-text-small uk-text-muted uk-display-block">Description</span>
                     <span class="md-list-heading uk-text-large v_Description" ></span>
                   </div>
                </li>
             </ul>
          </div>
          <div class="uk-width-large-1-3">
             <ul class="md-list">
                <li>
                   <div class="md-list-content">
                      <span class="uk-text-small uk-text-muted uk-display-block">Type Clearane</span>
                      <span class="md-list-heading uk-text-large v_TypeClerance" ></span>
                   </div>
                </li>
                <li>
                   <div class="md-list-content">
                       <span class="uk-text-small uk-text-muted uk-display-block">Status Tracking</span>
                       <span class="md-list-heading uk-text-large v_StatusProses" ></span>
                   </div>
                </li>
                <li>
                   <div class="md-list-content">
                       <span class="uk-text-small uk-text-muted uk-display-block">Status Date</span>
                       <span class="md-list-heading uk-text-large v_StatusDate" ></span>
                   </div>
                </li>  
             </ul>
          </div>
          <div class="uk-width-large-1-1">
              <table class="uk-table uk-text-nowrap">
                  <thead>
                     <tr>
                        <th class="uk-width-2-10">Tracking No</th>
                        <th style="display:none;" class="uk-width-1-10">Package</th>
                        <th class="uk-width-3-10">Wight</th>
                     </tr>
                   </thead>
                   <tbody id="MyTable">
                   
                  </tbody>
              </table>
 <!--    <?php echo $this->load->view('Cas/CAS/tabs');?> -->
          </div>
     </div>
     <br />                       
     <ul id="tab_detail" class="uk-tab" data-uk-tab="{connect:'#tabs_2'}">
       <li id="tab_description" class="uk-active" onclick="getDesc();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">description</i> Description</a></li>
       <li id="tab_update" onclick="getDesc();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">mode_edit</i> Update</a></li>
       <li id="tab_ticket" onclick="showticket();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">recent_actors</i> Ticket</a></li>
       <li id="tab_type" onclick="get_typeclearance();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">gavel</i> Type Clerance</a></li>
       <li id="tab_tracking" onclick="get_statustracking();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">find_replace</i> Tracking</a></li>
       <li id="tab_attachment" onclick="get_attachment();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">attach_file</i> Attachment</a></li>
       <li id="tab_discusstion" onclick="getdis();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">question_answer</i> Discusstion</a></li>
       <li id="tab_log"><a href="#" class="uk-text-primary" ><i  class="md-list-addon-icon material-icons md-24 uk-text-primary">memory</i> Log Activity</a></li>
     </ul>
     <ul id="tabs_2" class="uk-switcher uk-margin">
       <li>
     <span class="MyProses_1">
     <center><div class="proses_loader"></div><br />Prosesing...!</center>
     </span>
     <span class="MyContent_1">
           <!-- <div class="uk-text-right" style="margin-bottom: -55px;">
                <a class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="updateinquiry()">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">save</i> Update Data
                </a>
            </div> 
            <h3 class="md-color-light-blue-900"><i class="material-icons md-24 md-color-light-blue-900">location_on</i> Manifest</h3>
            <hr style="border: 1px rgba(50, 132, 208, 1) solid;"/> -->
                        <div class="uk-grid uk-grid-divider uk-grid-medium">
                                <div class="uk-width-large-1-3">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">No Subpos</span>
                                                <span class="md-list-heading uk-text-large v_NoSubPos" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">PT Name</span>
                                                <span class="md-list-heading uk-text-large v_PTName" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">API</span>
                                                <span class="md-list-heading uk-text-large v_API" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">NPWP</span>
                                                <span class="md-list-heading uk-text-large v_Npwp" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">HSCODE</span>
                                                <span class="md-list-heading uk-text-large v_HsCode" >-</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">SKEP KAWASAN</span>
                                                <span class="md-list-heading uk-text-large v_SkepKawasan" >-</span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">NIK</span>
                                                <span class="md-list-heading uk-text-large v_Nik" >-</span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="uk-width-large-1-3">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Shipeer Name</span>
                                                <span class="md-list-heading uk-text-large v_ShipperName" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Shipeer Address Street</span>
                                                <span class="md-list-heading uk-text-large v_ShipperStreet1" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Shipeer Address Building</span>
                                                <span class="md-list-heading uk-text-large v_ShipperStreet2" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Shipeer City</span>
                                                <span class="md-list-heading uk-text-large v_ShipperCity" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Shipeer Phone</span>
                                                <span class="md-list-heading uk-text-large v_ShipperPhone"></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="uk-width-large-1-3">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Name</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeName" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Address Street</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeStreet1" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Address Buliding</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeStreet2" ></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Address City</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeCity"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Phone</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneePhone"></span>
                                            </div>
                                        </li>                                         
                                    </ul>
                                </div>
                            </div>
       </span>
       </li>
<!-- TAB 2 -->       
       <li>
<span class="MyProses_1">
   <center><div class="proses_loader"></div><br />Prosesing...!</center>
</span>
<span class="MyContent_1">
       <form id="myformUpdate">
       <input type="hidden" id="Hawb" name="Hawb" />
       <br />
       <div class="uk-grid">
              <div class="uk-width-medium-1-3">
                 <div class="uk-form-row">
                   <label>No Subpos</label>
                    <input type="text" id="NoSubPos" name="NoSubPos" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row ">
                   <label>PT Name</label>
                    <input type="text" id="PTName" name="PTName" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>API</label>
                    <input type="text" id="API" name="API" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>NPWP</label>
                    <input type="text" id="Npwp" name="Npwp" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>HSCODE</label>
                    <input type="text" id="HsCode" name="HsCode" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>Skep Kawasan</label>
                    <input type="text" id="SkepKawasan" name="SkepKawasan" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>Nik</label>
                    <input type="text" id="Nik" name="Nik" value=" " class="md-input"/>
                 </div>
               </div>
               <div class="uk-width-medium-1-3" style="border-left:1px solid #ddd">
                 <div class="uk-form-row">
                   <label>Shipper Name</label>
                    <input type="text" id="ShipperName" name="ShipperName" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row ">
                   <label>Shipper Address Street</label>
                    <textarea id="ShipperStreet1" name="ShipperStreet1"  class="md-input"> </textarea>
                 </div>
                 <div class="uk-form-row">
                   <label>Shipper Address Building</label>
                    <textarea id="ShipperStreet2" name="ShipperStreet2" class="md-input"> </textarea>
                 </div>
                 <div class="uk-form-row">
                   <label>Shipper City</label>
                    <input type="text" id="ShipperCity" name="ShipperCity" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>Shipper Phone</label>
                    <input type="text" id="ShipperPhone" name="ShipperPhone" value=" " class="md-input"/>
                 </div>
               </div>
               <div class="uk-width-medium-1-3" style="border-left:1px solid #ddd">
                 <div class="uk-form-row">
                   <label>Consignee Name</label>
                    <input type="text" id="ConsigneeName" name="ConsigneeName" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row ">
                   <label>Consignee Address Street</label>
                    <textarea id="ConsigneeStreet1" name="ConsigneeStreet1"  class="md-input"> </textarea>
                 </div>
                 <div class="uk-form-row">
                   <label>Consignee Address Building</label>
                    <textarea id="ConsigneeStreet2" name="ConsigneeStreet2"  class="md-input"> </textarea>
                 </div>
                 <div class="uk-form-row">
                   <label>Consignee City</label>
                    <input type="text" id="ConsigneeCity" name="ConsigneeCity" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>Consignee Phone</label>
                    <input type="text" id="ConsigneePhone" name="ConsigneePhone" value=" " class="md-input"/>
                 </div>
               </div>
            </div>
            <hr style="border: 1px rgba(50, 132, 208, 1) solid;"/>
             <div class="uk-text-left">
                <a class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="updatedata()">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">save</i> Update Data
                </a>
        </div> 
       </form>
</span>
       </li>
       <li>
<!-- TAB 3 -->
<span class="MyProses_1">
   <center><div class="proses_loader"></div><br />Prosesing...!</center>
</span>
<span class="MyContent_1">
           <div class="uk-text-left">
                <a id="newticket" onclick="UIkit.modal('#modal_newticket').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">assignment</i> Ticket</a>
           </div>
           <input type="hidden" id="myticketid" name="myticketid"/>
           <div id="shticket"></div>
         
        <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;"/>                    
    <span id="v_comment">     
        <div style="margin-bottom: 5px;" class="parsley-row">
            <textarea id="comment_ticket" name="comment_ticket"></textarea>
        </div>
        <div class="uk-width-large-1-2" >
            <div class="uk-form-row parsley-row">
                <label for="">Status Ticket<span class="req"> *</span></label>
                <select id="ststicket" name="ststicket" required>
                    <option value=" ">...</option>
                </select>
            </div>
        </div>
        <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light" href="#" onclick="addcoment();"><i class="material-icons md-24 md-color-white">send</i> Send</a>
        <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;"/> 
        <div class="chat_box touchscroll chat_box_colors_a" id="getcomment" style="background-image:url('<?php echo base_url();?>asset/images/background/bg1.png')">
        </div>
        <br />
        <br />
        <br />
    </span>
</span>
       </li>
<!-- TAB 4 -->
       <li>
           <div class="uk-text-left">
                <a id="newticket" onclick="UIkit.modal('#modal_updatetypeclear').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">update</i> Update Type Clearance</a>
           </div>
                    <table id="tblTypeClearance" class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Type Clearance</th>
                            <th>Modify Date Clearance</th>
                            <th>Remark</th>
                            <th>Update By</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                   </table>
<!-- MODAL UPDATE STATUS -->                
       <div class="uk-modal" id="modal_updatetypeclear">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Update Status Tracking</h3>
              </div>
              <form id="form_updatetype" name="form_updatetype">
                 <div class="uk-grid">  
                              <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">User Name</span>
                                                <span class="md-list-heading uk-text-large" ><?php echo $this->session->userdata('cs_FullName'); ?></span>
                                            </div>
                                        </li>                                      
                                    </ul>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Date</span>
                                                <span class="md-list-heading uk-text-large " ><?php echo date('Y-m-d H:i:s'); ?></span>
                                            </div>
                                        </li>                                        
                                    </ul>
                                </div>
                         <div class="uk-width-medium-1-1">
                            <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;margin-bottom: 10px"/>                    
                         </div> 
                    <div class="uk-width-medium-1-1">
                     <div class="uk-input-group">
                         <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                         <label for="ut_date">Date Update Type Clearance</label>
                         <input class="md-input" type="text" id="uty_date" name="uty_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                     </div>
                     <div class="uk-form-row">
                       <label>Type Clearance</label>
                        <select id="uty_clearance" name="uty_clearance" required>
                              <option value=" ">...</option>
                        </select>
                     </div>
                     <div class="uk-form-row ">
                       <label>Remark</label>
                        <textarea id="uty_remark" name="uty_remark"  class="md-input"> </textarea>
                     </div>
                    </div>
                 </div>
               </form>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="updatetype()">Update</button>
              </div>
            </div>
        </div> 
<!-- end modal -->
       </li>
       <li>
           <div class="uk-text-left">
                <a id="newticket" onclick="UIkit.modal('#modal_updatestatus').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">update</i> Update Status Tracking</a>
           </div>       
                <table id="tblStatusTracking" class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Status Tracking</th>                            
                            <th>Date Tracking</th>
                            <th>Remark</th>
                            <th>Update By</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
<!-- MODAL UPDATE STATUS -->                
       <div class="uk-modal" id="modal_updatestatus">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Update Status Tracking</h3>
              </div>
              <form id="form_updatestatus" name="form_updatestatus">
                 <div class="uk-grid">  
                              <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">User Name</span>
                                                <span class="md-list-heading uk-text-large" ><?php echo $this->session->userdata('cs_FullName'); ?></span>
                                            </div>
                                        </li>                                      
                                    </ul>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Date</span>
                                                <span class="md-list-heading uk-text-large " ><?php echo date('Y-m-d H:i:s'); ?></span>
                                            </div>
                                        </li>                                        
                                    </ul>
                                </div>
                         <div class="uk-width-medium-1-1">
                            <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;margin-bottom: 10px"/>                    
                         </div> 
                    <div class="uk-width-medium-1-1">
                     <div class="uk-input-group">
                         <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                         <label for="ut_date">Date Update Status Tracking</label>
                         <input class="md-input" type="text" id="ut_date" name="ut_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" />
                     </div>
                     <div class="uk-form-row">
                       <label>Status Tracking</label>
                        <select id="ut_statusproses" name="ut_statusproses" required>
                              <option value=" ">...</option>
                        </select>
                     </div>
                     <div class="uk-form-row ">
                       <label>Remark</label>
                        <textarea id="ut_remark" name="ut_remark"  class="md-input"> </textarea>
                     </div>
                    </div>
                 </div>
               </form>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="updatestatusproses()">Update</button>
              </div>
            </div>
        </div> 
<!-- end modal -->               
       </li>
       <li>
       
 <span class="MyProses_1">
   <center><div class="proses_loader"></div><br />Prosesing...!</center>
</span>
<span class="MyContent_1">
           <div class="uk-text-left">
                <a id="newticket" onclick="UIkit.modal('#modal_uploadattachment').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">add_box</i> Add Attachment</a>
           </div> 
                <table id="tblAttachment" class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama File</th>                            
                            <th>Upload Date</th>
                            <th>Remark</th>
                            <th>Type</th>
                            <th>Upload By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>  
 <script type="text/javascript">
 
     function addattachment(){
            var hid=$('#Hawb').val()
    		swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    		var formData = new FormData($("#form_addattachment")[0]);
            formData.append('Hawb',hid);
           // ajax adding data to database
              $.ajax({
                url : "<?php echo site_url('Cas/Cas/AddAttachment')?>",
                type: "POST",
                data:formData,// $('#form_add_vendor').serialize(),
                dataType: "JSON",
    			//for iput file
    			cache: false,
    			processData: false,
          		contentType: false,
                success: function(data)
                {
    				swal("Success Update Data...!", "", "success");
    			   	UIkit.modal("#modal_uploadattachment").hide();
    				$('#form_addattachment')[0].reset();
                    get_attachment();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
    				swal("Success Update Data...!", "", "success");
                    UIkit.modal("#modal_uploadattachment").hide();
    				$('#form_addattachment')[0].reset();
                    get_attachment();
                }
            });    
    }
    
    function deleteAttachment(id,name){
        //var t = JSON.stringify($('#myformUpdate').serialize());
       // alert(t);
              swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
          
              url = '<?php echo base_url();?>Cas/Cas/AttachmentDelete';
          
              $.ajax({
                url : url,
                type: "POST",
                data: ({idfile:id,namafile:name}),
                dataType: "JSON",
                success: function(data)
                {
                   //==================== Sucsess ========
                  swal("Deleted!", "Your file has been deleted.", "success");
                  get_attachment();
                   //swal.close();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal("Oops... Something went wrong!", "Proses Invalid!", "error");
                }
            });    
    }

 </script>
 <!-- MODAL UPDATE STATUS -->                
       <div class="uk-modal" id="modal_uploadattachment">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Upload Attachment File</h3>
              </div>
              <form id="form_addattachment" name="form_addattachment">
                 <div class="uk-grid">  
                              <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">User Name</span>
                                                <span class="md-list-heading uk-text-large" ><?php echo $this->session->userdata('cs_FullName'); ?></span>
                                            </div>
                                        </li>                                      
                                    </ul>
                                </div>
                                <div class="uk-width-medium-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Date</span>
                                                <span class="md-list-heading uk-text-large " ><?php echo date('Y-m-d H:i:s'); ?></span>
                                            </div>
                                        </li>                                        
                                    </ul>
                                </div>
                         <div class="uk-width-medium-1-1">
                            <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;margin-bottom: 10px"/>                    
                         </div> 
                    <div class="uk-width-medium-1-1">
                     <div class="uk-input-group">
                         <input class="md-input" type="file" id="userfile" name="userfile" />
                     </div>
                     <div class="uk-form-row">
                       <label>Type Attachment</label>
                        <select id="ua_jenis" name="ua_jenis" required>
                              <option value=" ">...</option>
                        </select>
                     </div>
                     <div class="uk-form-row ">
                       <label>Description</label>
                        <textarea id="ua_description" name="ua_description"  class="md-input"> </textarea>
                     </div>
                    </div>
                 </div>
               </form>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="addattachment()">Save</button>
              </div>
            </div>
        </div> 
<!-- end modal -->          
</span>       
       </li>
       <li>
        <?php echo $this->load->view($discustion); ?>
       </li>
       <li>
        <?php echo $this->load->view($log); ?>
       </li>
     </ul>
    </span>
    <span id="get_detail_ticket">
        
    </span>
   </div>
</div>

<!-------------------- MODAL CANCEL INQUIRY ----------------->
        <div class="uk-modal" id="modal_cancel">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Cancel Inquiry</h3>
              </div>
               <textarea class="md-input"></textarea> 
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button><button type="button" class="md-btn md-btn-flat md-btn-flat-primary">Yes</button>
              </div>
            </div>
        </div>
  
  
<!-- MODAL LIST ICKET -->
<div id="modal_ticket" class="uk-modal">
     <div class="uk-modal-dialog uk-modal-dialog-default">
   <button type="button" class="uk-modal-close uk-close"></button>
  <div class="uk-modal-header">
<i class="material-icons">insert_drive_file</i> LIST TICKET
<button onclick="create_ticket()"  type="button" class="md-btn md-btn-success md-btn-wave-light uk-float-right">
 <i class="material-icons md-color-brown-50 ">assignment</i>
  <span>New Ticket</span>                                        
</button>

  </div>
 <!-- header title -->

 <!-- end ofheader title -->
 


<div class="uk-overflow-container" id="content-modal-list">                           
  
<div class="uk-grid" data-uk-grid-margin="">
      

<div class="uk-width-medium-8-10 box-rate" id="box-rate">

<div class="mybox">
<div class="md-card-content">
             <?php echo $this->load->view('CAS/list_ticket');?>                      
                            
       </div>
  </div>

</div>

 
 

      

</div>

<!-- FOOTER -->

   </div>
   <!-- Footer area -->
<!--<div class="uk-modal-footer">
<button  type="submit" class="md-btn md-btn-success md-btn-wave-light">
 <i class="material-icons md-color-brown-50 ">launch</i>
  <span>Create Quotation</span>                                        
</button>
</div>-->
   <!-- end of footer area -->
                                                                        
                                </div>
                            </div>
<!--END MODAL COMMENT -->
  
  
<!-- MODAL COMMENT -->
<div id="modal_comment" class="uk-modal">
     <div class="uk-modal-dialog uk-modal-dialog-default">
   <button type="button" class="uk-modal-close uk-close"></button>
  <div class="uk-modal-header">
<i class="material-icons">insert_drive_file</i> LIST THREAD
<button   onclick="create_comment()" class="md-btn md-btn-success md-btn-wave-light uk-float-right">
 <i class="material-icons md-color-brown-50 ">question_answer</i>
  <span>New Story</span>                                        
</button>

  </div>
 <!-- header title -->
<div class="uk-grid" data-uk-grid-margin="">
 <div class="uk-width-medium-2-10">
	<div class="md-input-wrapper md-input-filled">
    <label for="country">Ticket Name</label>
     <input type="text" name="lbl_ticket_name" required="" class="md-input"  id="lbl_ticket_name" value="">
     <input type="hidden" name="id_hidden_ticket" id="id_hidden_ticket" />
      <span class="md-input-bar"></span></div>         
 </div>       
<div class="uk-width-medium-2-10">
	<div class="md-input-wrapper md-input-filled">
    <label for="country">Created</label>
     <input type="text" name="lbl_created_date" required="" class="md-input"  id="lbl_created_date" value="">
      <span class="md-input-bar"></span></div>         
 </div>
 <div class="uk-width-medium-2-10">
	<div class="md-input-wrapper md-input-filled">
    <label for="country">Assigned To</label>
     <input type="text" name="lbl_assign_to" required="" class="md-input"  id="lbl_assign_to" value="">
      <span class="md-input-bar"></span></div>         
 </div>
 <div class="uk-width-medium-1-10">
   <div class="md-input-wrapper md-input-filled">
    <label for="country"> Follow</label>
     <input name="lbl_vol" type="text" class="md-input" id="lbl_vol" >
      <span class="md-input-bar"></span></div>         
 </div>
 

</div>
 <!-- end ofheader title -->
 


<div class="uk-overflow-container" id="content-modal">                           
  
<div class="uk-grid" data-uk-grid-margin="">
      

<div class="uk-width-medium-8-10 box-rate" id="box-rate">

<div class="mybox">
<div class="md-card-content">
             <?php echo $this->load->view('CAS/history');?>                      
                            
       </div>
  </div>

</div>

 
 

      

</div>

<!-- FOOTER -->

   </div>
   <!-- Footer area -->
<!--<div class="uk-modal-footer">
<button  type="submit" class="md-btn md-btn-success md-btn-wave-light">
 <i class="material-icons md-color-brown-50 ">launch</i>
  <span>Create Quotation</span>                                        
</button>
</div>-->
   <!-- end of footer area -->
                                                                        
                                </div>
                            </div>
<!-- END COMMETN -->


<!-------------------- MODAL CREATE TICKET ----------------->
        <div class="uk-modal" id="modal_newticket">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Create New Ticket</h3>
              </div>
                <div class="uk-grid">
                                <div class="uk-width-large-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">User Name</span>
                                                <span class="md-list-heading uk-text-large" ><?php echo $this->session->userdata('cs_FullName'); ?></span>
                                            </div>
                                        </li>                                   
                                    </ul>
                                </div>
                                <div class="uk-width-large-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Date</span>
                                                <span class="md-list-heading uk-text-large " ><?php echo date('Y-m-d H:i:s'); ?></span>
                                            </div>
                                        </li>                                        
                                    </ul>
                                </div>
                 <div class="uk-width-large-1-1">
                    <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;"/>                    
                 </div> 
                 <div class="uk-width-large-1-1">
                 &nbsp;      
                 </div>              
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-3">
                            <label>Nama</label>
                            <input type="text" class="input-count md-input" id="tname" name="tname"  />
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label>Phone</label>
                            <input type="text" class="input-count md-input" id="tphone" name="tphone"  />
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label>Email</label>
                            <input type="text" class="input-count md-input" id="temail" name="temail"  />
                        </div>
                    </div>
                 <div class="uk-width-large-1-1">
                 &nbsp;      
                 </div> 
                 <div class="uk-width-large-1-1">
                     <div class="uk-form-row">
                        <textarea id="tcontent" name="tcontent" class="md-input" rows="8"> </textarea>
                     </div>      
                 </div> 
                </div> 
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="addticket()">Yes</button>
              </div>
            </div>
        </div>





<!-- create ticket -->
<form method="post" action="javascript:void(0);" onsubmit="save_ticket()" id="form_add_ticket" enctype="multipart/form-data" data-parsley-validate="">
 <div id="modal_new_ticket" class="uk-modal">
         <div class="uk-modal-dialog uk-modal-dialog-small">
   <button type="button" class="uk-modal-close uk-close"></button>
    <div class="uk-modal-header">
   <h3 class="uk-modal-title"> <i class="material-icons">note_add</i> New TICKET</h3>
    </div>                                  
 
 <!-- header title -->
<div class="md-card-content">
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Subject</label>
                                        <input name="subject" type="text" class="md-input" id="subject" />
                                        <span class="md-input-wrapper md-input-filled">
                                        <input type="hidden" name="id_v_Hawb" id="id_v_Hawb" />
                                    </span></div>
                                  <div class="uk-width-medium-1-1">
                                    <label>complain_name</label>
                                    <span class="uk-width-medium-1-2">
                                    <input name="complain_name" type="text" class="md-input" id="complain_name" />
                                    </span></div>
                                  <div class="uk-width-medium-1-1">
                                    <label>email</label>
                                    <span class="uk-width-medium-1-2">
                                    <input name="email" type="text" class="md-input" id="email" />
                                </span></div>
                                </div>
                            </div>
                            
                        </div>
 <div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  
                                  <div class="uk-width-medium-1-2">
                                    <label>Phone 1</label>
                                    <input name="phone1" type="text" class="md-input" id="phone1" />
                                  </div>
         <div class="uk-width-medium-1-2">
                                    <label>Phone 2</label>
                                    <input name="phone2" type="text" class="md-input" id="phone2" />
                                  </div>
                                </div>
                            </div>
                            
                        </div>
<div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  
                                  <div class="uk-width-medium-1-2">
                                    <label>Remarks</label>
                                    <textarea name="remarks" class="md-input label-fixed" id="remarks"></textarea>
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
 <i class="material-icons md-color-brown-50 ">save</i>
  <span>Save Ticket</span>                                        
</button>
                                  </div>
</div>
</div>
<!-- END OF FOOTER -->

                                                                        
                                </div>
                            </div>
                            
                            </form>
<!-- create ticket -->
  
 
 
<!-- create ticket -->
<form method="post" action="javascript:void(0);" onsubmit="save_comment()" id="form_add_comment" enctype="multipart/form-data" data-parsley-validate="">
 <div id="modal_new_commentar" class="uk-modal">
         <div class="uk-modal-dialog uk-modal-dialog-small">
   <button type="button" class="uk-modal-close uk-close"></button>
    <div class="uk-modal-header">
   <h3 class="uk-modal-title"> <i class="material-icons">note_add</i> New Comment</h3>
    </div>                                  
 
 <!-- header title -->
<div class="md-card-content">
                    
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Subject</label>
                                        <input name="comment_subject" type="text" class="md-input" id="comment_subject" placeholder="Subject"/>
                                    <span class="md-input-wrapper md-input-filled">
                                        <input type="hidden" name="id_hidden_ticket2" id="id_hidden_ticket2" />
                                    </span></div>
                                  <div class="uk-width-medium-1-1">
                                    <label>Remarks</label>
                                    <textarea name="comment_remarks" class="md-input label-fixed" id="comment_remarks" placeholder="Comment text"></textarea>
                                    </div>
         
                                </div>
                            </div>
                            
                        </div>
<div class="uk-width-medium-1-1">
                          <div class="uk-form-row">
                                <div class="uk-grid">
                                  <div class="uk-width-medium-1-2">
                                    <label>Attachment</label>
                                        <input type="file" name="comment_attachment" id="comment_attachment" />
                                  </div>
                                  <div class="uk-width-medium-1-2">
                                    <label>Status</label>
                                    <select name="status_id" class="md-input" id="status_id">
                                    <option value="">Select </option>
                                     </select>
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
<button  type="submit" class="md-btn md-btn-primary md-btn-wave-light">
 <i class="material-icons md-color-brown-50 ">save</i>
  <span>Save</span>                                        
</button>
                                  </div>
</div>
</div>
<!-- END OF FOOTER -->

                                                                        
                                </div>
                            </div>
                            
                            </form>
                            
                
<!-- create ticket -->  
<script type="text/javascript">
$(document).ready(function(e) {
    //load_tabs_list();
});
function ticket(){
	swal_process();
	$("#boxlistticket").empty();
	var v_Hawb=$('#v_Hawb').html();
	$('#id_v_Hawb').val(v_Hawb);
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('Cas/Ticket/load_ticket')?>",
		    data: "v_Hawb="+v_Hawb,
           dataType: "json",
           success: function(data){
			   swal.close();
			   	var modal=UIkit.modal("#modal_ticket",{bgclose:false,modal:false});
				modal.show();
                    for (var i =0; i<data.length; i++){
						
						var stat=data[i].status_id;
						if(stat=='1'){
							var status='uk-badge-primary';
						} else if(stat=='2'){
							var status='uk-badge-warning';
						} else if(stat=='3'){
							var status='uk-badge-danger';
						}
						
						var text='<li onclick="ticket_detail(this)" class="ticket" id="'+data[i].ticket_id+'">'
						+ '<div class="md-list-content">'
						+ '<span style=" font-size:large" class="md-color-blue-A700">'+data[i].subject +'</span>'
						+ '<input class="jdl" id="'+data[i].subject+'" value="'+data[i].subject+'" type="hidden">'
						+ '<span class="md-list-heading"><i class="material-icons">account_circle</i>'+ data[i].complain_name +'</span>'
						+ '<span class="uk-badge '+ status +'">'+data[i].status+'</span>'
						+ '<span class="uk-text-small uk-text-muted"><em>'+data[i].complain_name +'</em></span>'
						+ '<span class="uk-text-small uk-text-muted"><em>Created by : '+data[i].FullName +'</em></span>'
						+ '<span class="uk-text-small uk-text-muted">'+data[i].remarks +'</span>'
						+ '</div></li>';
							$('#boxlistticket').append(text);
                       }
  
               },
			  error: function(errorThrown){
			   swal.close();
			   	var modal=UIkit.modal("#modal_ticket",{bgclose:false,modal:false});
				modal.show();
					} 
       }); 
    }
function ticket_detail(mydata){
	//swal_process();
	$("#boxhistory").empty();
	var idticket=$(mydata).attr('id');
	var jdl=$(mydata).next('.jdl').val();
	$('#id_hidden_ticket').val(idticket);
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('Cas/Ticket/load_ticket_detail')?>",
		    data: "idticket="+idticket,
           dataType: "json",
           success: function(data){
			   swal.close();
				var modal=UIkit.modal("#modal_comment",{bgclose:false,modal:false});
				modal.show();
                    for (var i =0; i<data.length; i++){
						var text='<div class="notice info">'
						+ '<i class="material-icons">account_circle</i> <span style=" font-size:large">'+data[i].user_detail +'</span>'
						+ '<p class="time"><i class="material-icons">schedule</i>'+data[i].comment_date+'</p>'
						+ '<p style=" font-size:14pt">'+data[i].subject_detail+'</p>'
						+ '<p>'+data[i].comment+'</p>'
						+ '</div>';
							$('#boxhistory').append(text);
                       }
  							
               },
			 error: function(errorThrown){
				var modal=UIkit.modal("#modal_comment",{bgclose:false,modal:false});
				modal.show();
						
					} 
       }); 
    }

function create_ticket(){
	var v_Hawb=$('#v_Hawb').html();
	$('#id_v_Hawb').val(v_Hawb);
	
	modal=UIkit.modal("#modal_new_ticket",{bgclose:false,modal:false});
	modal.show();
	
}
function create_comment(){
	var id_hidden_ticket=$('#id_hidden_ticket').val();	
	$('#id_hidden_ticket2').val(id_hidden_ticket);
	modal=UIkit.modal("#modal_new_commentar",{bgclose:false,modal:false});
	modal.show();
	load_status_ticket();
	
}


function save_ticket(){	
		swal_process();
		//var nm_vendor=$("#nm_vendor").val();
		var formData = new FormData($("#form_add_ticket")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('Cas/Ticket/save_ticket')?>",
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
			   	   var modal = UIkit.modal("#modal_new_ticket");
   	   			   modal.hide();
				   UIkit.modal.alert('<i class="fa fa-check"></i>  Success Saved !');
               	   ticket();
				   /* reset input and tabel */
				   $('#form_add_ticket')[0].reset();
				   
				  // $("#tablecontactdetail tbody").empty();
				   //$("#tableservicedetail tbody").empty();				    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });
		
    }
function save_comment(){	
 var idticket=$('#id_hidden_ticket2').val();
		swal_process();
		//var nm_vendor=$("#nm_vendor").val();
		var formData = new FormData($("#form_add_comment")[0]);
       // ajax adding data to database
          $.ajax({
            url : "<?php echo site_url('Cas/Ticket/save_comment')?>",
            type: "POST",
            data:formData,// $('#form_add_vendor').serialize(),
            dataType: "JSON",
			//for iput file
			cache: false,
			processData: false,
      		contentType: false,
            success: function(data)
            {		swal.close();

			   	   var modal = UIkit.modal("#modal_new_commentar");
   	   			   modal.hide();
				   UIkit.modal.alert('<i class="fa fa-check"></i>  Success Saved Comment!');
               	
				   ticket_detail($('#'+ idticket));
				     ticket();
				   /* reset input and tabel */
				   $('#form_add_comment')[0].reset();

				  // $("#tablecontactdetail tbody").empty();
				   //$("#tableservicedetail tbody").empty();				    
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error adding / update data.May be duplicate or others');
            }
        });	
		
 }
	
function load_status_ticket(){
	var id='open';
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('Cas/Ticket/load_status_ticket')?>",
		    data: "id="+id,
           dataType: "json",
           success: function(data){
                    $("#status_id").empty();
                   $("#status_id").append("<option value='2'>Pending</option>");
                     for (var i =0; i<data.length; i++){
                   var option = "<option value='"+data[i].id+"'>"+data[i].name+"</option>";
                          $("#status_id").append(option);
                       }
  
               }
       }); 
    }
function load_tabs_list(){
	$("#tab_list").empty();
	//var id='';
       $.ajax({
		   type: "POST",
           url : "<?php echo site_url('Cas/Ticket/load_tabs_list')?>",
		   //data: "id="+id,
           dataType: "json",
           success: function(data){
                     for (var i =0; i<data.length; i++){
						  //$("#tab_list").append(data[i].action);
                       }
               }
       }); 
} 
function swal_process(idVendor){
	swal({
		title:'<div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="96" width="96" viewBox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"></circle></svg></div>',
		text:'<p>Loading Content.......</p>',
		showConfirmButton:false,
		//type:"success",
		html:true
		});
}
</script>