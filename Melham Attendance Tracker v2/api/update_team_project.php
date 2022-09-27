<?php
if(isset($_POST['id'])){

  include("db/dbconnection.php");

  $id = $_POST['id'];

  $sql = "SELECT * FROM team_project where team_project_id=".$id;
  $result = $conn->query($sql);
  $count = mysqli_num_rows($result);

  if($count == 0) {
    echo "0";
  }
  else{
    while($row = $result->fetch_array()){

      $taskName = $row["task_name"];
      $dateAssigneed = $row["date_assigned"];
      $fileFormat = $row["file_formats"];
      $gdriveLink = $row["gdrive_link"];
    }

    $return_data=array('id'=>$id,'task_name'=>$taskName,'date_assigned'=>$dateAssigneed,'file_format'=>$fileFormat,'gdrive_link'=>$gdriveLink);

    header('Content-Type: application/json');
    echo json_encode($return_data);

    $conn->close();
    exit();
  }
}

if(isset($_POST['team_proj_id']) && isset($_POST['task_name']) && isset($_POST['date_assigned']) && isset($_POST['file_formats']) && isset($_POST['gdrive_link'])){

    include("db/dbconnection.php");

    $id = $_POST['team_proj_id'];
    $task_name = $_POST['task_name'];
    $date_assigned = $_POST['date_assigned'];
    $file_formats = $_POST['file_formats'];
    $gdrive_link = $_POST['gdrive_link'];

    $sql1 = "UPDATE team_project SET task_name='$task_name', date_assigned='$date_assigned', file_formats='$file_formats', gdrive_link='$gdrive_link' WHERE team_project_id='$id'";
    if ($conn->query($sql1) === TRUE)
    {
      echo "1" ;

    } else
    {
      echo "0";
    }

    $conn->close();
    exit();
}
?>
