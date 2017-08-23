<style>
#aktif li,#nonaktif li{
	list-style:none;
}
.idmn1,.idmn2{
	background-color:transparent;
	border:none;
	cursor:pointer;
}
.idmn1:hover,.idmn2:hover{
	color:red;
	background-color:#F3F3F3;
}
</style>

<div class="md-card">
                        <div class="md-card-content truncate-text">
                          



<div class="uk-grid">
 

    
    
 
<div class="uk-width-medium-1-2">
      <span class="uk-badge uk-badge-warning">LIST MENU ROLE</span>
       <ul id="nonaktif">
  <?php 
 foreach($all as $row){
 ?>  
<li><button value="<?php echo $row->Noid;?>" id="<?php echo $row->Noid;?>" name="idmenu1[]" class="idmn1" type="button" onclick="pindah1(this)"><i class="material-icons md-color-green-A700">add_box</i></button><input type="hidden" class="myid1" value="<?php echo $row->Keterangan?>" /><?php echo $row->Keterangan?></li>
 <?php } ?>
      </ul>
</div>


<div class="uk-width-medium-1-2"  style="border-left:1px #CCC solid">
      <span class="uk-badge uk-badge-warning"> ACTIVE ROLE</span>
       <ul id="aktif">
       
  <?php 
 foreach($aktif as $dt){
 ?>  
      <li><button value="<?php echo $dt->Noid;?>" id="<?php echo $dt->Noid;?>" name="idmenu2[]" class="idmn2" type="button" onclick="pindah2(this)"><i class="material-icons md-color-red-A700">clear</i></button><input type="hidden" class="myid2" value="<?php echo $dt->Keterangan?>" /><?php echo $dt->Keterangan?></li>
 <?php } ?>
      </ul>
</div>



</div>




                        </div>
                        
                    </div>
                    