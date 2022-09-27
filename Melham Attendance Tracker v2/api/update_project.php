  <?php
if(isset($_POST['id'])){

  include("db/dbconnection.php");

  $id = $_POST['id'];

  $sql = "SELECT * FROM project where project_id=".$id;
  $result = $conn->query($sql);
  $count = mysqli_num_rows($result);

  if($count == 0) {
    echo "0";
  }
  else{
    while($row = $result->fetch_array()){
      $proj_id = $row["project_id"];
      $task_name = $row["task_name"];
      $date_assigned = $row["date_assigned"];
      $file_format = $row["file_formats"];
      $g_drive_link = $row["gdrive_link"];
    }

    $return_data=array('project_id'=>$proj_id,'task_name'=>$task_name,'date_assigned'=>$date_assigned,'file_format'=>$file_format,'gdrive_link'=>$g_drive_link);

    header('Content-Type: application/json');
    echo json_encode($return_data);

    $conn->close();
    exit();
  }
}

if(isset($_POST['project_id'],
         $_POST['task_name'],
         $_POST['date_assigned'],
         $_POST['file_formats'],
         $_POST['gdrive_link'])){

    include("db/dbconnection.php");

    $proj_id = $_POST['project_id'];
    $task_name = $_POST['task_name'];
    $date_assigned = $_POST['date_assigned'];
    $file_format = $_POST['file_formats'];
    $gdrive_link = $_POST['gdrive_link'];

    $sql1 = "UPDATE project SET task_name='$task_name', date_assigned='$date_assigned', file_formats='$file_format', gdrive_link='$gdrive_link' WHERE project_id='$proj_id'";
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
