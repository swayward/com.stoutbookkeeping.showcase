<?php
$page = "contact";

include_once 'functions/email.php';
$new_email = new email;

//delete debug file if file exists and debug = TRUE
if($new_email->is_debug() && $new_email->debug_file_exist()) {
    $new_email->delete_debug();
}

if (isset($_POST['send'])) {

    //debug values
    if($new_email->is_debug() === TRUE) {
        $new_email->debug_class->write_debug2("POST Input", $_POST);
    }

    //clean arrray
    $clean_array = $new_email->cleanArray($_POST);
    
    //put message together 
    $stout_message = $new_email->build_stout_email($clean_array);

    //send email to info
    $new_email->send_to_tammy($stout_message);
    
    //create client message
    
    
    //send email to client
    
    
    //include debug.html if it is there
    if ($new_email->is_debug() && $new_email->debug_file_exist()) {
        include 'debug.html';
    }
}







/********************
open the page
********************/
include 'layout/page_open.html';

/********************
open the page
********************/
include 'layout/contact2.html';

/********************
Close the page
********************/
include 'layout/page_close.html';

?>