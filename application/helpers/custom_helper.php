<?php

if(!function_exists("pre"))
{
    function pre($data=null)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}

if(!function_exists("page_alert"))
{
    function page_alert($type=null,$message=NULL)
    { 
        $_SESSION["page_alert"]=array("type"=>$type,"message"=>$message);
        
    }
}

if(!function_exists("return_data"))
{
    function return_data($status,$message,$data)
    { 
        $return = array(
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        );
        echo json_encode($return);
        die;
    }
}

if(!function_exists("upload_meta"))
{
    function upload_meta($file_name)
    {
        $target_dir = getcwd()."\uploads\\";
        /*Rename file*/
        $new_name = explode('.',$_FILES[$file_name]['name']);//taking extension of file
        $new_name = time().".".end($new_name);//renaming file

        $target_file = $target_dir . $new_name;
        if (move_uploaded_file($_FILES[$file_name]["tmp_name"], $target_file))
        {
            return base_url()."uploads/".$new_name;
        } else {
            echo "Sorry, there was an error uploading your file.";
            die;
        }
    }
}