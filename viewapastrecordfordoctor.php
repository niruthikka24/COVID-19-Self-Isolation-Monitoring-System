<?php
require_once 'classes/db.php';
require_once 'classes/doctor.php';
session_start();

$uname = $_SESSION['username'];

$record_no = $_GET['varname'];

$patient_no = $_GET['varname1'];

$db = Db::getInstance();
$doctor = Doctor::getInstance($uname);

$patient_details = $db->getCommon('patient','patient_no',$patient_no);
$patient_name = $patient_details['patient_name'];

$symptom_record = $db->getAll('symptom_record', 'patient_record_no', $record_no);
$reversed_record = array_reverse($symptom_record);

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
   
            <div class = "record-box" onclick="history.go(-1);" >
           Back
        </div>

        <!-- <button onclick="history.go(-1);">Back </button> -->
       
       
          <br><br>

        <div class="forms">
       
            <div class="form-content">
                <div class="login-form">
                    <div class="title">
                        <h2> Patient <?php echo $patient_no . " - " . $patient_name ?></h2>

                    </div>    
                    
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
                                <td><?php echo $reversed_record[$y]['comments'] ?> </td>
                                    <td><?php echo $reversed_record[$y]['status'] ?> </td>

                                


                            </tr>
                        <?php
                            $y++;
                        }
                        ?>



                    </table>

                </div>



            </div>
        </div>
    </div>
    </div>
</body>

</html>