<link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/jquery.dataTables.min.css" media="all">
<script src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>asset/assets/js/custom/datatables_uikit.min.js"></script>
  
  <link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/jquery-ui.css">
  <link rel="stylesheet" href="<?php echo base_url();?>asset/ordering_status/themes.css">
  
  <script src="<?php echo base_url();?>asset/ordering_status/jquery-ui.js"></script>
 
  <script type="text/javascript">
    var tbl_list;
 $(document).ready(function() {    
    
          tbl_list = $('#tbl_list').DataTable({ 
            "processing": true, //Feature control the processing indicator.
			"bInfo": true,
			"bFilter":false,
			//"order":[[4,"desc"],[3,"desc"],[1,"asc"]],
 "lengthMenu": [[10, 60, 100, -1], [10, 60, 100, "All"]],
            "serverSide": true, //Feature control DataTables' server-side processing mode
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('cas/Gtln_report_manifest/list_manifest_non_4xx')?>",
                "type": "POST",
            },
            "columns": [
            { "data": "no","orderable":false,"visible":true },
			{ "data": "flight_date"},
            { "data": "mawb"},
			{ "data": "hawb"},
			{ "data": "shipper_name"},
			{ "data": "consignee_name"},
			{ "data": "mawb"},
			{ "data": "mawb","orderable":false,"visible":true}
            ]
          });  
  
$('#tbl_list tbody').on('dblclick', 'tr', function () {
            var tr = $(this).closest('tr');
            var row = tbl_list.row(tr);
		   var id=row.data().Id_team;
		   edit_data(id);
    //Redirect if click
    //window.location.href = "<?php echo base_url();?>hawb/Awb/awb_detail/"+row.data().Hawb;
	//sidebarNonAktif();
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
        
    //=======type clerance
         $.ajax({
           url: '<?php echo base_url();?>dashboard/Dashboard/cmbStatusProses',
           dataType: "json",
           success: function(data){
            console.log(data);
              $statusproses =$('#statusproses').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            statusproses = $statusproses[0].selectize;
           }
       });
	  /* end of type clerance*/
    //=======type clerance
         $.ajax({
           url: '<?php echo base_url();?>dashboard/Dashboard/pmk182',
           dataType: "json",
           success: function(data){
            console.log(data);
              $sontent_pmk =$('#pmk182').selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false
				});
            sontent_pmk = $sontent_pmk[0].selectize;
           }
       });
	  /* end of type clerance*/
	 
	 
});

//reload/refresh table list
function reload_tbl_list()
    {
      tbl_list.ajax.reload(null,false); //reload datatable ajax 
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

#tblTicket tbody {
    cursor:pointer;
}

.selectize-control .selectize-input.disabled{
    background-color : #d8d8d8;
}
/* end selected colomn --*/
 
  #btn{
    background: url('<?php echo base_url();?>asset/ordering_status/add.png') no-repeat center center;
    cursor: pointer;
  }
.donlot_excel{
	cursor:pointer;
	transition:all 0.6s;
}
.donlot_excel:hover{
    -webkit-transform:rotate(20deg);
    -moz-transform:rotate(20deg);
    -o-transform:rotate(20deg);
	transform:rotate(20deg);
}
  #sortable1 li, #sortable2 li {
    margin: 0 5px 5px 5px;
    padding: 5px;
    font-size: 1.2em;
    width: 95%;
	cursor:move;
  }
  .connectedSortable{
	border: 1px solid #eee;
    width: 46%;
    list-style-type: none;
    margin: 0;
    padding: 5px 0 0 0;
    float: left;
    margin-right: 15px;
	  padding-bottom:20px !important;
	  overflow:auto;
	  max-height:380px;

  }
  
 #sortable1{
			background: #fff;
			border: 2px #FFC58A solid;
 }
 #sortable2{
	 background: #fff;
	 border: 2px #4cd165 solid;
 }
 .selectize-input{
	 border:1px #00acc1 solid !important;
 }
 .dt-uikit-header{
	 display:none;
 }
  </style>

   
<style>
.uk-badge-circle{
	margin-top:-10px;
	font-size:14px;
}
td.details-control {
    background: url('<?php echo base_url();?>asset/ordering_status/add.png') no-repeat center center;
    cursor: pointer;
}
tr.details td.details-control {
    background: url('<?php echo base_url();?>asset/ordering_status/minus.png') no-repeat center center;
}
.child-table{
	border:1px #F0F0F0 solid;
	margin-left:2px;
	cursor:ns-resize;
}
.child-table thead tr td{
	width:68px;
	color:#FFF;
}

.focus-detail{
	background-color:#00FF80;
}
.lostfocus-detail{
	background-color:transparent;
}
.box-detail{
	max-height:300px;
	border-bottom:2px #999 dashed;
	border:1px red dashed;
}
.angka{
	margin-left:8px;
}
<!-- FOR TABLE-->
table.dataTable.stripe tbody tr.odd, table.dataTable.display tbody tr.odd {
    background-color: rgba(0, 0, 0, .085);
}
table.dataTable.stripe tbody tr.odd:hover,table.dataTable.display tbody tr.odd:hover {
    background-color:#FFCB97;
}
table.dataTable.stripe tbody tr.even:hover,table.dataTable.display tbody tr.even:hover {
    background-color:#FFCB97;
}

</style>


<div class="md-card uk-margin-medium-bottom">
  <div class="md-card-content">
  <h3>GTLN - Manifest Status Non- 4xx </h3> 
<hr />
  <!--header-->
 <!-- <form method="post" action="<?php// echo base_url();?>cas/Gtln_report_manifest/generate_excel">-->
  <form method="post" action="<?php echo base_url();?>cas/Gtln_report_manifest/phpexcel">
  <div class="uk-grid" >
<?php
$date_now=date('Y-m-d');
$date_before=date('Y-m-d',strtotime('-9 days'));
?>

            <div  class="uk-width-medium-3-10">
                <div class="uk-input-group">
                    <span class="uk-input-group-addon"><i class="uk-input-group-icon uk-icon-calendar"></i></span>
                    <label for="uk_dp_start">Select Date</label>
                    <input class="md-input" type="text" id="uk_dp_start" value="<?php echo $date_now ?>" name="tgl1"/>
                </div>
            </div>
            
       <div  class="uk-width-medium-2-10" style="padding-top:20px">
        <button type="submit" class="md-btn md-btn-mini md-btn-success" style="margin-top:-20px"><i class="material-icons md-24 md-color-grey-50">cloud_download</i> Generate Excel</button>
      
      </div>
      
    
    <div style="height:300px">
    
    </div>
             
    </div></form>
   


      
 <!-- end header-->
    
  </div>
            </div>
            
            
