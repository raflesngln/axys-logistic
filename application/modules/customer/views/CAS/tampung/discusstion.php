<script type="text/javascript">
var intv_discusstion;
$(document).ready(function(){
    
            tinymce.init({
               // skin_url: '<?php echo base_url();?>asset/assets/skins/tinymce/material_design',
                selector: "#comment_discuction",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                menubar: false,
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent "
            });
    
    });

function get_discusstion(cidhawb){
    intv_discusstion = setInterval(function(){
           $("#chat").load('<?php echo base_url()?>cas/Cas/tarikchat'+'/'+cidhawb);
    }, 4000);
}

function adddiscuction(cid,ccontent){     
    swal({title: "Prosesing...!",text: '<center><div class="proses_loader"></div></center>',html: true,showConfirmButton: false}); 
    url = '<?php echo base_url();?>cas/Cas/discuctionAdd';
 		var hawb      =$('#KeyHawb').val();
		var tipeclear=_typeclearance
		var pmk182=_pmk182
		var statustrack=_statustacking
    $.ajax({
       url : url,
       type: "POST",
       data: ({idticket:cid,contents:ccontent,hawb:hawb,tipeclear:tipeclear,pmk182:pmk182,statustrack:statustrack}),
       dataType: "JSON",
       success: function(data)
       {
           //==================== Sucsess ========
           swal("Message Send...!", "", "success");
           tinymce.get('comment_discuction').setContent('');
       },
       error: function (jqXHR, textStatus, errorThrown)
       {
           swal("Oops... Something went wrong!", "Proses Invalid!", "error");
       }
    });
}

function discuss_read(){
	var hawb   = $('#KeyHawb').val();
      $.ajax({
		   type: "POST",
           url : "<?php echo site_url('dashboard/Dashboard/discuss_read')?>",
		    data: "hawb="+hawb,
           dataType: "json",
           success: function(data){
				console.log(data);	 
				//alert('data terupdate');  
              }
       }); 
 }

</script>
<style>

</style>
        <div style="margin-bottom: 5px;">
        <textarea id="comment_discuction" name="comment_discuction"></textarea>
        </div>
        <a class="md-btn md-btn-primary md-btn-small md-btn-wave-light waves-effect waves-button waves-light" href="#" onclick="send_disscution();"><i class="material-icons md-24 md-color-white">send</i> Send</a>
        <div class="chat_box touchscroll chat_box_colors_a" id="chat" style="background-image:url('http://localhost/erp/asset/images/background/bg1.png')">
        </div>