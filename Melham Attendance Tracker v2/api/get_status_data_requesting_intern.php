<?php 



    $id = (int)$_GET['id']; 

   include("db/dbconnection.php");

    $query = "SELECT * FROM requested_intern_status, user_acc, intern_info WHERE intern_info.username=user_acc.username AND requested_intern_status.user_acc_id = user_acc.user_acc_id AND requested_intern_status.requested_id = '".$id."'";



    $result = $conn->query($query);

   

    

    while ($row1 = $result->fetch_array()) {
        
        $intern_detail = $row1["intern_info_id"];

        // RENDERED HOURS
        $sql2_rendered = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id ='".$row1["user_acc_id"]."'";

		$result2_rendered = mysqli_query($conn, $sql2_rendered);

        $row2_rendered = $result2_rendered->fetch_assoc();


            
        $rendered = $row2_rendered["hrs_added"];
       

        
        //TOTAL RENDERED HOURS
        $sql2_total__rendered = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id ='".$row1["user_acc_id"]."'";

		$result2_total__rendered = mysqli_query($conn, $sql2_total__rendered);

        $row2_total__rendered = $result2_total__rendered->fetch_assoc();



        $sql3_total__rendered = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='".$row1["user_acc_id"]."'";

	    $result3_total__rendered = mysqli_query($conn, $sql3_total__rendered);

        $row3_total__rendered = $result3_total__rendered->fetch_assoc();



        $sql4_total__rendered = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id ='".$row1["user_acc_id"]."'";

	    $result4_total__rendered = mysqli_query($conn, $sql4_total__rendered);

        $row4_total__rendered = $result4_total__rendered->fetch_assoc();       

            
        $total__rendered = $row2_total__rendered["hrs_added"] + $row3_total__rendered["extra_hours"] - $row4_total__rendered["extra_hours"];
        
        $intern = $row1["user_acc_id"]. "|" . strtoupper($row1["firstname"]). "|" . strtoupper($row1["middle_name"]). "|" . strtoupper($row1["lastname"]). "|" . $row1["profile_pic"]. "|" . $row1["required_hours"];

        
        //REMAINING HOURS
        $sql21 = "SELECT SUM(hrs_today) AS hrs_added FROM attendance WHERE user_acc_id ='".$row1["user_acc_id"]."'";

		$result21 = mysqli_query($conn, $sql21);

        $row21 = $result21->fetch_assoc();

        

        $sql31 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id ='".$row1["user_acc_id"]."'";

	    $result31 = mysqli_query($conn, $sql31);

        $row31 = $result31->fetch_assoc();            

        

        $sql41 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='".$row1["user_acc_id"]."'";

	    $result41 = mysqli_query($conn, $sql41);

        $row41 = $result41->fetch_assoc();        

        

        

        $penalty = $row31["extra_hours"];

        $deduction = $row41["extra_hours"];

        $remaining_rs = $row1["required_hours"] - $row21["hrs_added"] - $deduction + $penalty;
        
        
        //DEDUCTED HOURS
        $sql211 = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Deducted' AND user_acc_id ='".$row1["user_acc_id"]."'";

    	$result211 = mysqli_query($conn, $sql211);
    
        $row211 = $result211->fetch_assoc();
    
        $extra_hours1 = $row211["extra_hours"];
        
        
        //PENALTY HOURS
        $sql2_penalty = "SELECT SUM(hours_added) AS extra_hours FROM hours_added WHERE deducted_penalty = 'Penalty' AND user_acc_id ='".$row1["user_acc_id"]."'";

    	$result2_penalty = mysqli_query($conn, $sql2_penalty);
    
        $row2_penalty = $result2_penalty->fetch_assoc();
    
        $extra_hours_penalty = $row2_penalty["extra_hours"];
  

    }

       if($rendered < 0 )
        {
                if($remaining_rs < 0)
                {
                    if($extra_hours1==null)
                    {
                        
                        
                        
                        if($total__rendered < 0)
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $remaining_rs1 = '0';
                                $extra_hours11 = '0';
                                $total_rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $remaining_rs1 = '0';
                                $extra_hours11 = '0';
                                $total_rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                
                                echo $total_result;
                            }
                            
                        }else
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $remaining_rs1 = '0';
                                $extra_hours11 = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $remaining_rs1 = '0';
                                $extra_hours11 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                
                                echo $total_result;
                            }
                            
                            
                        }
                    }else
                    {
                        if($total__rendered < 0)
                        {
                            if($extra_hours_penalty==null)
                            {
                                $remaining_rs1 = '0';
                                $rendered_zero = '0';
                                $total_rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $remaining_rs1 = '0';
                                $rendered_zero = '0';
                                $total_rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }else
                        {
                            if($extra_hours_penalty==null)
                            {
                                $remaining_rs1 = '0';
                                $rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $remaining_rs1 = '0';
                                $rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }
                        
                    }
                    
                }else
                {
                    if($extra_hours1==null)
                    {
                        if($total__rendered < 0)
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $extra_hours11 = '0';
                                $total_rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $extra_hours11 = '0';
                                $total_rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }else
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $extra_hours11 = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $extra_hours11 = '0';

                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }
                        
                    }else
                    {
                        if($total__rendered < 0)
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $total_rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $total_rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }else
                        {
                            if($extra_hours_penalty==null)
                            {
                                $rendered_zero = '0';
                                $extra_hours_penalty1 = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                                echo $total_result;
                            }else
                            {
                                $rendered_zero = '0';
                                $total_result = $intern. "|" .$rendered_zero. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                                echo $total_result;
                            }
                            
                        }
                        
                    }
                    
                }
            
            
        }else{
            
            if($remaining_rs < 0)
            {
                if($extra_hours1==null)
                {
                    if($total__rendered < 0)
                    {
                        if($extra_hours_penalty==null)
                        {
                            $remaining_rs1 = '0';
                            $extra_hours11 = '0';
                            $total_rendered_zero = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            
                            echo $total_result;
                        }else
                        {
                            $remaining_rs1 = '0';
                            $extra_hours11 = '0';
                            $total_rendered_zero = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            
                            echo $total_result;
                        }
                        
                    }else
                    {
                        if($extra_hours_penalty==null)
                        {
                            $remaining_rs1 = '0';
                            $extra_hours11 = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            
                            echo $total_result;
                        }else
                        {
                            $remaining_rs1 = '0';
                            $extra_hours11 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            
                            echo $total_result;
                        }
                        
                    }
                    
                }else
                {
                    if($total__rendered < 0)
                    {
                        if($extra_hours_penalty==null)
                        {
                            $remaining_rs1 = '0';
                            $total_rendered_zero = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            
                            echo $total_result;
                        }else
                        {
                            $remaining_rs1 = '0';
                            $total_rendered_zero = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            
                            echo $total_result;
                        }
                        
                    }else
                    {
                        if($extra_hours_penalty==null)
                        {
                            $remaining_rs1 = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            
                            echo $total_result;
                        }else
                        {
                            $remaining_rs1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs1. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            
                            echo $total_result;
                        }
                        
                    }
                    
                }
                
            }else
            {
                if($extra_hours1==null)
                {
                    if($total__rendered < 0)
                    {
                        if($extra_hours_penalty==null)
                        {
                            $extra_hours11 = '0';
                            $total_rendered_zero = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            echo $total_result;
                        }else
                        {
                            $extra_hours11 = '0';
                            $total_rendered_zero = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            echo $total_result;
                        }
                        
                    }else
                    {
                        if($extra_hours_penalty==null)
                        {
                            
                            $extra_hours11 = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            echo $total_result;
                        }else
                        {
                            $extra_hours11 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours11. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            echo $total_result;
                        }
                        
                    }
                    
                }else
                {
                    if($total__rendered < 0)
                    {
                        if($extra_hours_penalty==null)
                        {
                            $total_rendered_zero = '0';
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            echo $total_result;
                        }else
                        {
                            $total_rendered_zero = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total_rendered_zero. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            echo $total_result;
                        }
                        
                    }else
                    {
                        if($extra_hours_penalty==null)
                        {
                            $extra_hours_penalty1 = '0';
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty1. "|" .$intern_detail;
                            echo $total_result;
                        }else
                        {
                            $total_result = $intern. "|" .$rendered. "|" .$remaining_rs. "|" .$extra_hours1. "|" .$total__rendered. "|" .$extra_hours_penalty. "|" .$intern_detail;
                            echo $total_result;
                        }
                        
                    }
                    
                }
                
            }
        }

 $conn->close();

?>