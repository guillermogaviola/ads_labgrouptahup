<?php
require_once "config.php";

$flower_name = $type = $scientific_name = $description="";
$flower_name_error = $type_error = $scientific_name_error = $description_error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flowerName = trim($_POST["flower_name"]);
    if (empty($flowerName)) {
        $flower_name_error = "Flower Name is required.";
    } elseif (!filter_var($flowerName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $flower_name_error = "First Name is invalid.";
    } else {
        $flowerName = $flowerName;
    }

    $type = trim($_POST["type"]);

    if (empty($type)) {
        $type_error = "type is required.";
    } elseif (!filter_var($flowerName,FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $type_error = "type is invalid.";
    } else {
        $type = $type;
    }

    $scientific_name = trim($_POST["scientific_name"]);
    if (empty($scientific_name)) {
        $scientific_name_error = "Scientific_Name is required.";
    } elseif (!filter_var($flowerName, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))) {
        $scientific_name_error = "Scientific Name is valid ";
    } else {
        $scientific_name = $scientific_name;
    }

    $description = trim($_POST["description"]);
    if(empty($description)){
        $description_error = "Description is required.";
    } else {
        $description = $description;
    }

   
    if (empty($flower_name_error_err) && empty($type_error) && empty($scientific_name_error) && empty($description_error)  ) {
          $sql = "INSERT INTO buwak (flower_name, type, scientific_name, description) VALUES ('$flowerName', '$type', '$scientific_name', '$description')";

          if (mysqli_query($conn, $sql)) {
              header("location: index.php");
          } else {
               echo "Something went wrong. Please try again later.";
          }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flowers</title>
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
                        <h2>Flowers</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($flower_name_error)) ? 'has-error' : ''; ?>">
                            <label>Flower Name</label>
                            <input type="text" name="flower_name" class="form-control" value="">
                            <span name="-><?php echo $flowers_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($type_error)) ? 'has-error' : ''; ?>">
                            <label>Type</label>
                            <input type="text" name="type" class="form-control" value="">
                            <span class="help-block"><?php echo $type_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($scientific_name_error)) ? 'has-error' : ''; ?>">
                            <label>Scientific Name</label>
                            <input type="scientific_name" name="scientific_name" class="form-control" value="">
                            <span class="help-block"><?php echo $scientific_name_error;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($description_error)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <input type="description" name="description" class="form-control" value="">
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