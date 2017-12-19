<?php
    //Create an array to store data that we will send back to the jQuery
    $data = array(
        'success' => false, //Flag whether everything was successful
        'errors' => array() //Provide information regarding the error(s)
    );
    
    //Check to make sure that the inputs variable has been posted
    if (isset($_POST['inputs'])) {
    	//Store the posted data into an array
        $inputs = $_POST['inputs'];
        //Loop through each input field
        foreach ($inputs as $input) {
        	$id = $input['id'];
        	$value = $input['value'];
        	//Determine what validation we need to be doing
        	switch($id) {
        		//Username and real name need the same validation, so only need one case block here
        		case "username":
        		case "real-name":
        			//Ensure that they are both at least 6 characters long
        			if (strlen($value) < 6) {
        				//To make it more readable, replace the "-"'s with spaces and make the first character upper case
        				$msg = "Your " . str_replace("-", " ", ucfirst($id)) . " must be at least 6 characters in length";
        			}
        			break;
        		case "email":
        			//Use PHP filter to validate the E-Mail address
        			if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        				$msg = "You must provide a valid e-mail address";
        			}
        			break;
        		default:
        				//If some field has been passed over, we report the error
        				$msg = "Sorry, we don't understand this data, please try again";
        			break;
        	}
        	//If there is an error, add it to the errors array with the field id
        	if (!empty($msg)) {
	        	$data['errors'][] = array(
	        		'msg' => $msg,
	        		'field' => $id
	        	);
        	}
        }

        //Validation over, was it successful?
        if (empty($data['errors'])) {
        	$data['success'] = true;
        }
        
    } else {
    	$data['errors'][] = "Data missing";
    }

    //Set the content type and charset to ensure the browser is expecting the correct data format, also ensure charset is set-to UTF-8 and not utf8 to prevent any IE issues
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode((object)$data);
?>