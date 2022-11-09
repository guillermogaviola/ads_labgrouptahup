<?php
require_once "config.php";

$flower_name = $type = $scientific_name = $description  = "";
$flower_name_error = $type_error = $scientific_name_error = $description_error = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

        $flowerName = trim($_POST["flower_name"]);
        if (empty($flowerName)) {
            $flower_name_error = "Flower Name is required.";
        } elseif (!filter_var($flowerName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $flower_name_error = "Flower Name is invalid.";
        } else {
            $flowerName = $flowerName;
        }

        $type = trim($_POST["type"]);

        if (empty($type)) {
            $type_error = "type is required.";
        } elseif (!filter_var($type, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $type_error = "type is invalid.";
        } else {
            $type = $type;
        }

        $scientific_name = trim($_POST["scientific_name"]);
        if (empty($scientific_name)) {
            $scientific_name_error = "scientific_name is required.";
        } elseif (!filter_var($scientific_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
            $scientific_name_error = "scientific name is valid ";
        } else {
            $scientific_name = $scientific_name;
        }

        $description = trim($_POST["description"]);
        if (empty($description)){
            $description_error = "description is required.";
        } else {
            $description = $description;
        }

       

    if (empty($flower_name_error_err) && empty($type_error) &&
        empty($scientific_name_error) && empty($description_error)) {

          $sql = "UPDATE buwak SET flower_name= '$flowerName', type= '$type', scientific_name = '$scientific_name', description= '$description'  WHERE id='$id'";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
              echo "Something went wrong. Please try again later.";
          }

    }

    mysqli_close($conn);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $query = mysqli_query($conn, "SELECT * FROM buwak WHERE ID = '$id'");

        if ($user = mysqli_fetch_assoc($query)) {
            $flowerName   = $user["flower_name"];
            $type    = $user["type"];
            $scientific_name   = $user["scientific_name"];
            $description = $user["description"];
    
        } else {
            echo "Something went wrong. Please try again later.";
            header("location: edit.php");
            exit();
        }
        mysqli_close($conn);
    }  else {
        echo "Something went wrong. Please try again later.";
        header("location: edit.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update User</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                      <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group <?php echo (!empty($first_name_error)) ? 'has-error' : ''; ?>">
                            <label>Flower Name</label>
                            <input type="text" name="flower_name" class="form-control" value="<?php echo $flowerName; ?>">
                            <span class="help-block"><?php echo $flower_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($last_name_error)) ? 'has-error' : ''; ?>">
                            <label>type</label>
                            <input type="text" name="type" class="form-control" value="<?php echo $type; ?>">
                            <span class="help-block"><?php echo $type_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($scientific_name_error)) ? 'has-error' : ''; ?>">
                            <label>Scientific Name</label>
                            <input type="scientific_name" name="scientific_name" class="form-control" value="<?php echo $scientific_name; ?>">
                            <span class="help-block"><?php echo $scientific_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($description_error)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <input type="description" name="description" class="form-control" value="<?php echo $description; ?>">
                            <span class="help-block"><?php echo $description_error;?></span>
                        </div>

                      

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>