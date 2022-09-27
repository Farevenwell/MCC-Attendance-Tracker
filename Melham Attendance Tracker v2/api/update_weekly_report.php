<?php
if(isset($_POST['id'])){

  include("db/dbconnection.php");

  $id = $_POST['id'];

  $sql = "SELECT * FROM weekly_report where weekly_report_id=".$id;
  $result = $conn->query($sql);
  $count = mysqli_num_rows($result);

  if($count == 0) {
    echo "0";
  }
  else{
    while($row = $result->fetch_array()){
      $id = $row["weekly_report_id"];
      $name = $row["weekly_no"];
      $gdrive_link = $row["gdrive_link"];
    }

    $return_data=array('weekly_report_id'=>$id,'weekly_report'=>$name,'gdrive_link'=>$gdrive_link);

    header('Content-Type: application/json');
    echo json_encode($return_data);

    $conn->close();
    exit();
  }
}

if(isset($_POST['weekly_report_id'],
       $_POST['weekly_report_name'],
       $_POST['gdrive_link'])){

  include("db/dbconnection.php");

  $id = $_POST['weekly_report_id'];
  $name = $_POST['weekly_report_name'];
  $gdrive_link = $_POST['gdrive_link'];

  $sql1 = "UPDATE weekly_report SET weekly_no='$name', gdrive_link='$gdrive_link' WHERE weekly_report_id='$id'";
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
