<script type="text/javascript">
$(document).ready(function(){
    
});

</script>
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
    content: "v";
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
</style>
<div class="notice info">
<p class="time"><i class="material-icons">schedule</i> 20-12-2016 (03:20:16)</p>
<p>
Customers chat with sales
</p>
</div>
            
<div class="notice success">
<p class="time"><i class="material-icons">schedule</i> 20-12-2016 (03:20:16)</p>
<p>
Sales Name Hendra send e masssage to customers.
Lorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit ametLorem ipsum dolor sit amet
</p>
</div>
            
<div class="notice warning">
<p class="time"><i class="material-icons">schedule</i> 20-12-2016 (03:20:16)</p>
<p>
Manasger OPS approved quotation 
</p>
</div>
            
<div class="notice warning">
<p class="time"><i class="material-icons">schedule</i> 20-12-2016 (03:20:16)</p>
<p>
Manasger Sales Edit Inquiry
</p>
</div>
            
<div class="notice error">
<p class="time"><i class="material-icons">schedule</i> 20-12-2016 (03:20:16)</p>
<p>
Customers Rejected Inquiry
</p>
</div>