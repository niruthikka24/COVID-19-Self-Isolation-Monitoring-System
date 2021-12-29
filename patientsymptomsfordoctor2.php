<?php
require_once 'classes/db.php';
require_once 'classes/mail.php';
require_once 'classes/doctor.php';
session_start();

$uname = $_SESSION['username'];

$record_no = $_GET['varname'];

$patient_no = $_GET['varname1'];
$status="";

$db = Db::getInstance();
$doctor = Doctor::getInstance($uname);
$mail = new Mail();

$patient_details = $db->getCommon('patient','patient_no',$patient_no);
$patient_name = $patient_details['patient_name'];
$patient_email = $patient_details['email_add'];

$symptom_record = $db->getAll('symptom_record', 'patient_record_no', $record_no);
$reversed_record = array_reverse($symptom_record);

if(!empty($_POST['confirm-btn'])){
    if(isset($_POST['status'])){
        $status = $_POST['status'];
    }
    if(isset($_POST['comments'])){
        $comments = $_POST['comments'];
    }
    else{
        $comments = $_POST['defaultcomments'];
    }
    if($doctor->updateComment($comments, $status, $record_no)){
        header("Location:doctordashboard.php");
    }
    else{
        echo $doctor->updateComment($comments, $status, $record_no);
    }
}

if(!empty($_POST['close-btn'])){
    $record_details = $db->getCommon('patient_record','patient_record_no',$record_no);
    if($db->updateNew('patient_record','patient_record_no',$record_no, array('end_date'=>date('Y-m-d'), 'status'=>'sent to hospital'))){
        $mail->sendRecordClosedMail($patient_email);
        header("Location:doctordashboard.php");
    }
}

?>


<!DOCTYPE html>
<!-- Coding by CodingLab | www.codinglabweb.com-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="patientsymptomsfordoctor1.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>



    <div class="container">

        
           <div class = "record-box" onclick="location.href='doctordashboard.php'" style="cursor:pointer;" >
           Home
        </div> 

        <br>
        <div class = "record-box" onclick="location.href='patientpastfordoctor.php?varname=<?php echo $record_no ?>&varname1=<?php echo $patient_no ?>'" style="cursor:pointer;" >
            View Past Records
        </div> 
        <br>
    
        

        
   
        <!-- <input type="checkbox" id="flip"> -->
          <br><br>

        <div class="forms">
        <form action="#" method="post">
            <div class="form-content">
                <div class="login-form">
                    <div class="title">
                        <h2> Patient <?php echo $patient_no . " - " . $patient_name ?></h2>

                    </div>    
                    
                    <br> <br>
                
                    <input type="submit" id="input-box2" name = "confirm-btn" value="Confirm" style ="font-size:18px"  />
                    
                    <input type="submit" id="input-box2" name = "close-btn" value="Close Record" style ="font-size:18px"  />
                  
                    <br> <br>

                    <table>

                        <tr>
                            <th>Day</th>
                            <th class="date">Date</th>
                            <th>Oxygen Saturation</th>
                            <th>Pressure</th>
                            <th>Pulse Rate</th>
                            <th>Temperature</th>
                            <th>Shortness of breathe</th>
                            <th>Fever</th>
                            <th>Sore Throat</th>
                            <th>Chills & Body Aches</th>
                            <th>Confusion</th>
                            <th>Nausea,Vomitting,Diarrhea</th>
                            <th>Runny nose</th>
                            <th>Redness of eyes</th>
                            <th>Headache</th>
                            <th>Loss of taste or smell</th>
                            <th>Doubts</th>
                            <th>Comments</th>
                            <th>Status</th>

                        </tr>
                        <?php
                        $y = 0;

                        while ($y < count($reversed_record)) {
                        ?>
                            <tr>
                                <td><?php echo count($reversed_record) - $y ?> </td>

                                <td><?php echo $reversed_record[$y]['date'] ?> </td>
                                <td><?php echo $reversed_record[$y]['oxygen'] ?> </td>
                                <td><?php echo $reversed_record[$y]['pressure1'] ?>/<?php echo $reversed_record[$y]['pressure2'] ?> </td>
                                <td><?php echo $reversed_record[$y]['pulse'] ?> </td>
                                <td><?php echo $reversed_record[$y]['temperature'] ?> </td>
                                <td><?php if ($reversed_record[$y]['breathe'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['fever'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['throat'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                               <td><?php if ($reversed_record[$y]['body_ache'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['confusion'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['vomit'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['nose'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                               <td><?php if ($reversed_record[$y]['eyes'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['headache'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php if ($reversed_record[$y]['taste'] == "yes") { ?><span>&#9989;</span>
                                    <?php ;
                                    } else { ?><span>&#10060;</span><?php ;
                                                                    } ?> </td>
                                <td><?php echo $reversed_record[$y]['doubt'] ?> </td>

                                <?php if($reversed_record[$y]['status'] == "Pending") { ?>

                                    <td> 
                                    <input type="text" name="comments[]" />
                                    <input type="hidden" name="defaultcomments[]" value='<?php echo $reversed_record[$y]['symptom_record_no']; ?>' />                                    
                                    </td>
                                    <td>
                                    <input type = 'checkbox' name = 'status[]' 
                                    value = '<?php echo $reversed_record[$y]['symptom_record_no']; ?>'>                                     
                                    </td>
                                    
                                <?php } else { ?> 

                                    <td><?php echo $reversed_record[$y]['comments'] ?> </td>
                                    <td><?php echo $reversed_record[$y]['status'] ?> </td>

                                <?php } ?>


                            </tr>
                        <?php
                            $y++;
                        }
                        ?>



                    </table>

                </div>



            </div>
        </div>
                    </form>
    </div>
    </div>
</body>

</html>