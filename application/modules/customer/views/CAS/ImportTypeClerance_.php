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

  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url();?>asset/dist/handsontable.css">
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url();?>asset/dist/pikaday/pikaday.css">
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/pikaday/pikaday.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/moment/moment.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/zeroclipboard/ZeroClipboard.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/numbro/numbro.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/numbro/languages.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/handsontable.js"></script>
  
<!--<script data-jsfiddle="common" src="<?php echo base_url();?>asset/rate_app/js/search_rate_ocean.js"></script> -->

 <!-- kendo UI -->
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/kendo-ui/styles/kendo.common-material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/bower_components/kendo-ui/styles/kendo.material.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>asset/rate_app/css/custom.css"/>
        <!-- kendo UI -->
    <script src="<?php echo base_url();?>asset/assets/js/kendoui_custom.min.js"></script>
    <!--  kendoui functions 
    <script src="<?php echo base_url();?>asset/assets/js/pages/kendoui.min.js"></script>
    -->
<script type="text/javascript">
var hot;
var arrdata = [];
var statusproses,$statusproses;
$(document).ready(function(){
    
    var date = new Date();
    var d = convertDate(date);
            
    $('#tanggal').kendoDatePicker({
      format: "yyyy-MM-dd"
    });
    
    $("#tanggal").data("kendoDatePicker").value(d);
    
    $('#preload').hide();
    var
      data = [
        {Hawb: 'Hawb',Date : 'Date Update Type Clearance',Note : 'Remark'}];
        
      data1 = [
        {Hawb: '',Date : '',Note : ''}];        

    var $container = $("#handsontable");
    
    var config = {
        data: data,
    //    minSpareRows: 1,
        autoWrapRow: true,
        colHeaders: true,
        rowHeaders: true,
        currentRowClassName: 'currentRow',
        currentColClassName: 'currentCol',
      //  fixedColumnsLeft: 5,
        fixedRowsTop: 2,
        columns: [
        {data: 'Hawb'},
        {data: 'Date', type: 'date', dateFormat: 'M/D/YYYY'},
        {data: 'Note'}
      ],
       cells: function(r,c, prop) {
            var cellProperties = {};
            if (r===0) cellProperties.readOnly = true;
            return cellProperties;        
        }
    };
    
    //hot = new Handsontable($container, {config});
    
    
    $("#button_import").click(function () {
      
      $('#statusproses').parsley().validate();
      var xxk=  $('#Sts').find('.md-input-danger').length; 
      if(xxk!=0){
         swal("Oops... Type Clearance is required", "Please Input Status Proses!...", "error");
         exit();
      }
      var x=$('.htCore').find('.htInvalid').length;             
      if(x!=0){
         swal("Oops... Your Data Invalid", "Please Cek Data Is Red Backgound!...", "error");
         exit();
      }
    //  $('#preload').show();
    //  $('#button_import').hide();  
      var ctxtstsproses = $("#statusproses option:selected").text();
      UIkit.modal.confirm('Are you sure update Type Clearance Shipment '+ctxtstsproses+' ?', function(){
        
      swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false});    
    
              var rmark = $('#remark').val();
              var cstsproses = $('#statusproses').val();
        		document.getElementById('isidata').innerHTML = "";
    			posisi=0;
    			sukses=0;
    			gagal=0;
    			current=0;
        //console.log($container.data('handsontable').getData());
        
        var mydata = $container.data('handsontable').getData();
        mydata = gendata(mydata);
        
        //console.log(mydata);
        
        AddItems('Cek Data...!','','0');
        $.ajax({
            url: "<?php echo base_url(); ?>/Cas/Cas/cek_TypeClerance",
            data: {
                "data": mydata
            }, //returns all cells' data
            dataType: 'json',
            type: 'POST',
            success: function (data) {
                			    var cek=true;
                                 for (var i =0; i<data.length; i++){
                                    cek=false;
                                    AddItems(data[i].text,'error','0');
                                 }
                                 if(cek){
                                  AddItems('Please wait, Proses Import Data...!','','0');   
                                    $.ajax({
                                        type: "POST",
                        				url: '<?php echo base_url(); ?>Cas/Cas/UpdateTypeClerance',
                                        data:{
                                            "data": mydata,remark : rmark,stsproses:cstsproses,txtstsproses:ctxtstsproses
                                        },
                        				dataType:"json",
                        				success:function(data)
                                        {
                                          AddItems('Sucsess Import Data Rate....!','','0'); 
                                          swal("Success Import Data...!", "", "success");     
                        				},
                                        error: function (jqXHR, textStatus, errorThrown)
                                        {
                                          AddItems('error system please call team IT...!','error','0');
                                          swal("Oops... Something went wrong!", "Please Cek Box Info...!", "error");
                                        }
                    			    });
                                 }else{
                                    swal("Oops... Something went wrong!", "Please Cek Box Info...!", "error");
                                 }
                
            },
            error: function () {
                console.log('Save error. POST method is not allowed on GitHub Pages. Run this example on your  own server to see the success message.');
            }
        });
      });
    });
    
    $("#handsontable").handsontable(config);
    
    $("#clear").click(function () {
        var load =[];
        Array.prototype.push.apply(load, data);
        Array.prototype.push.apply(load, data1);
        $container.handsontable('loadData',load);
    });
    
    $("#load").click(function () {
        UIkit.modal("#modal_loadrate").hide();
        tgl=$('#tanggal').val();
        ori=$('#org').val();
        dst=$('#dst').val();
        airlines=$('#airlines').val();
        
        load_processing();
        $.ajax({
                url: "<?php echo base_url(); ?>/front/Rate/getdataocean",
                data: ({tglvalid:tgl,origin:ori,destination:dst,vandor:airlines}),
                dataType: 'json',
                type: 'POST',
                success: function (res) {
                var load =[];
                    Array.prototype.push.apply(load, data);
                    Array.prototype.push.apply(load, res);
                    $container.handsontable('loadData',load);  
                    swal.close();                  
                },
                error: function () {
                    console.log('Save error. POST method is not allowed on GitHub Pages. Run this example on your  own server to see the success message.');
                }
        });
    });
//==================== TANGGAL ===================
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
//======================== LISTING TABEL ==========================
list = $("#list").DataTable({
                "bFilter": false,
                "processing": true,
                "serverSide": true,
                "order": [[ 2, "desc" ]],
                "ajax": {
                    "url": "<?php echo site_url('Cas/Cas/TypeClearanceList')?>",
                    "type": "POST",  
                },
                "columns": [
                { "data": "IdImport"},
                { "data": "ImportDate"},
                { "data": "IdStatus","class":"uk-hidden"},
                { "data": "Keterangan"},
                { "data": "UserId","class":"uk-hidden"},
                { "data": "UserName"},
                { "data": "Action"},
                ]
         });
//==========================================
       $.ajax({
           url: '<?php echo base_url();?>Cas/Cas/cmbTypeClearance',
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
            $('#Sts').parsley();
           }
       });
//=======================================

});

function AddItems(isi,pesan,tambah)
		{
			//=============================================================
			var mySel = document.getElementById("isidata"); 
            var myOption; 

            myOption = document.createElement("Option"); 
            myOption.text = isi; 
            myOption.value = isi; 
			if(pesan!=''){
				if (tambah=='1'){
					gagal=gagal+1;
		        }
				myOption.style = 'color:red;font-family:courier new;'; 
			}else{
				if (tambah=='1'){
					sukses=sukses+1;
				}
	            myOption.style = 'color:white;font-family:courier new;'; 					
			}
			mySel.add(myOption);	
            bawah();		
		}
        
function bawah(){
    		var objDiv = document.getElementById("isidata");
    		objDiv.scrollTop = objDiv.scrollHeight;
    		return false;
    	}        

function getload(){
     UIkit.modal("#modal_loadrate").show();
}

function gendata(mydata){
    arrdata = [];
    var Rec = '';
        for (i = 0; i < mydata.length; i++){
         child= mydata[i];
         var Rec = '';
            for (j = 0; j < child.length; j++){
                var v = mydata[i][j];
                if(v==null){
                    v='';
                }
                Rec = Rec+v+'||||xxx||||';
            }
        dataku ={dat:Rec}            
        arrdata.push(dataku);
        }
        return arrdata
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
        list.ajax.url( "<?php echo base_url(); ?>"+"Cas/Cas/TypeClearanceList/"+zpt+"/"+cwhere+"/"+date1+"/"+date2 ).load();    
    }
    
function print_(id='',ctk=''){
    switch (ctk) {
    case '1':
        cetakPrev('4|'+id,"<?php echo site_url('Cas/Crptcas/rpt_ImportTypeClerance')?>","#preview_his"); 
        UIkit.switcher('#h_tab').show(2);
        break;
    case '2':

        cetakTri('1|'+id,"<?php echo site_url('Cas/Crptcas/rpt_ImportTypeClerance')?>");     
        break;
    case '3':

        cetakTri('2|'+id,"<?php echo site_url('Cas/Crptcas/rpt_ImportTypeClerance')?>"); 
        break;
    }
}
    
</script>
<style>
.md-list > li{
    padding : 2px 1px;
}
.md-list .uk-text-large{
    font-size : 13px;
}
.md-list .uk-text-small{
    font-size : 11px;
}
</style>
<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-medium-1-1">
        <div class="md-card" id="cont">
            <div class="md-card-toolbar" style="height: 55px;">
                <div class="md-card-toolbar-actions">
                    
                  <!--  <a onclick="getload()" class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">replay</i> Load Data</a> -->
                    <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
                </div>
                <h3 id="title" class="md-card-toolbar-heading-text">IMPORT TYPE CLEARANCE</h3>
            </div>
                <div class="md-card-content">
                    <ul id="h_tab" class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                    <li class="uk-active"><a href="#"><i class="md-list-addon-icon material-icons md-24">add</i> Input</a></li>
                    <li><a href="#" ><i class="md-list-addon-icon material-icons md-24">list</i> History Import</a></li>
                    <li style="display: none;"><a href="#" ><i class="md-list-addon-icon material-icons md-24">list</i> Preview </a></li>
                    </ul>
                    <ul id="tabs_1" class="uk-switcher uk-margin">
    <!-- TAB SATU -->
                    <li>
                    <div class="uk-text-right" style="margin-bottom: -55px;">
                        <a id="clear" class="md-btn md-btn-warning md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">add</i> New Data</a>
                    </div>
                    <br />
                                <div class="uk-width-large-1-2">
                                    <ul class="md-list">
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">User Name</span>
                                                <span class="md-list-heading uk-text-large" ><?php echo $this->session->userdata('cs_FullName'); ?></span>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="md-list-content">
                                                <span class="uk-text-small uk-text-muted uk-display-block">Date</span>
                                                <span class="md-list-heading uk-text-large " ><?php echo date('Y-m-d'); ?></span>
                                            </div>
                                        </li>                                        
                                    </ul>
                                </div>
                        
                        <div style="display:none;" class="uk-form-row">
                        <label>Remark For All<span class="req"> </span></label>
                        <textarea class="md-input" rows="2" id="remark" name="remark" ></textarea>
                        </div>
                        <div class="uk-width-large-1-2" id="Sts">
                         <div class="uk-form-row parsley-row">
                           <label for="">Type Clearance<span class="req"> *</span></label>
                           <select id="statusproses" name="statusproses" required>
                              <option value=" ">...</option>
                           </select>
                         </div>
                        </div>
                        <br />
                        <div id="handsontable" style="width: 100%; height: 100%; overflow: hidden"></div>
                        <br />
                        <span id="preload"><div class="md-preloader"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" height="32" width="32" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div> Processing...</span>
                        <a id="button_import" class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">system_update_alt</i> Proses Import</a>
                        <div class="uk-progress uk-progress-striped uk-active uk-progress-small">
                        <div id="bar" class="uk-progress-bar" style="width: 0%;"></div>
                        </div>
                        <br />
                        <select name="isidata" id="isidata" multiple="multiple" style="overflow: hidden;width:100%;height:280px;background-color:#000000;border:0px" disabled="true">
            		    </select>
                    </li>
                    <li>
<!-- LISTING HISTORY IMPORT -->                    
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
               <select name="fie" id="fie" data-md-selectize>
                  <option value="b.TypeName">STATUS PROSES</option>
                  <option value="a.UserName">USER NAME</option>
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
             <div class="uk-width-medium-1-3 uk-width-large-1-3 ">
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
        <table id="list" class="uk-table uk-table-hover" cellspacing="0" width="100%">
          <thead>
            <tr>
               <th>ID IMPORT</th>
               <th>IMPORT DATE</th>
               <th>ID STATUS</th>
               <th>STATUS PROSES</th>
               <th>USER ID</th>
               <th>USER NAME</th>
               <th>ACTION</th>
            </tr>
          </thead>
        </table>
<!-- END LIST -->
                    </li>
                    <li>
                    <div class="uk-text-left">
                        <a onclick="UIkit.switcher('#h_tab').show(1);" class="md-btn md-btn-warning md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">replay</i>Back To List</a>
                    </div>
                    <br />
                    <span id="preview_his"></span>
                    </li>
                    </ul>
                </div>
        </div>
    </div>
</div>

<!-------------------- MODAL LOAD RATE ----------------->
        <div class="uk-modal" id="modal_loadrate">
            <div class="uk-modal-dialog">
              <div class="uk-modal-header">
                 <h3 class="uk-modal-title">Load Rate</h3>
              </div>
                <div class="uk-grid uk-grid-divider">
                    <div class="uk-width-4-10">
                        <div class="md-input-wrapper">
                            <label for="kUI_datepicker_a" class="uk-form-label">Date Active</label>
                            <input id="tanggal" />
                        </div>
                        <div class="md-input-wrapper">
                            <label>Origin</label>
                            <input class="md-input label-fixed k-input"  type="text" id="origin" name="origin" >
                            <input type="text" id="org" name="org" hidden>
                            <span class="md-input-bar"></span>
                        </div>
                        <div class="md-input-wrapper">
                            <label>Destination</label>
                            <input class="md-input label-fixed k-input"  type="text" id="destination" name="destination" >
                            <input type="text" id="dst" name="dst" hidden>
                            <span class="md-input-bar"></span>
                        </div>
                        <div class="md-input-wrapper">
                            <label>Airlines</label>
                            <input class="md-input label-fixed k-input"  type="text" id="airlines" name="airlines">
                            <span class="md-input-bar"></span>
                        </div>
                        <span class="uk-form-help-block md-color-indigo-900" style="padding: 0px; margin: 0px;">Leave blank for ALL Airlines</span>
                    </div>
                <!--    en of 4-10-->
                    <div class="uk-width-6-10">
                        <div id="priview">
                            <ul class="md-list md-list-addon md-list-right">
                
                            </ul>
                        </div>
                        <div id="viewOrigin">
                            <ul class="md-list md-list-addon md-list-right">
                
                            </ul>
                        </div>
                        <div id="viewdest">
                            <ul class="md-list md-list-addon md-list-right">
                
                            </ul>
                        </div>
                    </div>
                </div>
              <div class="uk-modal-footer uk-text-right">
                <button type="button" class="md-btn md-btn-flat uk-modal-close">No</button><button type="button" id="load" class="md-btn md-btn-flat md-btn-flat-primary">Ok</button>
              </div>
            </div>
        </div>