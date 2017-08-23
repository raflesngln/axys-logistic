function colVis_set(colVis_table,$dt_colVis){
     // init colVis
            var colvis = new $.fn.dataTable.ColVis( colVis_table, {
                buttonText: 'Select columns',
                exclude: [ 0 ],
                restore: "Restore",
                showAll: "Show all",
                showNone: "Show none"
            });

            // custom colVis elements
            var _colVis_button = $(colvis.dom.button).off('click').attr('class','md-btn md-btn-colVis');
            var _colVis_wrapper = $('<div class="uk-button-dropdown uk-text-left" data-uk-dropdown="{mode:\'click\'}"/>').append(_colVis_button);
            var _colVis_wrapper_outer = $('<div class="md-colVis uk-text-right"/>').append(_colVis_wrapper);
            var _colVis_collection = $(colvis.dom.collection);

            // Modify colVis collection
            $(_colVis_collection)
                .attr({
                    'class': 'md-list-inputs',
                    'style': ''
                })
                .find('input')
                .each(function(index) {
                    var inputClone = $(this).clone().hide();
                    $(this).attr({
                        'class': 'data-md-icheck',
                        'id': 'col_' + index
                    }).css({
                        'float': 'left'
                    }).before(inputClone)
                })
                .end()
                .find('span').unwrap()
                .each(function() {
                    var thisText = $(this).text();
                    var thisInputId =  $(this).prev('input').attr('id');
                    $(this)
                        .after('<label for="' + thisInputId + '">' + thisText + '</label>')
                        .end()
                })
                .remove();

            // append collection to collection wrapper
            var _colVis_collection_wrapper = $('<div class="uk-dropdown uk-dropdown-flip"/>').append(_colVis_collection);

            // append collection wrapper to colVis wrapper
            _colVis_wrapper
                .append(_colVis_collection_wrapper);

            // insert colVis elements before datatable header
            $dt_colVis.closest('.dt-uikit').find('.dt-uikit-header').before(_colVis_wrapper_outer);

            // initialize styled checkboxes in dropdown
            altair_md.checkbox_radio();

            // custom events
            $dt_colVis.closest('.dt-uikit').find('.md-colVis .data-md-icheck').on('ifClicked',function() {
                $(this).closest('li').click();
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowAll,.md-colVis .ColVis_Restore').on('click',function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked',true).iCheck('update')
            });

            $dt_colVis.closest('.dt-uikit').find('.md-colVis .ColVis_ShowNone').on('click',function() {
                $(this).closest('.uk-dropdown').find('.data-md-icheck').prop('checked',false).iCheck('update')
            });
}

function cmbselect(curl,elemen){
    $.ajax({
           url: curl,
           dataType: "json",
           success: function(data){
              $v =elemen.selectize({
					valueField: 'id',
					labelField: 'name',
					searchField: 'name',
					options: data,
					create: false,
                    onChange: function(value){
                    }
				});
                
            cmb = $v[0].selectize;
           }
       }); 
}

function convertDate(date) {
  var yyyy = date.getFullYear().toString();
  var mm = (date.getMonth()+1).toString();
  var dd  = date.getDate().toString();

  var mmChars = mm.split('');
  var ddChars = dd.split('');

  return yyyy + '-' + (mmChars[1]?mm:"0"+mmChars[0]) + '-' + (ddChars[1]?dd:"0"+ddChars[0]);
}

function load_processing(message='Please Wait..'){
   swal({
    title: "Processing...!",
    text: '<div class="md-preloader md-preloader-success"><svg xmlns="http:www.w3.org/2000/svg" version="1.1" height="80" width="80" viewbox="0 0 75 75"><circle cx="37.5" cy="37.5" r="33.5" stroke-width="4"/></svg></div><p id="textload" style="display: block;"></p>',
    html: true,
    showConfirmButton: false
    });
  $('#textload').html(message); 
}

    function extractNumber(obj, decimalPlaces, allowNegative)
    {
        var temp = obj.value;
     
        // avoid changing things if already formatted correctly
        var reg0Str = '[0-9]*';
        if (decimalPlaces > 0) {
            reg0Str += '\\.?[0-9]{0,' + decimalPlaces + '}';
        } else if (decimalPlaces < 0) {
            reg0Str += '\\.?[0-9]*';
        }
        reg0Str = allowNegative ? '^-?' + reg0Str : '^' + reg0Str;
        reg0Str = reg0Str + '$';
        var reg0 = new RegExp(reg0Str);
        if (reg0.test(temp)) return true;
     
        // first replace all non numbers
        var reg1Str = '[^0-9' + (decimalPlaces != 0 ? '.' : '') + (allowNegative ? '-' : '') + ']';
        var reg1 = new RegExp(reg1Str, 'g');
        temp = temp.replace(reg1, '');
     
        if (allowNegative) {
            // replace extra negative
            var hasNegative = temp.length > 0 && temp.charAt(0) == '-';
            var reg2 = /-/g;
            temp = temp.replace(reg2, '');
            if (hasNegative) temp = '-' + temp;
        }
     
        if (decimalPlaces != 0) {
            var reg3 = /\./g;
            var reg3Array = reg3.exec(temp);
            if (reg3Array != null) {
                // keep only first occurrence of .
                //  and the number of places specified by decimalPlaces or the entire string if decimalPlaces < 0
                var reg3Right = temp.substring(reg3Array.index + reg3Array[0].length);
                reg3Right = reg3Right.replace(reg3, '');
                reg3Right = decimalPlaces > 0 ? reg3Right.substring(0, decimalPlaces) : reg3Right;
                temp = temp.substring(0,reg3Array.index) + '.' + reg3Right;
            }
        }
     
        obj.value = temp;
    }
    
    function blockNonNumbers(obj, e, allowDecimal, allowNegative)
    {
        var key;
        var isCtrl = false;
        var keychar;
        var reg;
     
        if(window.event) {
            key = e.keyCode;
            isCtrl = window.event.ctrlKey
        }
        else if(e.which) {
            key = e.which;
            isCtrl = e.ctrlKey;
        }
     
        if (isNaN(key)) return true;
     
        keychar = String.fromCharCode(key);
     
        // check for backspace or delete, or if Ctrl was pressed
        if (key == 8 || isCtrl)
        {
            return true;
        }
     
        reg = /\d/;
        var isFirstN = allowNegative ? keychar == '-' && obj.value.indexOf('-') == -1 : false;
        var isFirstD = allowDecimal ? keychar == '.' && obj.value.indexOf('.') == -1 : false;
     
        return isFirstN || isFirstD || reg.test(keychar);
    }


    function format_tanggal_indonesia(tanggal){
        var hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jum&#36;at','Sabtu'];
        var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var day =tanggal.split('-');
        var thn=day[0];
        var bln=day[1]-1;
        var tgl=day[2];
       // var hr=Date(tanggal).getDay();
       if (bln==-1){
        return "";
       }else{
       return tgl+' '+bulan[bln]+' '+thn;
       }
    }
    
    function bulan(tanggal){
        var bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        var day =tanggal.split('-');
        var bln=day[1]-1;
        return bulan[bln];
    }
    
    function cetakTri(vtext,url){
              $("#f").empty();
              inputs = '<input type="hidden" name="text" value="' + vtext + '" />';  
              $("#f").append('<form action="'+url+'" method="post" id="prin" target="_blank">'+inputs+'</form>');
              $("#prin").submit();
    }
    
    function cetakPrev(valxx,curl,id){
        $(id).html('<center><div class="proses_loader"></div><br>Prosesing...!</center>');
            $.ajax({
                url : curl,
                type: "POST",
                data:({text:valxx}),
                dataType: "JSON",
                success: function(data)
                {
                    $(id).html(data.isi);
                }
            });
    }