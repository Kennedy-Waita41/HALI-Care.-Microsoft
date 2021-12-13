<?php  include('../config.php'); ?>
<?php include(ROOT_PATH . '/Patients/includes/head_section.php'); ?>

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
        
    </script>
</head>
<body>
<?php include(ROOT_PATH . '/Patients/includes/navbar.php') ?>
    <div class="container content" style="width: 100%;padding: 40px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Patient Ticket</h2>
                        <a href="P_user.php" class="btn btn-success pull-right" style="position: center"><i class="fa fa-plus"></i> Book new consultation</a>
                    </div>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "", "halicare");
                    // Attempt select query execution
                    $sql = "SELECT * FROM consultation";
                    if($result = $conn->query($sql)){
                        if($result->num_rows > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>id</th>";
                                        echo "<th>PatientID</th>";
                                        echo "<th>Consult Status</th>";
                                        echo "<th>Date of booking</th>";
                                        
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = $result->fetch_array()){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['patientId'] . "</td>";
                                        echo "<td>" . $row['consult_status'] . "</td>";
                                        echo "<td>" . $row['date_added'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            $result->free();
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    
                    // Close connection
                    $conn->close();
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>