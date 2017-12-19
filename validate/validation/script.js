$(function(){
    //Hide the error/success message response on load
    $('#response').hide();
    $('.submit-btn').click(function(){
        //Hide the reponse from last time
        $('#response').hide();
        var formInputs = new Array();
        //Get the form ID
        var id = $(this).parent().attr('id');
        $('#' + id + ' input').each(function(){
            //Remove any previously set errors
            $(this).removeClass('error');
            //Create a temp object that holds the input data
            var obj = {
                'value': $(this).val(),
                'id': $(this).attr('id')
            };
            //Add the object to the array
            formInputs.push(obj); 
        });
        $.ajax({
            url: 'validate.php',
            type: 'POST',
            data: {
                'inputs': formInputs
            },
            success: function(data) {
                //Check to see if the validation was successful
                if (data.success) {
                    //Turn the response alert into a success alert
                    $('#response').addClass('alert-success');
                    $('#response').removeClass('alert-error');
                    //Add the success message text into the alert
                    $('#response').html("<i class='icon-ok'></i> Form validated successfully!").fadeIn();
                } else {
                    //There were some errors
                    //Turn the response alert into an error alert
                    $('#response').removeClass('alert-success');
                    $('#response').addClass('alert-error');
                    //Create a message and a HTML list to display in the response alert
                    var list = "<p><i class='icon-remove-sign'></i> There following errors occured: </p><ul>";
                    //Loop through each error message and add it to the list
                    $.each(data.errors, function(){
                        $('#' + this.field).addClass('error');
                        list += "<li>" + this.msg + "</li>";
                    });
                    list += "</ul>";
                    //Add the HTML to the response alert and fade it in
                    $('#response').html(list).fadeIn();
                }
            }
        });
    });
});