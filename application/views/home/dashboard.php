<style>
/*LINE*/

.howto li{
    height: 130px;
    border-left:2px #da937c solid;
	margin-top:3px;
}

.hownomor{
    height: 50px;
    width: 50px;
    border-radius: 100px;
    background-color: #FF5722;
    color: #FFF;
	font-family:"Lucida Console", Monaco, monospace;
	font-size:large;
    padding: 13px 0px 0px 18px;
    margin-left: -27px;
    box-shadow: 4px 3px 15px #907f79;
}
.howcontent{
    background-color: #FFF;
    margin-left: 6%;
    padding: 10px;
    margin-top: -8%;
    box-shadow: 8px 5px 20px #d0c4c0;
	border:none;
}
/* arrow */
.howcontent::after{
content: " ";
    position: absolute;
    height: 50px;
    width: 50px;
    background-color: #ffffff;
    margin-left: -15px;
    margin-top: -70px;
    z-index: -1;
    -ms-transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    /* border-radius: 200% 0px 0px 200%; */
    /* border: 1px #FF5722 dotted; */
}
/* end of list history */

hr.devider-style {
    border-top: 1px solid rgba(0, 0, 0, 0.12);
    text-align: center;
    width: 50%;
    margin: 0px auto;
    border: 1px rgba(0, 0, 0, 0.12) dotted;

}
hr.devider-style:after {
    content: ' §';
    display: inline-block;
    position: relative;
    top: -14px;
    padding: 0 10px;
    background: #ececec;
    color: #8c8b8b;
    font-size: 20px;
    -webkit-transform: rotate(60deg);
    -moz-transform: rotate(60deg);
    transform: rotate(60deg);
}

/*.box-card{
	margin-bottom:10px;
}
.card{
	background:#FFF;
	position:relative;
}*/
.md-50 {
    font-size: 50px;
    text-align: center;
    margin-left: 30%;
}
.how-box {
    min-height: 242px;
    padding-top: 5px;
}

#aboutkanan{
	padding:10px 8px 20px 10px;
	background:white;
	line-height:30px;
}
.img-about{
	width:400px !important;
	max-width: 130%;
	height:280px;
}
</style>

<div class="row">
<!-- <hr class="devider-style"> -->
</div>

<div class="row">
<h2 align="right" class="judul"> HOW TO USE OUR SERVICE  </h2>
<hr style=" border:1px #795548 solid; width:120px; float:right" />
</div>   
    
<!-- custom HOWTO-->
<div class="row">


<div class="col s12 m3 howkiri">
<div class=" col s10 m10">
<img src="<?php echo base_url();?>asset/images/howto.png" width="320" height="420" />
</div>
</div>
    
<div class="col s12 m9 howkanan">
    <ul class="howto">
		
        <li>
                <div class="itemhow">
                <div class="hownomor">1</div>
                <div class="howcontent">
                <p><i class="material-icons md-30">touch_app</i> Pilih Layanan</p>
                <p>Layanan kami dimulai dari sewa truk, kontainer, jasa pindahan, pengiriman kila, dan jasa expedisi.</p>
                </div>
                </div>
        </li>
        <li>
                <div class="itemhow">
                <div class="hownomor">2</div>
                <div class="howcontent">
                <p><i class="material-icons md-30">settings_phone</i> Hubungi Vendor</p>
                <p>Fleksibilitas untuk menawar atau mengecek ketersediaan layanan berdasarkan jadwal pesanan.</p>
                </div>
                </div>
        </li>
        <li>
                <div class="itemhow">
                <div class="hownomor">3</div>
                <div class="howcontent">
                <p>            
            <i class="material-icons md-30">content_paste</i> 
            Reservasi dan Pembayaran</p>
                <p>Invoice dikirim secara otomatis ke email pelanggan berdasarkan kesepakatan harga. </p>
                </div>
                </div>
        </li>
        <li>
                <div class="itemhow">
                <div class="hownomor">4</div>
                <div class="howcontent">
                <p><i class="material-icons md-24">place</i> Kirim dan Pantau Pesanan</p>
                <p>Layanan kami dimulai dari sewa truk, kontainer, jasa pindahan, pengiriman kila, dan jasa expedisi.</p>
                </div>
                </div>
        </li>
        </ul>
    </div>          
    
          
    </div>
<!--end custom HOWTO-->
  
  
  <!-- ABOUT US-->
 <div class="row">
<div class="col s12 m8" id="aboutkanan">
<h2>ABOUT US</h2>
<hr style=" border:1px #795548 solid; width:120px;" />
Kami membantu menangani logistik anda. Bagaimana caranya? Kami bekerjasama dengan penjual online ataupun perusahaan untuk menjemput barang yang akan dikirim dengan menggunakan jasa logistik yang terpilih. Shipper akan mengangkat tenaga manusia untuk menjadi armada kurir penjemput barang-barang tersebut. Dengan adanya Shipper, penjual online atau perusahaan mempunyai lebih banyak waktu untuk hal yang lebih penting, dan banyak kurir baru akan mendapatkan pekerjaan yang bisa membantu kehidupan mereka. Kalau Anda ingin berpartisipasi dalam membawa perubahan ke negara Indonesia, dengan memakai Shipper untuk jasa pengiriman, Anda sudah ikut berperan.    
</div>

<div class="col s12 m4 aboutkanan">
<div class=" col s10 m10">
<img src="<?php echo base_url();?>asset/images/about_us.jpg" width="520" height="620" class="img img-about"/>
</div>
</div>
    
          
    
          
    </div>
  <!-- END OF ABOUT US -->
  

<div class="row">
  <div class="row">
<h1 align="center" class="judul" style="margin-top:40px"> OUR PARTNER  </h1>
<hr style=" border:1px #795548 solid; width:120px; margin-left:45%" />
</div>  
 <div class="col s6 m2">
          <div class="card">
             <div class="card-content">
            <img src="<?php echo base_url();?>asset/images/partner/tlc.jpg" height="90" width="90" />
            </div>
          </div>
        </div>
          

<div class="col s6 m2">
          <div class="card">
                       <div class="card-content">
            <img src="<?php echo base_url();?>asset/images/partner/jnt.png" height="90" width="90" />
            </div>          
            
            
          </div>
        </div>
        
        <div class="col s6 m2">
          <div class="card">
             <div class="card-content">
            <img src="<?php echo base_url();?>asset/images/partner/jne.jpg" height="90" width="90" />
            </div>
            
          </div>
        </div>          
<div class="col s6 m2">
          <div class="card">
             <div class="card-content">
            <img src="<?php echo base_url();?>asset/images/partner/tiki.jpg" height="90" width="90" />
            </div>
            
          </div>
        </div>    
<div class="col s6 m2">
          <div class="card">
 
             <div class="card-content">
            <img src="<?php echo base_url();?>asset/images/partner/cas.jpg" height="90" width="90" />
            </div>
            
          </div>
        </div>
    
    
          
    </div>