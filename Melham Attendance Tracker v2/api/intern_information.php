<?php
  include("db/dbconnection.php");
  
  date_default_timezone_set('Asia/Singapore');
  $currentDate = date('Y-m-d');	  
  
  
  $data = array();

  $sql1 = "SELECT * FROM intern_info where intern_status='Unassigned'  ORDER By intern_info_id ";
  $sql2 = "SELECT * FROM intern_info where intern_status='Ongoing'  ORDER By intern_info_id ";
  $sql3 = "SELECT * FROM intern_info where intern_status='Offboarding'  ORDER By intern_info_id ";
  $sql4 = "SELECT * FROM intern_info where intern_status='Completed'  ORDER By intern_info_id ";
  $sql5 = "SELECT * FROM intern_info where intern_status='Terminated'  ORDER By intern_info_id ";
  $sql6 = "SELECT * FROM intern_info where department='Information Technology'  ORDER By intern_info_id ";
  $sql7 = "SELECT * FROM intern_info where department='Mechanical Engineering'  ORDER By intern_info_id ";
  $sql8 = "SELECT * FROM intern_info where department='Mechatronics Engineering'  ORDER By intern_info_id ";
  $sql9 = "SELECT * FROM intern_info where department='Industrial Engineering'  ORDER By intern_info_id ";
  $sql10 = "SELECT * FROM intern_info where department='Petroleum Engineering'  ORDER By intern_info_id ";
  $sql11 = "SELECT * FROM intern_info where department='Electrical Engineering'  ORDER By intern_info_id ";
  $sql12 = "SELECT * FROM intern_info where department='Electronics Engineering'  ORDER By intern_info_id ";
  $sql13 = "SELECT * FROM intern_info where department='Industrial Technology'  ORDER By intern_info_id ";
  $sql14 = "SELECT * FROM intern_info where department='Civil Engineering'  ORDER By intern_info_id ";
  $sql15 = "SELECT * FROM intern_info where department='Sales And Marketing Department'  ORDER By intern_info_id ";
  $sql16 = "SELECT * FROM intern_info where department='Operations Department'  ORDER By intern_info_id ";
  $sql17 = "SELECT * FROM intern_info where department='Creative Team Department'  ORDER By intern_info_id ";
  $sql18 = "SELECT * FROM intern_info where department='Business Development Department'  ORDER By intern_info_id ";
  $sql19 = "SELECT * FROM intern_info where department='Liaison Department'  ORDER By intern_info_id ";
  $sql20 = "SELECT * FROM intern_info where department='Client Relations Department'  ORDER By intern_info_id ";
  $sql21 = "SELECT * FROM intern_info where department='Social Media Marketing Department'  ORDER By intern_info_id ";
  $sql22 = "SELECT * FROM intern_info where department='UIP-Human Resources Department'  ORDER By intern_info_id ";
  $sql23 = "SELECT * FROM intern_info where department='Quality Control Department'  ORDER By intern_info_id ";
  $sql24 = "SELECT * FROM intern_info where department='UIP-Learning and Development Department'  ORDER By intern_info_id ";
  $sql24a = "SELECT * FROM intern_info where department='UIP-Auxiliary Department'  ORDER By intern_info_id ";
  $sql25 = "SELECT * FROM intern_info where department='Manager'  ORDER By intern_info_id ";
  $sql26 = "SELECT * FROM intern_info where department='General Manager'  ORDER By intern_info_id ";
  $sql27 = "SELECT * FROM intern_info where department='Supervisor'  ORDER By intern_info_id ";
  $sql28 = "SELECT * FROM intern_info where department='Officer-in-Charge'  ORDER By intern_info_id ";
  $sql29 = "SELECT * FROM intern_info where department='Over all Officer-in-Charge'  ORDER By intern_info_id ";
  $sql30 = "SELECT * FROM intern_info where company='Melham Construction Corporation'  ORDER By intern_info_id ";
  $sql31 = "SELECT * FROM intern_info where company='Anafara Corporation'  ORDER By intern_info_id ";
  $sql32 = "SELECT * FROM intern_info where company='VisVis Travel & Tours'  ORDER By intern_info_id ";
  $sql32a = "SELECT * FROM intern_info where company='VisVis Travel & Tours' AND department='Intern-On-Process' ORDER By intern_info_id ";
  $sql32b = "SELECT * FROM intern_info where company='Melham Construction Corporation' AND department='Intern-On-Process' ORDER By intern_info_id ";
  $sql32c = "SELECT * FROM intern_info where company='Anafara Corporatio' AND department='Intern-On-Process' ORDER By intern_info_id ";
  $sql33 = "SELECT * FROM user_acc where usertype='Admin'  ORDER By user_acc_id ";
  $sql34 = "SELECT * FROM user_acc where usertype='Staff'  ORDER By user_acc_id ";
  $sql35 = "SELECT * FROM user_acc where permission='1' AND usertype='Intern'  ORDER By user_acc_id ";
  $sql36 = "SELECT * FROM user_acc where permission='1' ORDER By user_acc_id ";
  $sql37 = "SELECT status FROM project WHERE status='Already checked'";
  $sql38 = "SELECT status FROM project WHERE status='To be check'";
  $sql39 = "SELECT status FROM team_project WHERE status='To be Check'";
  $sql39a = "SELECT report_status FROM weekly_report WHERE report_status='Unsign'";
  $sql40 = "SELECT status FROM team_project WHERE status='Already Checked'";
  $sql40a = "SELECT report_status FROM weekly_report WHERE report_status='Signed'";
  
  $sql41 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 500 AND date_in ='$currentDate' AND company='Melham Construction Corporation'";
  $sql42 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 400 AND hrs_left <= 499  AND date_in ='$currentDate' AND company='Melham Construction Corporation'";
  $sql43 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 300 AND hrs_left <= 399  AND date_in ='$currentDate' AND company='Melham Construction Corporation'";
  $sql44 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 200 AND hrs_left <= 299  AND date_in ='$currentDate' AND company='Melham Construction Corporation'";
  $sql45 = "SELECT hrs_left FROM attendance WHERE hrs_left <= 199 AND date_in ='$currentDate' AND company='Melham Construction Corporation'";
  
  $sql46 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 500 AND date_in ='$currentDate' AND company='Anafara Corporation'";
  $sql47 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 400 AND hrs_left <= 499  AND date_in ='$currentDate' AND company='Anafara Corporation'";
  $sql48 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 300 AND hrs_left <= 399  AND date_in ='$currentDate' AND company='Anafara Corporation'";
  $sql49 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 200 AND hrs_left <= 299  AND date_in ='$currentDate' AND company='Anafara Corporation'";
  $sql50 = "SELECT hrs_left FROM attendance WHERE hrs_left <= 199 AND date_in ='$currentDate' AND company='Anafara Corporation'";
  
  $sql51 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 500 AND date_in ='$currentDate' AND company='VisVis Travel & Tours'";
  $sql52 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 400 AND hrs_left <= 499  AND date_in ='$currentDate' AND company='VisVis Travel & Tours'";
  $sql53 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 300 AND hrs_left <= 399  AND date_in ='$currentDate' AND company='VisVis Travel & Tours'";
  $sql54 = "SELECT hrs_left FROM attendance WHERE hrs_left >= 200 AND hrs_left <= 299  AND date_in ='$currentDate' AND company='VisVis Travel & Tours'";
  $sql55 = "SELECT hrs_left FROM attendance WHERE hrs_left <= 199 AND date_in ='$currentDate' AND company='VisVis Travel & Tours'";


  $result51 = $conn->query($sql51);
  $row51 = mysqli_num_rows($result51);
  
  $result52 = $conn->query($sql52);
  $row52 = mysqli_num_rows($result52);
  
  $result53 = $conn->query($sql53);
  $row53 = mysqli_num_rows($result53);
  
  $result54 = $conn->query($sql54);
  $row54 = mysqli_num_rows($result54);

  $result55 = $conn->query($sql55);
  $row55 = mysqli_num_rows($result55);


  $result46 = $conn->query($sql46);
  $row46 = mysqli_num_rows($result46);
  $data['fivehundred_plus_vis'] = $row46 + $row51;
  
  $result47 = $conn->query($sql47);
  $row47 = mysqli_num_rows($result47);
  $data['fourhundred_plus_vis'] = $row47 + $row52;

  $result48 = $conn->query($sql48);
  $row48 = mysqli_num_rows($result48);
  $data['threehundred_plus_vis'] = $row48 + $row53;

  $result49 = $conn->query($sql49);
  $row49 = mysqli_num_rows($result49);
  $data['twohundred_plus_vis'] = $row49 + $row54;

  $result50 = $conn->query($sql50);
  $row50 = mysqli_num_rows($result50);
  $data['onehundred_plus_vis'] = $row50 + $row55;


  $result41 = $conn->query($sql41);
  $row41 = mysqli_num_rows($result41);
  $data['fivehundred_plus_mcc'] = $row41;
  
  $result42 = $conn->query($sql42);
  $row42 = mysqli_num_rows($result42);
  $data['fourhundred_plus_mcc'] = $row42;

  $result43 = $conn->query($sql43);
  $row43 = mysqli_num_rows($result43);
  $data['threehundred_plus_mcc'] = $row43;

  $result44 = $conn->query($sql44);
  $row44 = mysqli_num_rows($result44);
  $data['twohundred_plus_mcc'] = $row44;

  $result45 = $conn->query($sql45);
  $row45 = mysqli_num_rows($result45);
  $data['onehundred_plus_mcc'] = $row45;

  $result1 = $conn->query($sql1);
  $row1 = mysqli_num_rows($result1);
  $data['unassigned'] = $row1;

  $result2 = $conn->query($sql2);
  $row2 = mysqli_num_rows($result2);
  $data['ongoing'] = $row2;

  $result3 = $conn->query($sql3);
  $row3 = mysqli_num_rows($result3);
  $data['offboarding'] = $row3;

  $result4 = $conn->query($sql4);
  $row4 = mysqli_num_rows($result4);
  $data['completed'] = $row4;

  $result5 = $conn->query($sql5);
  $row5 = mysqli_num_rows($result5);
  $data['terminated'] = $row5;

  $result6 = $conn->query($sql6);
  $row6 = mysqli_num_rows($result6);
  $data['information_technology'] = $row6;

  $result7 = $conn->query($sql7);
  $row7 = mysqli_num_rows($result7);
  $data['mechanical_engineering'] = $row7;

  $result8 = $conn->query($sql8);
  $row8 = mysqli_num_rows($result8);
  $data['mechatronics_engineering'] = $row8;

  $result9 = $conn->query($sql9);
  $row9 = mysqli_num_rows($result9);
  $data['industrial_engineering'] = $row9;
  
  $result10 = $conn->query($sql10);
  $row10 = mysqli_num_rows($result10);
  $data['petroleum_engineering'] = $row10;

  $result11 = $conn->query($sql11);
  $row11 = mysqli_num_rows($result11);
  $data['electrical_engineering'] = $row11;

  $result12 = $conn->query($sql12);
  $row12 = mysqli_num_rows($result12);
  $data['electronics_engineering'] = $row12;

  $result13 = $conn->query($sql13);
  $row13 = mysqli_num_rows($result13);
  $data['industrial_technology'] = $row13;

  $result14 = $conn->query($sql14);
  $row14 = mysqli_num_rows($result14);
  $data['civil_engineering'] = $row14;

  $result15 = $conn->query($sql15);
  $row15 = mysqli_num_rows($result15);
  $data['sales_and_marketing_department'] = $row15;

  $result16 = $conn->query($sql16);
  $row16 = mysqli_num_rows($result16);
  $data['operations_department'] = $row16;

  $result17 = $conn->query($sql17);
  $row17 = mysqli_num_rows($result17);
  $data['creative_team_department'] = $row17;

  $result18 = $conn->query($sql18);
  $row18 = mysqli_num_rows($result18);
  $data['business_development_department'] = $row18;

  $result19 = $conn->query($sql19);
  $row19 = mysqli_num_rows($result19);
  $data['liaison_department'] = $row19;

  $result20 = $conn->query($sql20);
  $row20 = mysqli_num_rows($result20);
  $data['client_relations_department'] = $row20;

  $result21 = $conn->query($sql21);
  $row21 = mysqli_num_rows($result21);
  $data['social_media_marketing_department'] = $row21;

  $result22 = $conn->query($sql22);
  $row22 = mysqli_num_rows($result22);
  $data['human_resource_department'] = $row22;

  $result23 = $conn->query($sql23);
  $row23 = mysqli_num_rows($result23);
  $data['quality_control_department'] = $row23;

  $result24 = $conn->query($sql24);
  $row24 = mysqli_num_rows($result24);
  $data['learning_and_development_department'] = $row24;

  $result24a = $conn->query($sql24a);
  $row24a = mysqli_num_rows($result24a);
  $data['auxiliary_department'] = $row24a;

  $result25 = $conn->query($sql25);
  $row25 = mysqli_num_rows($result25);
  $data['manager1'] = $row25;

  $result26 = $conn->query($sql26);
  $row26 = mysqli_num_rows($result26);
  $data['general_manager'] = $row26;

  $result27 = $conn->query($sql27);
  $row27 = mysqli_num_rows($result27);
  $data['supervisor'] = $row27;

  $result28 = $conn->query($sql28);
  $row28 = mysqli_num_rows($result28);
  $data['officer_in_charge'] = $row28;

  $result29 = $conn->query($sql29);
  $row29 = mysqli_num_rows($result29);
  $data['over_all_officer_in_charge'] = $row29;

  $result30 = $conn->query($sql30);
  $row30 = mysqli_num_rows($result30);
  $data['mcc'] = $row30;

  $result31 = $conn->query($sql31);
  $row31 = mysqli_num_rows($result31);
  $data['anafara'] = $row31;

  $result32 = $conn->query($sql32);
  $row32 = mysqli_num_rows($result32);
  $data['visvis'] = $row32;

  $result32a = $conn->query($sql32a);
  $row32a = mysqli_num_rows($result32a);

  $result32b = $conn->query($sql32b);
  $row32b = mysqli_num_rows($result32b);
  $data['mcc_on_progress'] = $row32b;
  
  $result32c = $conn->query($sql32c);
  $row32c = mysqli_num_rows($result32c);
  $data['ana_on_progress'] = $row32c + $row32a;





  $result33 = $conn->query($sql33);
  $row33 = mysqli_num_rows($result33);
  $data['total_admins'] = $row33;

  $result34 = $conn->query($sql34);
  $row34 = mysqli_num_rows($result34);
  $data['total_staffs'] = $row34;

  $result35 = $conn->query($sql35);
  $row35 = mysqli_num_rows($result35);
  $data['total_interns'] = $row35;

  $result36 = $conn->query($sql36);
  $row36 = mysqli_num_rows($result36);
  $data['total_users'] = $row36;
  
  
  $result37 = $conn->query($sql37);
  $row37 = mysqli_num_rows($result37);
  $data['checked_project'] = $row37;
  
  $result38 = $conn->query($sql38);
  $row38 = mysqli_num_rows($result38);
  $data['unchecked_project'] = $row38;
  
  $result39 = $conn->query($sql39);
  $row39 = mysqli_num_rows($result39);
  
  $result39a = $conn->query($sql39a);
  $row39a = mysqli_num_rows($result39a);
  $data['unchecked_team'] = $row39 + $row39a;
  
  $result40 = $conn->query($sql40);
  $row40 = mysqli_num_rows($result40);
  
  $result40a = $conn->query($sql40a);
  $row40a = mysqli_num_rows($result40a);
  $data['checked_team'] = $row40 + $row40a;



  $sql_month_1 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'January'";
  $result_mont_1 = $conn->query($sql_month_1);
  $row_month_1 = mysqli_num_rows($result_mont_1);
  
  $sql_month_2 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'February'";
  $result_mont_2 = $conn->query($sql_month_2);
  $row_month_2 = mysqli_num_rows($result_mont_2);
  
  $data['jan_feb'] = $row_month_1 + $row_month_2;

  $sql_month_3 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'March'";
  $result_mont_3 = $conn->query($sql_month_3);
  $row_month_3 = mysqli_num_rows($result_mont_3);
  
  $sql_month_4 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'April'";
  $result_mont_4 = $conn->query($sql_month_4);
  $row_month_4 = mysqli_num_rows($result_mont_4);
  
  $data['mar_apr'] = $row_month_3 + $row_month_4;
  
  
  $sql_month_5 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'May'";
  $result_mont_5 = $conn->query($sql_month_5);
  $row_month_5 = mysqli_num_rows($result_mont_5);
  
  $sql_month_6 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'June'";
  $result_mont_6 = $conn->query($sql_month_6);
  $row_month_6 = mysqli_num_rows($result_mont_6);
  
  $data['may_jun'] = $row_month_5 + $row_month_6;

  $sql_month_7 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'July'";
  $result_mont_7 = $conn->query($sql_month_7);
  $row_month_7 = mysqli_num_rows($result_mont_7);
  
  $sql_month_8 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'August'";
  $result_mont_8 = $conn->query($sql_month_8);
  $row_month_8 = mysqli_num_rows($result_mont_8);
  
  $data['jul_aug'] = $row_month_7 + $row_month_8;
  
  $sql_month_9 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'September'";
  $result_mont_9 = $conn->query($sql_month_9);
  $row_month_9 = mysqli_num_rows($result_mont_9);
  
  $sql_month_10 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'October'";
  $result_mont_10 = $conn->query($sql_month_10);
  $row_month_10 = mysqli_num_rows($result_mont_10);
  
  $data['sept_oct'] = $row_month_9 + $row_month_10;

  $sql_month_11 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'November'";
  $result_mont_11 = $conn->query($sql_month_11);
  $row_month_11 = mysqli_num_rows($result_mont_11);
  
  $sql_month_12 = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_fixed,' ',1) = 'December'";
  $result_mont_12 = $conn->query($sql_month_12);
  $row_month_12 = mysqli_num_rows($result_mont_12);
  
  $data['nov_dec'] = $row_month_11 + $row_month_12;
  
  
  
  

  
  
  $sql_month_1a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'January' AND report_status = 'Pending'";
  $result_mont_1a = $conn->query($sql_month_1a);
  $row_month_1a = mysqli_num_rows($result_mont_1a);
  
  $sql_month_2a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'February' AND report_status = 'Pending'";
  $result_mont_2a = $conn->query($sql_month_2a);
  $row_month_2a = mysqli_num_rows($result_mont_2a);
  
  $data['jan_feba'] = $row_month_1a + $row_month_2a;

  $sql_month_3a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'March' AND report_status = 'Pending'";
  $result_mont_3a = $conn->query($sql_month_3a);
  $row_month_3a = mysqli_num_rows($result_mont_3a);
  
  $sql_month_4a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'April' AND report_status = 'Pending'";
  $result_mont_4a = $conn->query($sql_month_4a);
  $row_month_4a = mysqli_num_rows($result_mont_4a);
  
  $data['mar_apra'] = $row_month_3a + $row_month_4a;
  
  
  $sql_month_5a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'May' AND report_status = 'Pending'";
  $result_mont_5a = $conn->query($sql_month_5a);
  $row_month_5a = mysqli_num_rows($result_mont_5a);
  
  $sql_month_6a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'June' AND report_status = 'Pending'";
  $result_mont_6a = $conn->query($sql_month_6a);
  $row_month_6a = mysqli_num_rows($result_mont_6a);
  
  $data['may_juna'] = $row_month_5a + $row_month_6a;

  $sql_month_7a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'July' AND report_status = 'Pending'";
  $result_mont_7a = $conn->query($sql_month_7a);
  $row_month_7a = mysqli_num_rows($result_mont_7a);
  
  $sql_month_8a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'August' AND report_status = 'Pending'";
  $result_mont_8a = $conn->query($sql_month_8a);
  $row_month_8a = mysqli_num_rows($result_mont_8a);
  
  $data['jul_auga'] = $row_month_7a + $row_month_8a;
  
  $sql_month_9a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'September' AND report_status = 'Pending'";
  $result_mont_9a = $conn->query($sql_month_9a);
  $row_month_9a = mysqli_num_rows($result_mont_9a);
  
  $sql_month_10a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'October' AND report_status = 'Pending'";
  $result_mont_10a = $conn->query($sql_month_10a);
  $row_month_10a = mysqli_num_rows($result_mont_10a);
  
  $data['sept_octa'] = $row_month_9a + $row_month_10a;

  $sql_month_11a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'November' AND report_status = 'Pending'";
  $result_mont_11a = $conn->query($sql_month_11a);
  $row_month_11a = mysqli_num_rows($result_mont_11a);
  
  $sql_month_12a = "SELECT date_fixed FROM intern_report WHERE SUBSTRING_INDEX(date_reported,' ',1) = 'December' AND report_status = 'Pending'";
  $result_mont_12a = $conn->query($sql_month_12a);
  $row_month_12a = mysqli_num_rows($result_mont_12a);
  
  $data['nov_deca'] = $row_month_11a + $row_month_12a;
  

  echo json_encode($data);
  
  $conn->close();

?>