<!-- dropify 
<link rel="stylesheet" href="<?php echo base_url();?>asset/assets/skins/dropify/css/dropify.css" />
<script src="<?php echo base_url();?>asset/assets/js/custom/dropify/dist/js/dropify.min.js"></script>
<!-- page specific plugins -->
<!-- datatables 
<script src="<?php echo base_url();?>asset/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<!-- datatables colVis 
<script src="<?php echo base_url();?>asset/bower_components/datatables-colvis/js/dataTables.colVis.js"></script>
<!-- datatables tableTools 
<script src="<?php echo base_url();?>asset/bower_components/datatables-tabletools/js/dataTables.tableTools.js"></script>
<!-- datatables custom integration 
<script src="<?php echo base_url();?>asset/assets/js/custom/datatables_uikit.min.js"></script>
<!--  datatables functions 
<script src="<?php echo base_url();?>asset/assets/js/pages/plugins_datatables.min.js"></script>
<!---->
<!-- tinymce 
<script src="<?php echo base_url();?>asset/bower_components/tinymce/tinymce.min.js"></script>
-->


  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url();?>asset/dist/handsontable.css">
  <link data-jsfiddle="common" rel="stylesheet" media="screen" href="<?php echo base_url();?>asset/dist/pikaday/pikaday.css">
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/pikaday/pikaday.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/moment/moment.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/zeroclipboard/ZeroClipboard.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/numbro/numbro.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/numbro/languages.js"></script>
  <script data-jsfiddle="common" src="<?php echo base_url();?>asset/dist/handsontable.js"></script>
  
<script data-jsfiddle="common" src="<?php echo base_url();?>asset/rate_app/js/search_rate_ocean.js"></script>

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
        {mawb: 'MAWB', ship_no: 'Ship No',pkgs : 'Pkgs',description : 'Description'
        ,weigth : 'Weigth',weigth_unit : 'Weigth Unit',shipper_name : 'S_name',shipper_street1 : 'S_Street',
        shipper_street2 : 'S_Building',shipper_city : 'S_City',consignee_name : 'C_name'
        ,consignee_street1 : 'c_sreet',consignee_strret2 : 'C_Building',consignee_city : 'C_city',value : 'Value'
        ,currency : 'Value Unit',tgl_fleight : 'Entry Date',tracking_no : 'Tracking No',Shipper_Country : 'S_Ctry'
        ,shipper_name2 : 's_3rd_name',bill_dt_name : 'bill_dt_name',Consignee_city_code : 'Code'}];
        
      data1 = [
        {mawb: '', ship_no: '',pkgs : '',description : ''
        ,weigth : '',weigth_unit : '',shipper_name : '',shipper_street1 : '',
        shipper_street2 : '',shipper_city : '',consignee_name : ''
        ,consignee_street1 : '',consignee_strret2 : '',consignee_city : '',value : ''
        ,currency : '',tgl_fleight : '',tracking_no : '',Shipper_Country : ''
        ,shipper_name2 : '',bill_dt_name : '',Consignee_city_code : ''}];        

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
    {data: 'mawb'},
    {data: 'ship_no'},
    {data: 'pkgs', type: 'numeric'},
    {data: 'description'},
    {data: 'weigth', type: 'numeric', format: '0,0.00'},
    {data: 'weigth_unit'},
    {data: 'shipper_name'},
    {data: 'shipper_street1'},
    {data: 'shipper_street2'},
    {data: 'shipper_city'},
    {data: 'consignee_name'},
    {data: 'consignee_street1'},
    {data: 'consignee_strret2'},
    {data: 'consignee_city'},
    {data: 'value', type: 'numeric'},
    {data: 'currency'},
    {data: 'tgl_fleight', type: 'date', dateFormat: 'M/D/YYYY'},
    {data: 'tracking_no'},
    {data: 'Shipper_Country'},
    {data: 'shipper_name2'},
    {data: 'bill_dt_name'},
    {data: 'Consignee_city_code'},
  ],
   cells: function(r,c, prop) {
        var cellProperties = {};
        if (r===0) cellProperties.readOnly = true;
        return cellProperties;        
    }
};

//hot = new Handsontable($container, {config});


$("#button_import").click(function () {
     
  var x=$('.htCore').find('.htInvalid').length;             
  if(x!=0){
     swal("Oops... Your Data Invalid", "Please Cek Data Is Red Backgound!...", "error");
     exit();
  }
//  $('#preload').show();
//  $('#button_import').hide();  
  
  var rmark = $('#remark').val();
    		document.getElementById('isidata').innerHTML = "";
			posisi=0;
			sukses=0;
			gagal=0;
			current=0;
    //console.log($container.data('handsontable').getData());
    
    var mydata = $container.data('handsontable').getData();
    mydata = gendata(mydata);
    
    console.log(mydata);
    
    AddItems('Cek Data...!','','0');
    $.ajax({
        url: "<?php echo base_url(); ?>/Cas/Cas/cek_data_manifest",
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
                    				url: '<?php echo base_url(); ?>Cas/Cas/insert_data_manifest',
                                    data:{
                                        "data": mydata,remark : rmark
                                    },
                    				dataType:"json",
                    				success:function(data)
                                    {
                                      AddItems('Sucsess Import Data Rate....!','','0'); 
                                      //$('#preload').hide();
                                      //$('#button_import').show();
                                      //$('#preview').html(data.preview);     
                    				},
                                    error: function (jqXHR, textStatus, errorThrown)
                                    {
                                      AddItems('error system please call team IT...!','error','0');
                                      //$('#preload').hide();
                                      //$('#button_import').show();
                                    }
                			    });
                             }else{
                                //$('#preload').hide();
                                //$('#button_import').show();
                             }
            
        },
        error: function () {
            console.log('Save error. POST method is not allowed on GitHub Pages. Run this example on your  own server to see the success message.');
        }
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
        for (i = 0; i < mydata.length; i++) {
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
</script>

<div class="uk-grid" data-uk-grid-margin>
    <div class="uk-width-medium-1-1">
        <div class="md-card" id="cont">
            <div class="md-card-toolbar" style="height: 55px;">
                <div class="md-card-toolbar-actions">
                    <a id="clear" class="md-btn md-btn-warning md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">add</i> New Data</a>
                  <!--  <a onclick="getload()" class="md-btn md-btn-success md-btn-small md-btn-wave-light waves-effect waves-button waves-light"><i class="md-list-addon-icon material-icons md-24 md-color-white">replay</i> Load Data</a> -->
                    <i class="md-icon material-icons md-card-fullscreen-activate" data-uk-tooltip="{pos:'left'}" title="maximaze">&#xE5D0;</i>
                </div>
                <h3 id="title" class="md-card-toolbar-heading-text">IMPORT DATA MANIFEST NON DOC</h3>
            </div>
                <div class="md-card-content">
                    <ul style="display: none;" class="uk-tab" data-uk-tab="{connect:'#tabs_1'}">
                    <li class="uk-active"><a href="#" onclick="getlist(1);"><i class="md-list-addon-icon material-icons md-24">add</i> Input</a></li>
                    <li><a href="#" onclick="getlist(2);"><i class="md-list-addon-icon material-icons md-24">list</i> History</a></li>
                    </ul>
                    <ul id="tabs_1" class="uk-switcher uk-margin">
                    <li>
                        <div style="display:none;" class="uk-form-row">
                        <label>Remark For All<span class="req"> </span></label>
                        <textarea class="md-input" rows="2" id="remark" name="remark"></textarea>
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
                        Listing
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