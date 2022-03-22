<?php #start the sesstion for create msg variable 
session_start();
$msg = null; #we set value of the msg is null to set the flexible value later
if ($_SERVER["REQUEST_METHOD"] == "POST") { #REQUEST_METHOD should be POST
    if (isset($_post["uploadBtn"]) && $_POST["uploadBtn"] == "Upload"); { #uploadBtn should be click with default value (its for beter security)
        if (isset($_FILES["uploadedFile"]) && !empty($_FILES["uploadedFile"]) && $_FILES["uploadedFile"]["error"] == 0) { #uploadedFile should not be empty
            $fileName = $_FILES["uploadedFile"]["name"]; #we take the file name
            $fileSize = $_FILES["uploadedFile"]["size"]; #we take the file siza
            $fileType = $_FILES["uploadedFile"]["type"]; #we take the file type
            $fileTmpPath = $_FILES["uploadedFile"]["tmp_name"]; #we take the file tmp path 
            $fileNameSeprate = explode(".", $fileName); #choose the Extention of the file
            $fileExtention = strtolower(end($fileNameSeprate));
            $newFileName = md5(time() . $fileName) . "." . $fileExtention; #make random name with timen file name and mix it with Extention of file
            $allowedFileExtention = ["jpg", "jpeg", "gif", "zip", "rar", "doc"]; #create allowed Extention
            if (in_array($fileExtention, $allowedFileExtention)) { #check if file Extention is equal with our allowed Extention 
                $maxFileSiza = 2 * 1024 * 1024; #$file just work with byte
                if ($fileSize < $maxFileSiza) { #check the size of the file
                    $uploadFileDir = "upload/"; #where wee want to keep the file
                    $destPath = $uploadFileDir . $newFileName; #mix the location with file new name
                    if (move_uploaded_file($fileTmpPath, $destPath)) { #move file frome client to location 
                        $msg = "Upload completed successfully";
                    } else {
                        $msg = "Upload error";
                    }
                } else {
                    $msg = "The file must be less than 2 mg";
                }
            } else {
                $msg = "Your file format is not allowed";
            }
        } else {
            $msg = "You must select a file first";
        }
    }
}
$_SESSION["msg"] = $msg;
header("Location:index.php"); #send the data to index.php to use them in there
