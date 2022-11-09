<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Dashboard</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <style type="text/css">
          .wrapper {
              width: 1200px;
              margin: 0 auto;
          }
      </style>
  </head>
  <body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
              <h2 class="text-center">Kinds of Flower<a href="https://codingdriver.com/"> Group Tahup</a></h2>
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">FLOWERS</h2>
                        <a href="create.php" class="btn btn-success pull-right">Add Flowers</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // select all users
                    $data = "SELECT * FROM buwak";
                    if($buwaks = mysqli_query($conn, $data)){
                        if(mysqli_num_rows($buwaks) > 0){
                            echo "<table class='table table-bordered table-striped'>
                                    <thead>
                                      <tr>
                                        <th>id</th>
                                        <th>Flower Name</th>
                                        <th>type</th>
                                        <th>scientific Name</th>
                                        <th>description</th>
                                        <th>action</th>
                                      </tr>
                                    </thead>
                                    <tbody>";
                                while($buwak = mysqli_fetch_array($buwaks)) {
                                    echo "<tr>
                                            <td>" . $buwak['id'] . "</td>
                                            <td>" . $buwak['flower_name'] . "</td>
                                            <td>" . $buwak['type'] . "</td>
                                            <td>" . $buwak['scientific_name'] . "</td>
                                            <td>" . $buwak['description'] . "</td>
                                            <td>
                                              <a href='read.php?id=". $buwak['id'] ."' title='View User' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>
                                              <a href='edit.php?id=". $buwak['id'] ."' title='Edit User' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>
                                              <a href='delete.php?id=". $buwak['id'] ."' title='Delete User' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>
                                            </td>
                                          </tr>";
                                }
                                echo "</tbody>
                                </table>";
                            mysqli_free_result($buwaks);
                        } else{
                            echo "<p class='lead'><em>No records found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                    }

                    // Close connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>