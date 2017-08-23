<!-- inputmask -->
<script src="<?php echo base_url();?>asset/bower_components/jquery.inputmask/dist/jquery.inputmask.bundle.js"></script>

<script type="text/javascript">
$(document).ready(function(){
    
});

function get_noa_(cidhawb){
    
          var Id=cidhawb;
          if(Id == ''){
            exit;
          }
          
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
                $('#noa_kurs').val(data.ndpbm);
                $('#noa_fob').val(data.FOB);
                $('#noa_freight').val(data.FreightCost);
                $('#noa_insurance').val(data.insurance);
                $('#noa_bm').val(data.bm_persen);
                $('#noa_ppnbm').val(data.ppnBM_persen);
                $('#noa_ppn').val(data.ppn_persen);
                $('#noa_pph').val(data.pph_persen);
//                $('#noa_fob_r').val(data.pph_persen);
//                $('#noa_freight_r').val(data.pph_persen);
//                $('#noa_insurance_r').val(data.pph_persen);
                $('#noa_cif').val(data.CIF);
                $('#noa_h_bm').val(data.bm_value);
                $('#noa_h_ppnbm').val(data.ppnBM_value);
                $('#noa_h_ppn').val(data.ppn_value);
                $('#noa_h_pph').val(data.pph_value);
                $('#noa_h_pdri').val(data.TotalTax);
                 
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

</script>
<style>

</style>
<span class="MyProses_1">
   <center><div class="proses_loader"></div><br />Processing...!</center>
</span>
<span class="MyContent_1">
       <form id="myformUpdate">
       <br />
       <div class="uk-grid ">
              <div class="uk-width-medium-1-2">
               <div class="uk-form-row">
                 <label>Kurs NDPBM</label>
                 <input type="text" id="noa_kurs" name="noa_kurs" value=" " class="md-input"/>
               </div>
               <div class="uk-form-row"> 
               </div>
                    <div class="uk-grid ">
                        <div class="uk-width-medium-1-1">
                         <div class="uk-form-row ">
                           <label>FOB(USD)</label>
                            <input type="text" id="noa_fob" name="noa_fob" value=" " class="md-input"/>
                         </div>
                         <div class="uk-form-row">
                           <label>Freigh(USD)</label>
                            <input type="text" id="noa_freight" name="noa_freight" value=" " class="md-input"/>
                         </div>
                         <div class="uk-form-row">
                           <label>Insurance(USD)</label>
                            <input type="text" id="noa_insurance" name="noa_insurance" value=" " class="md-input"/>
                         </div>
                        </div>
                        <div class="uk-width-medium-1-1" style="display:none">
                         <div class="uk-form-row ">
                           <label>FOB(RUPIAH)</label>
                            <input type="text" id="noa_fob_r" name="noa_fob_r" value=" " class="md-input"/>
                         </div>
                         <div class="uk-form-row">
                           <label>Freigh(RUPIAH)</label>
                            <input type="text" id="noa_freight_r" name="noa_freight_r" value=" " class="md-input"/>
                         </div>
                         <div class="uk-form-row">
                           <label>Insurance(RUPIAH)</label>
                            <input type="text" id="noa_insurance_r" name="noa_insurance_r" value=" " class="md-input"/>
                         </div>
                        </div>
                    </div>
                 <div class="uk-form-row">
                 </div>
                 <div class="uk-form-row">
                    <label>Nilai Pabean / CIF</label>
                    <input type="text" id="noa_cif" name="noa_cif" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>Bea Masuk</label>
                    <input type="text" id="noa_bm" name="noa_bm" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>PPN BM</label>
                    <input type="text" id="noa_ppnbm" name="noa_ppnbm" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>PPN 10%</label>
                    <input type="text" id="noa_ppn" name="noa_ppn" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                    <label>PPH</label>
                    <input type="text" id="noa_pph" name="noa_pph" value=" " class="md-input"/>
                 </div>
               </div>
               <div class="uk-width-medium-1-2" style="border-left:1px solid #ddd">
                 <div class="uk-form-row">
                   <label>BM Value</label>
                    <input type="text" id="noa_h_bm" name="noa_h_bm" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>PPN BM Value</label>
                    <input type="text" id="noa_h_ppnbm" name="noa_h_ppnbm" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>PPN Value</label>
                    <input type="text" id="noa_h_ppn" name="noa_h_ppn" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>PPH Value</label>
                    <input type="text" id="noa_h_pph" name="noa_h_pph" value=" " class="md-input"/>
                 </div>
                 <div class="uk-form-row">
                   <label>Bea Masuk & PDRI</label>
                    <input type="text" id="noa_h_pdri" name="noa_h_pdri" value=" " class="md-input"/>
                 </div>
               </div>
            </div> 
       </form>
</span>