
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

var $PortOrigin, $PortDestination, $mos, $lot, $incoterm, $sot, $commodity, $unit;
var PortOrigin, PortDestination, mos, lot, incoterm, sot, commodity, unit;
var xhr,xhr_1,xhr_2;
var $ststicket,ststicket;
var $ut_statusproses,ut_statusproses;
var $ut_type,ut_type;
var $at_type,at_type;
var clearanceArr;
var stsArr;
var ststicketArr,ajuArr;
var t,tt;
var _typeclearance,_pmk182,_statustacking;
var tlc='';
$(document).ready(function(){
    swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
    
    $('#v_detail_ticket').hide();
    $('#detail').hide();
    $('#tombol_nav').hide();
    $('#get_detail_ticket').hide();
    $('.MyProses_1').hide();
    $('#v_comment').hide();
    $.fn.dataTable.ext.errMode = 'throw'; // desable eror datatables

 //   alert(zzz);
     var zzz = '<?php echo $idhawb ; ?>';        
         list = $("#list_inquiry").DataTable({
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "order": [[ 2, "desc" ]],
                "ajax": {
                    "url": "<?php echo site_url('cas/Cas/ManifestList_myjob_assign')?>"+"/rafles/",
                    "type": "POST",  
                },
                "columns": [
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
				$("#modal_updatestatus").css("display", "none");
   	   			   
        });
        
        tblStatusTracking = $('#tblStatusTracking').DataTable({
                        "bFilter": false,
                        "processing": true, 
                        "serverSide": true, 
                        "order": [[ 2, "desc" ],[ 0, "desc" ]],
                        "ajax": {
                            "url": "<?php echo site_url('cas/Cas/StatusTrackingGet')?>",
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
                            "url": "<?php echo site_url('cas/Cas/TypeClearanceGet')?>",
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
                            "url": "<?php echo site_url('cas/Cas/AttachmentGet')?>",
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

         tblTicket = $('#tblTicket').DataTable({
                        "bFilter": false,
                        "processing": true, 
                        "serverSide": true, 
                        "order": [[ 2, "desc" ],[ 0, "desc" ]],
                        "ajax": {
                            "url": "<?php echo site_url('cas/Cas/TicketListGet')?>",
                            "type": "POST",  
                        },
                      "columns": [
                        { "data": "ticket_id","class":"uk-hidden"},
                        { "data": "complain_name"},
                        { "data": "complain_date"},
                        { "data": "remarks"},
                        { "data": "name"},
                        { "data": "UserName"}
                      ]
        });
        
       $('#tblTicket tbody').on('click', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tblTicket.row(tr).data().ticket_id;
            //alert(row);
            showticket(row);
			var modal = UIkit.modal("#modal_updatestatus");
   	   		modal.hide();
            get_tlc();
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
        
        var tgl_sekarang =  new Date().toISOString().slice(0,10);
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
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
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
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
            });
     //==========================================
       $.ajax({
           url: '<?php echo base_url();?>cas/Cas/cmbStatusTicket',
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
    //==========================================
    //==========================================
//    $ut_statusproses = $('.ut_statusproses').selectize({
//                    valueField: 'id',
//                    labelField: 'name',
//                    searchField: ['name']
//                });
//                
//    ut_statusproses  = $ut_statusproses[0].selectize;
    $( "#btnststrack" ).click(function(){
  
//                        ut_statusproses.disable();
//                        ut_statusproses.clearOptions();
//                        ut_statusproses.load(function(callback){
//                            xhr && xhr.abort();
//                            xhr = $.ajax({
//                                url:'<?php echo base_url();?>cas/Cas/cmbStatusProses',
//                                dataType:'json',
//                                success: function(results) {
//                                    callback(results);
//                                    ut_statusproses.enable();
//                                },
//                                error: function() {
//                                    callback();
//                                }
//                            })
//                        });
    });
//       $.ajax({
//           url: '<?php echo base_url();?>cas/Cas/cmbStatusProses',
//           dataType: "json",
//           success: function(data){
//              $ut_statusproses =$('.ut_statusproses').selectize({
//					valueField: 'id',
//					labelField: 'name',
//					searchField: 'name',
//					options: data,
//					create: false
//				});
//            ut_statusproses = $ut_statusproses[0].selectize;
//            //ut_statusproses.disable();
//           }
//       });        
    //==========================================
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>cas/Cas/cmbTypeClearance_new',
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
           url: '<?php echo base_url();?>cas/Cas/cmbTypeAttachment',
           dataType: "json",
           success: function(data){
          //  console.log(data);
              $at_type =$('#ua_jenis').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            at_type = $at_type[0].selectize;
            //$('#Sts').parsley();
           }
       });
    //=======================================
    
    //==========================================
       $.ajax({
           url: '<?php echo base_url();?>cas/Cas/cmbTypeClearance',
           dataType: "json",
           success: function(data){
                clearanceArr = data;
                //==========================================
                   $.ajax({
                       url: '<?php echo base_url();?>cas/Cas/cmbaju',
                       dataType: "json",
                       success: function(data){
                            ajuArr = data;
                            //==========================================
                               $.ajax({
                                   url: '<?php echo base_url();?>cas/Cas/cmbStatusProses',
                                   dataType: "json",
                                   success: function(data){
                                        stsArr = data;
                                        //==========================================
                                           $.ajax({
                                               url: '<?php echo base_url();?>cas/Cas/cmbStatusTicket',
                                               dataType: "json",
                                               success: function(data){
                                                    ststicketArr = data;
                                                        if(zzz != ''){
                                                                    $('#detail').show();
                                                                    $('#listing').hide();
                                                                    $('#tombol_nav').show();
                                                                    $('#title').html('DETAIL MANIFEST');
                                                                    $('#preview_quotation').hide();
                                                                    getDetail(zzz);
                                                        }else{
                                                            swal.close();  
                                                        }  
                                               }
                                           });
                                        //=======================================
                                   }
                               });
                            //=======================================
                       }
                   });
                //=======================================
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
    thawb = $('#KeyHawb').val();
 // 3 second
}


function getDetail(Id){
    
          swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
          
          var nmtabel='t_shipment_cloud';
          var keytabel='hawb';
          
          $.ajax({
            url : "<?php echo site_url('cas/Cdatamaster/get_edit')?>",
            type: "POST",
            data:({cid:Id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
                UIkit.switcher('#tab_detail').show(0);
                $('#KeyHawb').val(data.hawb);
                $('.v_Mavb').html(data.mawb);
                $('.v_Hawb').html(data.hawb);
                $('.v_FlightDate').html(data.flight_date);
                $('.v_CategoryHawb').html('');
                $('.v_Pkg').html(data.Package+' / '+data.Weight+' Kg');
                $('.v_Description').html(data.kindofGood);
                $('.v_NoSPPB').html(data.Sppb);
                $('.v_DateSPPB').html(data.tglsppb);
                $('.v_FOB').html(data.FOB);
                //console.log(clearanceArr);
                $('.v_TypeClerance').html('');
                var xc = '';
                clearanceArr.forEach(function(element) {
                    if(element.id==data.type_clearance){
                        $('.v_TypeClerance').html(element.name);
                        xc=element.name;
                    }
                });     
                
                $('.v_aju').html(xc);
                ajuArr.forEach(function(element) {
                    if(element.id==data.Id_aju){
                        $('.v_aju').html(element.name)
                    }
                }); 
                                           
                //console.log(stsArr);
                $('.v_StatusProses').html('');
                stsArr.forEach(function(element) {
                    if(element.id==data.TrackingStatus){$('.v_StatusProses').html(element.name)};
                });
                
                _typeclearance  =  data.type_clearance;
                _pmk182         =  data.Id_aju;
                _statustacking  =  data.TrackingStatus;
                
                $('.v_StatusDate').html(data.TrackingDate);
                $('.v_ShipperName').html(data.shipper_name);
                $('.v_ShipperStreet1').html(data.shipper_address1);
                $('.v_ShipperStreet2').html(data.shipper_address2);
                $('.v_ShipperCity').html(data.shipper_city);
                $('.v_ShipperPhone').html(data.shipper_phone);
                $('.v_ConsigneeName').html(data.consignee_name);
                $('.v_ConsigneeStreet1').html(data.consignee_address);
                $('.v_ConsigneeStreet2').html('');
                $('.v_ConsigneeCity').html(data.consignee_city);
                $('.v_ConsigneePhone').html(data.consignee_phone);
                $('.v_NoSubPos').html(data.subpos);
                $('.v_PTName').html(data.consignee_name);
                $('.v_API').html(data.api_no);
                $('.v_Npwp').html(data.consignee_NPWP);
                $('.v_HsCode').html(data.hsCode);
                $('.v_SkepKawasan').html(data.SkepKawasan);
                $('.v_Nik').html(data.Nik);
                $('.v_StatusRemark').html(data.TrackingRemark);
                $('.v_F').html(data.BillingCode);
             //=================================================
                $('#ShipperName').val(data.shipper_name);
                $('#ShipperStreet1').val(data.shipper_address1);
                $('#ShipperStreet2').val(data.shipper_address2);
                $('#ShipperCity').val(data.shipper_city);
                $('#ShipperPhone').val(data.shipper_phone);
                $('#ConsigneeName').val(data.consignee_name);
                $('#ConsigneeStreet1').val(data.consignee_address);
                $('#ConsigneeStreet2').val('');
                $('#ConsigneeCity').val(data.consignee_city);
                $('#ConsigneePhone').val(data.consignee_phone);
                $('#NoSubPos').val(data.subpos);
                $('#PTName').val(data.consignee_name);
                $('#API').val(data.api_no);
                $('#Npwp').val(data.consignee_NPWP);
                $('#HsCode').val(data.hsCode);
                $('#SkepKawasan').val(data.SkepKawasan);
                $('#Nik').val(data.Nik);
                $('#MyTable').empty();
				$('#list_track').empty();
                get_statustracking();
                
                        $.ajax({
                            url: "<?php echo site_url('cas/Cas/dtracking')?>",
                            type:"POST",
                            data:({cid:Id}),
                            dataType: "json",
                            success: function(data) {
								var no=1;
                             for (var i =0; i<data.length; i++){
/*                                myhtml = '<tr>'+
                                         '<td class="">'+data[i].TrackingNo+'</td>'+
                                         '<td style="display:none;">'+data[i].Pkgs+'</td>'+
                                         '<td>'+data[i].Weight+' '+data[i].WeightUnit+'</td>'+
                                         '</tr>';*/
								var mydata2='<div class="uk-width-3-10" style="border-right: 2px #ddd solid;">'
										+no+'. '+data[i].TrackingNo
										+'</div>';
                                //$('#MyTablee').append(myhtml);
								$('#list_track').append(mydata2); 
								no++;				                                
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

function get_noa(){
    var Id=$('#KeyHawb').val();
    get_noa_(Id);
}

function getDesc(){
          var Id=$('#KeyHawb').val();
          if(Id == ''){
            exit;
          }
 //         swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
          $('.MyProses_1').show();
          $('.MyContent_1').hide();
          var nmtabel='t_shipment_cloud';
          var keytabel='hawb';
          
          $.ajax({
            url : "<?php echo site_url('cas/Cdatamaster/get_edit')?>",
            type: "POST",
            data:({cid:Id,cnmtabel:nmtabel,ckeytabel:keytabel}),
            dataType: "JSON",
            success: function(data)
            {
                $('.v_Mavb').html(data.mawb);
                $('.v_Hawb').html(data.hawb);
                $('.v_FlightDate').html(data.flight_date);
                $('.v_CategoryHawb').html('');
                $('.v_Pkg').html(data.Package+'/ '+data.Weight+' Kg');
                $('.v_Description').html(data.kindofGood);
                $('.v_NoSPPB').html(data.Sppb);
                $('.v_DateSPPB').html(data.tglsppb);
                $('.v_FOB').html(data.FOB);
                //console.log(clearanceArr);
                $('.v_TypeClerance').html('');
                var xc = '';
                clearanceArr.forEach(function(element) {
                    if(element.id==data.type_clearance){
                        $('.v_TypeClerance').html(element.name);
                        xc=element.name;
                    }
                });     
                
                $('.v_aju').html(xc);
                ajuArr.forEach(function(element) {
                    if(element.id==data.Id_aju){
                        $('.v_aju').html(element.name)
                    }
                });
                
                _typeclearance  =  data.type_clearance;
                _pmk182         =  data.Id_aju;
                _statustacking  =  data.TrackingStatus;
                
                $('.v_StatusDate').html(data.TrackingDate);
                $('.v_ShipperName').html(data.shipper_name);
                $('.v_ShipperStreet1').html(data.shipper_address1);
                $('.v_ShipperStreet2').html(data.shipper_address2);
                $('.v_ShipperCity').html(data.shipper_city);
                $('.v_ShipperPhone').html(data.shipper_phone);
                $('.v_ConsigneeName').html(data.consignee_name);
                $('.v_ConsigneeStreet1').html(data.consignee_address);
                $('.v_ConsigneeStreet2').html('');
                $('.v_ConsigneeCity').html(data.consignee_city);
                $('.v_ConsigneePhone').html(data.consignee_phone);
                $('.v_NoSubPos').html(data.subpos);
                $('.v_PTName').html(data.consignee_name);
                $('.v_API').html(data.api_no);
                $('.v_Npwp').html(data.consignee_NPWP);
                $('.v_HsCode').html(data.hsCode);
                $('.v_SkepKawasan').html(data.SkepKawasan);
                $('.v_Nik').html(data.Nik);
                $('.v_StatusRemark').html(data.TrackingRemark);
                $('.v_F').html(data.BillingCode);
             //=================================================
                $('#ShipperName').val(data.shipper_name);
                $('#ShipperStreet1').val(data.shipper_address1);
                $('#ShipperStreet2').val(data.shipper_address2);
                $('#ShipperCity').val(data.shipper_city);
                $('#ShipperPhone').val(data.shipper_phone);
                $('#ConsigneeName').val(data.consignee_name);
                $('#ConsigneeStreet1').val(data.consignee_address);
                $('#ConsigneeStreet2').val('');
                $('#ConsigneeCity').val(data.consignee_city);
                $('#ConsigneePhone').val(data.consignee_phone);
                $('#NoSubPos').val(data.subpos);
                $('#PTName').val(data.consignee_name);
                $('#API').val(data.api_no);
                $('#Npwp').val(data.consignee_NPWP);
                $('#HsCode').val(data.hsCode);
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
    $('#title').html('LISTING MY JOB');
    clearTimeout(t);
    clearTimeout(intv_discusstion);
}

function a(){
    UIkit.modal("#modal_cancel").show();
}

function getdis(){      
    get_discusstion($('#KeyHawb').val());
}

function send_disscution(){
     var cidticket   = $('#KeyHawb').val();
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
          swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
      
          url = '<?php echo base_url();?>cas/Cas/Manifestupdate';
      
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
function addcoment_ticket(){
     
    UIkit.modal('#modal_comment').hide();
    UIkit.modal('#modal_updatetypeclear_respon',{bgclose:false,modal:false}).show();   
    
    }
function addcoment(sts_add){
    var cidhawb = $('#KeyHawb').val();
    var cidticket   = $('#idmyticket').val();
    var csts        = $('#ststicket').val();
    var ccontent    = tinyMCE.get('comment_ticket').getContent();//tinymce.get('comment_discuction').setContent('');
    var incall = $('#c_incall').val();
	var outcall = $('#c_outcall').val();
    var cas = $('#c_actionbycas').val();
	var ups = $('#c_actionbyups').val();
	var outcome_result = $('#c_outcome_result').val();
    var cststicket = $('#ststicket').val();
    
    var utyremark_ticket = $('#uty_remark_respon').val();
	var utyclearance_ticket      = $('select[name="uty_clearance_respon"] option:selected').val();
    var utyclearance_ticket_text = $('select[name="uty_clearance_respon"] option:selected').text();
    
    if(utyclearance_ticket == ' ' && sts_add==2){
             swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
             exit();
    }
          
    swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>cas/Cas/commentAdd';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({idticket:cidticket,contents:ccontent,sts:csts,jam_awal:incall,jam_akhir:outcall,
               bycas:cas,byups:ups,outcome:outcome_result,idhawb:cidhawb,ststicket:cststicket,
               stsadd:sts_add,utyclearance:utyclearance_ticket,utyremark:utyremark_ticket,utyclearance_text:utyclearance_ticket_text}),
       dataType: "JSON",
       success: function(data)
       {
           //==================== Sucsess ========
           swal("Message Send...!", "", "success");
           UIkit.modal('#modal_updatetypeclear_respon').hide();
           tinymce.get('comment_ticket').setContent('');
            $('#c_incall').val('');
        	$('#c_outcall').val('');
            $('#c_actionbycas').val('');
        	$('#c_actionbyups').val('');
            ststicket.setValue(' ', false);
            getDesc();
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
		        

/*				$input=$("#eve").val();
				$input2=$input;
				$pecah=explode("\n",$input2);
				$hasil=implode(',',$pecah);
				//$cval=explode("\n",$input);
				$cval=preg_replace('/\s+/', '', $hasil);*/
				
                        
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
        
        if(cval==''){ 
            list.ajax.url( "<?php echo base_url(); ?>"+"cas/Cas/ManifestList_myjob_assign/att/trias/"+date1+"/"+date2 ).load();
         }else{
            list.ajax.url( "<?php echo base_url(); ?>"+"cas/Cas/ManifestList_myjob_assign/"+zpt+"/"+cwhere+"/"+date1+"/"+date2 ).load();
         }    
    }
    
function cari2(){
        var date1=$("#uk_dp_start").val();
        var date2=$("#uk_dp_end").val();
        
        var tipeclearance=$("#fie").val();
        var kriteria=$("#eve").val();
		//var cval=$("#val").val();
		var input = $('#val').val().split('\n');
        var txtcari=input[0]+'_____'+input[1]+'_____'+input[2]+'_____'+input[3]+'_____'+input[4]+'_____'+input[5]+'_____'+input[6]+'_____'+input[7]+'_____'+input[8]+'_____'+input[9];
		var parameter=date1+"_____"+date2+"_____"+tipeclearance+"_____"+kriteria+"_____"+txtcari;
		
		if(input==''){
            list.ajax.url( "<?php echo base_url(); ?>cas/Cas/ManifestList_myjob_assign/att/trias/"+date1+"/"+date2 ).load();

		} else {
			list.ajax.url("<?php echo base_url();?>cas/Cas/ManifestList_search_job_assign/"+parameter).load();
		}
				//alert(kategori);
}


function addticket_ticking(){
    
    UIkit.modal('#modal_newticket').hide();
    UIkit.modal('#modal_updatetypeclear_ticket',{bgclose:false,modal:false}).show();
}

    
function addticket(sts_add){
    var cidhawb = $('#KeyHawb').val();
    var cname = $('#tname').val();
    var cphone = $('#tphone').val();
    var cemail = $('#temail').val();
	var incall = $('#incall').val();
	var outcall = $('#outcall').val();
    var cas = $('#actionbycas').val();
	var ups = $('#actionbyups').val();    
	var outcome_result = $('#outcome_result').val();
    var ccontent = tinyMCE.get('tcontent').getContent();//tinymce.get('comment_discuction').setContent('');
    
    var utyremark_ticket = $('#uty_remark_ticket').val();
	var utyclearance_ticket      = $('select[name="uty_clearance_ticket"] option:selected').val();
    var utyclearance_ticket_text = $('select[name="uty_clearance_ticket"] option:selected').text();
    
    if(utyclearance_ticket == ' ' && sts_add==2){
             swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
             exit();
    }
    
    swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>cas/Cas/ticketAdd';
      
    $.ajax({
       url : url,
       type: "POST",
       data: ({bycas:cas,byups:ups,idhawb:cidhawb,name:cname,phone:cphone,email:cemail,content:ccontent,incall:incall,
               outcall:outcall,outcome_result:outcome_result,
               stsadd:sts_add,utyclearance:utyclearance_ticket,utyremark:utyremark_ticket,utyclearance_text:utyclearance_ticket_text}),
       dataType: "JSON",
       success: function(data)
       {
           swal("Success Create Ticket...!", "", "success");
           get_listticket();
           UIkit.modal('#modal_updatetypeclear_ticket').hide();
           $('#form_create_ticket')[0].reset();
           tinymce.get('tcontent').setContent('');
           $('#form_updatetype_ticket')[0].reset();
           ut_statusproses.setValue(' ', false);
           getDesc();           
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
}

function showticket(cidticket){
            $('#idmyticket').val(cidticket);
            clearTimeout(t);
            $('.MyProses_1').show();
            $('.MyContent_1').hide(); 
            $("#shticket").html('<center><div class="proses_loader"></div><br />Processing...!</center>');            
            
                       t = setInterval(function(){
                    	   $("#getcomment").load('<?php echo base_url()?>cas/Cas/tarikticket'+'/'+cidticket);
                        }, 4000);                
          $.ajax({
            url : '<?php echo base_url()?>cas/Cas/ticketGet'+'/'+cidticket,
            success: function(data)
            {
                $("#shticket").html(data);
            }
           });
                                         
            $('.MyProses_1').hide();
            $('.MyContent_1').show();
            
            $('#v_listticket').hide();
            $('#v_detail_ticket').show(); 
            $('#v_comment').show();          
}

        function get_statustracking(){
            var hid=$('#KeyHawb').val();
            tblStatusTracking.ajax.url( "<?php echo base_url(); ?>"+"index.php/cas/Cas/StatusTrackingGet/"+hid ).load();
        }
        function get_typeclearance(){
            var hid=$('#KeyHawb').val();
            tblTypeClearance.ajax.url( "<?php echo base_url(); ?>"+"index.php/cas/Cas/TypeClearanceGet/"+hid ).load();
        }
        function get_attachment(){
            var hid=$('#KeyHawb').val();
            tblAttachment.ajax.url( "<?php echo base_url(); ?>"+"index.php/cas/Cas/AttachmentGet/"+hid ).load();
        } 
        function get_listticket(){
            var hid=$('#KeyHawb').val();
            tblTicket.ajax.url( "<?php echo base_url(); ?>"+"index.php/cas/Cas/TicketListGet/"+hid ).load();
        }       
        function updatestatusproses(){
          
          cproses = $('#ut_statusproses').val()//ut_statusproses.getValue();
          cstatusproses = cproses.split(' ').join('');
          
          if(cstatusproses == ''){
             swal("Oops... Status Proses is required", "Please Input Status Proses!...", "error");
             exit();
          }
          
          _ut_remark = $('#ut_remark').val();
          c_remark = _ut_remark.split(' ').join('');
          
          
          if(c_remark == ''){
             swal("Oops... Remark is required", "Remark Proses!...", "error");
             exit();
          }
          
          swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
          
          url = '<?php echo base_url();?>cas/Cas/StatusTrackingUpdate';
          var hid=$('#KeyHawb').val();
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
               $('.v_StatusRemark').html(data.remark);
               //UIkit.modal('#modal_updatestatus').hide();
               //$('#ut_statusproses').val(' ');
               ut_statusproses.setValue(' ', false);
               $('#ut_remark').val('');
               getDesc();
               //swal.close();
			   back();
			var modal = UIkit.modal("#modal_updatestatus");
   	   			   modal.hide();
			   
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}  

function updatetype(){
    
          fproses = ut_type.getValue();
          fstatusproses = fproses.split(' ').join('');
          
          if(fstatusproses == ''){
             swal("Oops... Type Clearance is required", "Please Input Type Clearance!...", "error");
             exit();
          }
          
          _fut_remark = $('#uty_remark').val();
          cf_remark = _fut_remark.split(' ').join('');
          
          if(cf_remark == ''){
             swal("Oops... Remark is required", "Remark Proses!...", "error");
             exit();
          }
    
          swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
               
          url = '<?php echo base_url();?>cas/Cas/TypeClearanceUpdate';
          var hid=$('#KeyHawb').val();
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
               ut_type.setValue(' ', false);
               //$('#uty_clearance').val(' ');
               //swal.close();
               getDesc();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                swal("Oops... Something went wrong!", "Proses Invalid!", "error");
            }
        });    
}

function download_attachment(id,file){
    cetakTri(file,"<?php echo site_url('cas/Cas/AttachmentDownload')?>");
}  

function back_listticket(){
        clearTimeout(t);
        $('#v_listticket').show();
        $('#v_detail_ticket').hide();
        get_listticket();
        //$("#getcomment").html('<center><div class="proses_loader"></div><br />Processing...!</center>');
}

function get_shipmentuser(){
    
         var Id      =$('#KeyHawb').val();
//            $('.MyProses_1').show();
//            $('.MyContent_1').hide();
//          $.ajax({
//            url : "<?php echo site_url('cas/Cas/shipmentUser')?>",
//            type: "POST",
//            data:({Hawb:Id,type_clearance:_typeclearance,pmk_182:_pmk182,statustracking:_statustacking}),
//            dataType: "JSON",
//            success: function(data)
//            {
//                $("#ShipmentUser").load(data);
//                $('.MyProses_1').hide();
//                $('.MyContent_1').show();
//            },
//            error: function (jqXHR, textStatus, errorThrown)
//            {
//                alert('Error get data from ajax');
//            }
//        });
        
        $("#ShipmentUser").load('<?php echo base_url()?>cas/Cas/shipmentUser'+'/'+Id+'/'+_typeclearance+'/'+_pmk182+'/'+_statustacking);
        
}

function open_attachment(nmfile){
        
        window.open("<?php echo base_url()?>file/manifest/"+nmfile);
}

function get_tlc(){
           $.ajax({
           url:'<?php echo base_url();?>cas/Cas/cmbStatusProses_filter'+'/'+_statustacking,
           dataType:'json',
           success: function(results){
                
                var select1 = document.getElementById("uty_clearance_ticket");// $("ut_statusproses");
                select1.options.length = 0 ;
                
                var select2 = document.getElementById("uty_clearance_respon");// $("ut_statusproses");
                select2.options.length = 0 ;
                
                var select = document.getElementById("ut_statusproses");// $("ut_statusproses");
                select.options.length = 0 ;
                
                for (var i =0; i<results.length; i++){
                    select.options[select.options.length] = new Option(results[i].name, results[i].id);
                    select1.options[select.options.length] = new Option(results[i].name, results[i].id);
                    select2.options[select.options.length] = new Option(results[i].name, results[i].id);
                }
                
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
       <span id="tombol_nav">
        <a class="md-btn md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="back();"><i class="md-list-addon-icon material-icons md-24 md-color-black">replay</i> Back To List My Job</a>
        
      <!--  <a class="md-btn md-btn-danger md-btn-small md-btn-wave-light waves-effect waves-button waves-light" onclick="a();"><i class="md-list-addon-icon material-icons md-24 md-color-white">close</i> Cancel Inquiry</a> -->
       </span> 
        <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
         <!--<i class="md-icon material-icons md-card-toggle">&#xE316;</i>
         <i class="md-icon material-icons md-card-close">&#xE14C;</i>-->
       </div>
       <h3 id="title" class="md-card-toolbar-heading-text">
         LISTING MY JOB
       </h3>
     </div>
   <div class="md-card-content">
   <span id="listing">
        <div class="uk-grid" >
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Start Date</label>
                    <input class="md-input" type="text" id="uk_dp_start" />
                </div>
            </div>
            <div  class="uk-width-large-1-4 uk-width-medium-1-3">
                <div class="uk-input-group">
                   <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                   <label for="uk_dp_end">End Date</label>
                  <input class="md-input" type="text" id="uk_dp_end" />
               </div>
            </div>
            <div  class="uk-width-medium-1-3 uk-width-large-1-3">
                
            </div>
            <div class="uk-width-medium-1-4 uk-width-large-1-4">
               <select name="fie" id="fie" data-md-selectize>
                  <option value="a.trackno">TRACKING NO</option>
                  <option value="b.mawb">MAWB</option>
                  <option value="b.hawb">HAWB</option>
               <!--   <option value="c.Keterangan">TYPE CLEARANCE</option> -->
                  <option value="e.UR_JNS"> TYPE CLEARANCE PMK 182</option>
                  <option value="b.consignee_name">CONSIGNEE NAME</option>
                  <option value="b.shipper_name">SHIPPER NAME</option>
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
               <label>Type Search<sup> (Enter Per Number / Max 10)</sup></label>
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
               <th>Mawb</th>
               <th>Hawb</th>
               <th>FlightDate</th>
               <th>TrackingNo</th>
               <th>CategoryHawb</th>
               <th>Type Clerance</th>
               <th>Base On PMK 182</th>
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
                    <span class="uk-text-small uk-text-muted uk-display-block">Value</span>
                    <span class="md-list-heading uk-text-large v_FOB" ></span>
                  </div>
                </li>
                <li>
                  <div class="md-list-content">
                    <span class="uk-text-small uk-text-muted uk-display-block">Billing Code</span>
                    <span class="md-list-heading uk-text-large v_F" ></span>
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
                      <span class="uk-text-small uk-text-muted uk-display-block">Package/Weight</span>
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
                      <span class="uk-text-small uk-text-muted uk-display-block">Type Clearance Based On PMK 182</span>
                      <span class="md-list-heading uk-text-large v_aju" ></span>
                   </div>
                </li>
                <li style="display: none;">
                   <div class="md-list-content">
                      <span class="uk-text-small uk-text-muted uk-display-block">Type Clearance</span>
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
                <li>
                   <div class="md-list-content">
                       <span class="uk-text-small uk-text-muted uk-display-block">Status Remark</span>
                       <span class="md-list-heading uk-text-large v_StatusRemark" ></span>
                   </div>
                </li>  
             </ul>
          </div>
          <div class="uk-width-large-1-1">
<!--              <table class="uk-table uk-text-nowrap uk-container-oveflow">
                  <thead>
                     <tr>
                        <th class="uk-width-2-10">Tracking No</th>
                        <th style="display:none;" class="uk-width-1-10">Package</th>
                        <th style="display:none;" class="uk-width-3-10">Wight</th>
                     </tr>
                   </thead>
                   <tbody id="MyTable">
                   
                  </tbody>
              </table>-->
               <h4>Tracking No</h4>
              <div class="uk-grid uk-overflow-container" id="list_track" style="max-height:150px;min-height:inherit">
                  
              </div>                                  
 <!--    <?php echo $this->load->view('cas/CAS/tabs');?> -->
          </div>
     </div>
     <br />                       
     <ul id="tab_detail" class="uk-tab" data-uk-tab="{connect:'#tabs_2'}">
       <li id="tab_tracking" class="uk-active" onclick="get_statustracking();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">find_replace</i> Tracking</a></li>
       <li id="tab_description" onclick="getDesc();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">description</i> Description</a></li>
       <li id="tab_update" onclick="getDesc();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">mode_edit</i> Update</a></li>
       <li id="tab_ticket" onclick="get_listticket();back_listticket();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">recent_actors</i> Ticket</a></li>
       <li id="tab_type" onclick="get_typeclearance();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">gavel</i> Type Clearance</a></li>     
       <li id="tab_attachment" onclick="get_attachment();"><a href="#" class="uk-text-primary"><i class="md-list-addon-icon material-icons md-24 uk-text-primary">attach_file</i> Attachment</a></li>
       <li id="tab_discusstion" onclick="getdis();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">question_answer</i> Discussion</a></li>
       <li id="tab_shipmentuser" onclick="get_shipmentuser();"><a href="#" class="uk-text-primary" ><i class="md-list-addon-icon material-icons md-24 uk-text-primary">supervisor_account</i> User Handle</a></li>
       <li id="tab_noa" onclick="get_noa();"><a href="#" class="uk-text-primary" ><i  class="md-list-addon-icon material-icons md-24 uk-text-primary">attach_money</i> NOA</a></li>
       <li id="tab_log" style="display: none;"><a href="#" class="uk-text-primary" ><i  class="md-list-addon-icon material-icons md-24 uk-text-primary">memory</i> Log Activity</a></li>
     </ul>
     <ul id="tabs_2" class="uk-switcher uk-margin">
        <li>
           <div class="uk-text-left">
                <a id="btnststrack" onclick="UIkit.modal('#modal_updatestatus').show();get_tlc();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
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
        
<!-- end modal -->               
       </li>
       <li>
     <span class="MyProses_1">
     <center><div class="proses_loader"></div><br />Processing...!</center>
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
                                                <span class="md-list-heading uk-text-large v_ConsigneeName"></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Address Street</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeStreet1"></span>
                                            </div>
                                        </li>
                                        <li style="display: none;">
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Consignee Address Buliding</span>
                                                <span class="md-list-heading uk-text-large v_ConsigneeStreet2"></span>
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
   <center><div class="proses_loader"></div><br />Processing...!</center>
</span>
<span class="MyContent_1">
       <form id="myformUpdate">
       <input type="hidden" id="KeyHawb" name="KeyHawb" value=""/>
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
                 <div class="uk-form-row" style="display: none;">
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
   <center><div class="proses_loader"></div><br />Processing...!</center>
</span>
<span class="MyContent_1">
<span id="v_listticket">
           <div class="uk-text-left">
                <a id="newticket" onclick="UIkit.modal('#modal_newticket',{bgclose:false,modal:false}).show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">assignment</i> Ticket</a>
           </div>
             <table id="tblTicket" class="uk-table uk-table-hover" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Ticket Id</th>
                            <th>Nama</th>                            
                            <th>Date</th>
                            <th>Content</th>
                            <th>Status</th>                            
                            <th>Create By</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                </table>
</span>
<span id="v_detail_ticket">                   
    <div id="shticket"></div>
           <div class="uk-text-left">
                <a  onclick="back_listticket();" class="md-btn md-btn-small md-btn-warning waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">update</i> Back To List Ticket</a>
                
                <a  onclick="UIkit.modal('#modal_comment').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
                <i class="md-list-addon-icon material-icons md-24 md-color-white">speaker_notes</i> Response</a>
                
           </div>         
        <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;"/>                    
    <span id="v_comment">     
    <input  name="idmyticket" type="hidden" class="md-input" id="idmyticket" > 
        <div style="display: none;"  class="parsley-row">
        </div>
        <div style="display: none;"  class="uk-width-large-1-2" >
            <div class="uk-form-row parsley-row">
                <label for="">Status Ticket<span class="req"> *</span></label>             
            </div>
        </div>
        <a style="display: none;" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light" href="#" onclick="addcoment();"><i class="material-icons md-24 md-color-white">send</i> Send</a>
        <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;"/> 
        <div class="chat_box touchscroll chat_box_colors_a" id="getcomment" style="background-image:url('<?php echo base_url();?>asset/images/background/bg1.png')">
        </div>
        <br />
        <br />
        <br />
    </span>
</span>
</span>
<!-------------------- MODAL CREATE COMMENT ----------------->
        
<!-- MODAL UPDATE STATUS & RESPONE -->                
        
<!-- end modal -->
<!-------------------- MODAL CREATE TICKET ----------------->
        
<!-- MODAL UPDATE STATUS & TICKET -->                
        
<!-- end modal -->
       </li>
<!-- TAB 4 -->
       <li>
           <div class="uk-text-left">
                <a  onclick="UIkit.modal('#modal_updatetypeclear').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
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
        
<!-- end modal -->
       </li>
       <li>
       
 <span class="MyProses_1">
   <center><div class="proses_loader"></div><br />Processing...!</center>
</span>
<span class="MyContent_1">
           <div class="uk-text-left">
                <a onclick="UIkit.modal('#modal_uploadattachment').show();" class="md-btn md-btn-small md-btn-primary waves-effect waves-button ">
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
            var hid=$('#KeyHawb').val()
    		swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    		var formData = new FormData($("#form_addattachment")[0]);
            formData.append('Hawb',hid);
           // ajax adding data to database
              $.ajax({
                url : "<?php echo site_url('cas/Cas/AddAttachment')?>",
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
                    $('#ua_jenis').val(' ');
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
              swal({title: "Processing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
          
              url = '<?php echo base_url();?>cas/Cas/AttachmentDelete';
          
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
 <!-- end modal -->          
</span>       
       </li>
       <li>
        <?php echo $this->load->view($discustion); ?>
       </li>
       <li> 
            <span class="MyProses_1">
                <center><div class="proses_loader"></div><br />Processing...!</center>
            </span>
            <span class="MyContent_1">
                <ul class="md-list md-list-addon uk-margin-bottom" id="ShipmentUser">
            
                </ul>
            </span>
       </li>
       <li>
        <?php echo $this->load->view($noa); ?>
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
        
       <div class="uk-modal" id="modal_updatetypeclear_ticket">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Update Status Tracking</h3>
              </div>
              <form id="form_updatetype_ticket" name="form_updatetype_ticket">
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
                         <div class="uk-width-medium-1-1"></div> 
                    <div class="uk-width-medium-1-1">
                    <div class="uk-form-row">
                     </div>
                     <div class="uk-form-row">
                       <label>Status Tracking</label>
                        <select name="uty_clearance_ticket" class="md-input" id="uty_clearance_ticket" required >
                        </select>
                     </div>
                     <!--<div class="uk-form-row">
                       <label>Status Tracking</label>
                       <select id="uty_clearance_ticket" name="uty_clearance_ticket" class="ut_statusproses" required>
                              <option value=" ">...</option>
                        </select>
                       <hr style="border: 1px rgba(50, 132, 208, 1) solid; margin-top: 2px;margin-bottom: 10px"/>
                     </div> -->
                     <div class="uk-form-row ">
                       <label>Remark</label>
                        <textarea id="uty_remark_ticket" name="uty_remark_ticket"  class="md-input"> </textarea>
                     </div>
                    </div>
                 </div>
               </form>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat " onclick="addticket(1)">Ignore</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="addticket(2)">Update</button>
              </div>
            </div>
        </div>

<div class="uk-modal" id="modal_updatetypeclear">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Update Type Clearance</h3>
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
                         <input class="md-input" type="text" id="uty_date" name="uty_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" readonly="true"/>
                     </div>
                     <div class="uk-form-row">
                       <label>Type Clearance</label>
                        <select id="uty_clearance" name="uty_clearance" class="uty_clearance" required>
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


<div class="uk-modal" id="modal_updatetypeclear_respon">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Update Status Tracking</h3>
              </div>
              <form id="form_updatetype_respon" name="form_updatetype_respon">
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
                    <div class="uk-form-row">
                     </div>
                     <div class="uk-form-row">
                       <label>Status Tracking</label>
                        <select name="uty_clearance_respon" class="md-input" id="uty_clearance_respon" required >
                        </select>
                     </div>
                    <!-- <div class="uk-form-row">
                       <label>Status Tracking</label>
                        <select id="ut_statusproses_respon" name="uty_clearance_respon" class="ut_statusproses" required>
                              <option value=" ">...</option>
                        </select>
                     </div> -->
                     <div class="uk-form-row ">
                       <label>Remark</label>
                        <textarea id="uty_remark_respon" name="uty_remark_respon"  class="md-input"> </textarea>
                     </div>
                    </div>
                 </div>
               </form>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat " onclick="addcoment(1)">Ignore</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="addcoment(2)">Update</button>
              </div>
            </div>
        </div>


<div class="uk-modal" id="modal_newticket">
        <form id="form_create_ticket" >
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Create New Ticket</h3>
              </div>
              <div class="md-card-content">
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
                            <input type="text" class="md-input" id="tname" name="tname" tabindex="1"  />
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label>Phone</label>
                            <input type="text" class="md-input" id="tphone" name="tphone" tabindex="2" />
                        </div>
                        <div class="uk-width-medium-1-3">
                            <label>Email</label>
                            <input type="text" class="md-input" id="temail" name="temail" tabindex="3" />
                        </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                            <div class="uk-width-medium-1-3">
                              <label>Time IN</label>
                         <input name="incall" type="text" class="md-input" id="incall" tabindex="4" >                         
                              </div>
                            <div class="uk-width-medium-1-3">
                              <label>Time OUT</label>
                                <input name="outcall" type="text" class="md-input" id="outcall" tabindex="5" >
                              </div>
                            <div class="uk-width-medium-1-3">
                              <label>Time Result</label>
                              <select name="outcome_result" class="md-input" id="outcome_result" required tabindex="6" >
                                   <option value="call">Call</option>
                                   <option value="Email">Email</option>
                                   <option value="invalid phone number">invalid phone number</option>
                                   <option value="Not active phone">Not active phone</option>
                                   <option value="Line is Busy">Line is Busy</option>
                              </select>
                              </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                           <!-- <label>Action By Cas</label>
                            <textarea id="actionbycas" name="actionbycas" class="md-input" rows="2" tabindex="7"> </textarea>
                            -->
                            <label>Action By CAS</label>
                              <select name="actionbycas" class="md-input" id="actionbycas" required >
                                   <option value="...">...</option>
                                   <option value="Check Mailbox For Doc">Check Mailbox For Doc</option>
                                   <option value="Follow up again">Follow up again</option>
                                   <option value="Called to be BC 2.3 Release Doc">Called to be BC 2.3 Release Doc</option>
                                   <option value="Doc to pass to Oprational">Doc to pass to Oprational</option>
                              </select>
                        </div>
                        <div class="uk-width-medium-1-2">
                          <!--  <label>Action By UPS</label>
                            <textarea id="actionbyups" name="actionbyups" class="md-input" rows="2" tabindex="8"> </textarea> -->
                          <label>Action By UPS</label>
                              <select name="actionbyups" class="md-input" id="actionbyups" required >
                                   <option value="...">...</option>
                                   <option value="UPS to provide correct Consignee Telephone">UPS to provide correct Consignee Telephone</option>
                                   <option value="UPS to check with Shipper/Importer">UPS to check with Shipper/Importer</option>
                                   <option value="UPS to ERN process">UPS to ERN process</option>
                                   <option value="UPS to work on abandon / destroy process">UPS to work on abandon / destroy process</option>
                                   <option value="UPS to follow up">UPS to follow up</option>
                              </select>  
                        </div>
                    </div>
                 <div class="uk-width-large-1-1">
                 &nbsp;      
                 </div> 
                 <div class="uk-width-large-1-1">
                     <div class="uk-form-row">
                        <textarea id="tcontent" name="tcontent" class="md-input" rows="8" tabindex="9"> </textarea>
                     </div>      
                 </div> 
                </div> 
              </div>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close" tabindex="11">No</button>
                <button type="button" onclick="addticket_ticking()" class="md-btn md-btn-flat md-btn-flat-primary" tabindex="10">Yes</button>
              </div>
            </div>
         </form>
        </div>


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
                         <input class="md-input" type="text" id="ut_date" name="ut_date" data-uk-datepicker="{format:'YYYY-MM-DD'}" readonly="true" />
                     </div>
                     <div class="uk-form-row">
                     </div>
                     <div class="uk-form-row">
                       <label>Status Tracking</label>
                        <select name="ut_statusproses" class="md-input" id="ut_statusproses" required >
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
        
        
<div class="uk-modal" id="modal_comment">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title"></h3>
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
                              <label>Time IN</label>
                         <input name="c_incall" type="text" class="md-input" id="c_incall" >                         
                              </div>
                            <div class="uk-width-medium-1-3">
                              <label>Time OUT</label>
                                <input name="c_outcall" type="text" class="md-input" id="c_outcall" >
                              </div>
                            <div class="uk-width-medium-1-3">
                              <label>Time Result</label>
                              <select name="c_outcome_result" class="md-input" id="c_outcome_result" required >
                                   <option value="call">Call</option>
                                   <option value="Email">Email</option>
                                   <option value="invalid phone number">invalid phone number</option>
                                   <option value="Not active phone">Not active phone</option>
                                   <option value="Line is Busy">Line is Busy</option>
                                   <option value="Not active phone">Not active phone</option>
                              </select>
                             </div>
                    </div>
                    <div class="uk-grid" data-uk-grid-margin>
                        <div class="uk-width-medium-1-2">
                           <!-- <label>Action By Cas</label>
                            <textarea id="actionbycas" name="actionbycas" class="md-input" rows="2" tabindex="7"> </textarea>
                            -->
                            <label>Action By CAS</label>
                              <select name="c_actionbycas" class="md-input" id="c_actionbycas" required >
                                   <option value="...">...</option>
                                   <option value="Check Mailbox For Doc">Check Mailbox For Doc</option>
                                   <option value="Follow up again">Follow up again</option>
                                   <option value="Called to be BC 2.3 Release Doc">Called to be BC 2.3 Release Doc</option>
                                   <option value="Doc to pass to Oprational">Doc to pass to Oprational</option>
                              </select>
                        </div>
                        <div class="uk-width-medium-1-2">
                          <!--  <label>Action By UPS</label>
                            <textarea id="actionbyups" name="actionbyups" class="md-input" rows="2" tabindex="8"> </textarea> -->
                          <label>Action By UPS</label>
                              <select name="c_actionbyups" class="md-input" id="c_actionbyups" required >
                                   <option value="...">...</option>
                                   <option value="UPS to provide correct Consignee Telephone">UPS to provide correct Consignee Telephone</option>
                                   <option value="UPS to check with Shipper/Importer">UPS to check with Shipper/Importer</option>
                                   <option value="UPS to ERN process">UPS to ERN process</option>
                                   <option value="UPS to work on abandon / destroy process">UPS to work on abandon / destroy process</option>
                                   <option value="UPS to follow up">UPS to follow up</option>
                              </select>
                        </div>
                    </div>
                 <div class="uk-width-large-1-1">
                 &nbsp;      
                 </div> 
                 <div class="uk-width-large-1-1">
                     <div class="uk-form-row">
                        <textarea id="comment_ticket" name="comment_ticket" class="md-input" rows="8"> </textarea>
                     </div>      
                 </div> 
                 <div class="uk-width-large-1-3">
                  <select id="ststicket" name="ststicket" required>
                    <option value=" ">...</option>
                  </select>      
                 </div> 
                </div> 
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button>
                <button type="button" class="md-btn md-btn-flat md-btn-flat-primary" onclick="addcoment_ticket()">Yes</button>
              </div>
            </div>
        </div>