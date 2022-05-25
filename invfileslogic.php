<?php
// connect to the database
require_once 'connectionoop.php';
require_once 'core/init.php';
 
$query1 = sprintf("SELECT * FROM investfiles WHERE 1");
$result1 = $mysqli->query($query1);

$files=array();
foreach ($result1 as $row) {
  $files[] = $row;
}
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $proj = $_POST['Pid'];
    $investor = $_POST['Invid'];
    // destination of the file on the server
    $destination = 'uploads/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['zip', 'pdf', 'docx'])) {
        echo "You file extension must be .zip, .pdf or .docx";
    } elseif ($_FILES['myfile']['size'] > 1000000) { // file shouldn't be larger than 1Megabyte
        echo "File too large!";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (copy($file, $destination)) {
            $query = sprintf("INSERT INTO investfiles (name, size, downloads ,investor, project) VALUES ('$filename', '$size', 0,'$investor','$proj')");
        //execute query
            $result = $mysqli->query($query);
            $pr=new Invest($investor);
            $pr->update(array(
                'assigned' =>1,
                'gainper'=>$_POST['gainper']
            ));

            $inv = new InvestMovement();
            $amn = $pr->data()->amount*(1+($_POST['gainper']/100));
            $amn +=$_POST['gainper2']*$pr->data()->amount/100;
            
            $project = new Project($proj);

            $inv->create(array(
                'investor'=>$pr->data()->investor,
                'Pid'=>$proj,
                'investid'=>$investor,
                'amount'=>$pr->data()->amount*-1,
                'date'=>date("Y-m-d"),
                'Aname'=>$pr->data()->Aname
            ));
            $ac = new AccountMovement();
            $amt = new Amuta($pr->data()->Aname);
            $ac->create(array(
                'Aid'=>$amt->data()->id,
                'amount'=>$amn*-1,
                'date'=>date("Y-m-d"),
                'source'=>$project->data()->Pname,
                'collected'=>1

            ));
            Redirect::to('investData.php');

        } else {
            echo "Failed to upload file.<br>".$destination;
        }
    }
}

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];


   

    $query2 = sprintf("SELECT * FROM investfiles WHERE id=$id");
    // fetch file to download from database
    $result2 = $mysqli->query($query2);
    $data = array();
    foreach ($result2 as $row) {
    $data[] = $row;
    }
    $filepath = 'uploads/' .$data[0]['name'];
    

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header("Content-type:application/pdf");
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $data[0]['name']));
        readfile('uploads/' . $data[0]['name']);

        // Now update downloads count
        $newCount = $data[0]['downloads'] + 1;
        $query3 = sprintf("UPDATE investfiles SET downloads=$newCount WHERE id=$id");
    // fetch file to download from database
        $result3 = $mysqli->query($query3);
        exit;
    }

}