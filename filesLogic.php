<?php
// connect to the database
require_once 'connectionoop.php';
require_once 'core/init.php';
 
$query1 = sprintf("SELECT files.id, files.name,files.size ,files.downloads , association.Aname ,projects.Pname,files.project 
    FROM files
    INNER JOIN projects ON files.project = projects.id INNER JOIN association ON projects.Aid = association.id
");
$result1 = $mysqli->query($query1);

$files=array();
foreach ($result1 as $row) {
  $files[] = $row;
}
// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $proj = $_POST['Aid'];
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
            $query = sprintf("INSERT INTO files (name, size, downloads , project) VALUES ('$filename', $size, 0,$proj)");
        //execute query
            $result = $mysqli->query($query);
            $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            $pr=new Project($proj);
            $pr->update(array(
                'hasfile' =>1
            ));
            Redirect::to('downloads.php');

        } else {
            echo "Failed to upload file.<br>".$destination;
        }
    }
}

if (isset($_GET['file_id'])) {
    $id = $_GET['file_id'];


   

    $query2 = sprintf("SELECT * FROM files WHERE id=$id");
    // fetch file to download from database
    $result2 = $mysqli->query($query2);
    $data = array();
    foreach ($result2 as $row) {
    $data[] = $row;
    }
    $filepath = 'uploads/' .$data[0]['name'];
    

    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $data['name']));
        readfile('uploads/' . $data['name']);

        // Now update downloads count
        $newCount = $data['downloads'] + 1;
        $query3 = sprintf("UPDATE files SET downloads=$newCount WHERE id=$id");
    // fetch file to download from database
        $result3 = $mysqli->query($query3);
        exit;
    }

}
