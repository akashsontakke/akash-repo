<?php


include 'database.php';
include 'sub_division_operation.php';

$database = new Database();
$db = $database->connect();

$sub_division = new Sub_division_operation($db);

$result = $sub_division->read();

$data = $result->fetchAll(PDO::FETCH_ASSOC);

$id = '';
$editData = [];

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $sub_division->id = $id;

    $editData = $sub_division->getSingle();
}

if(isset($_GET['delete'])) {

    $id = $_GET['delete'];

    $sub_division->id = $id;

    $sub_division->delete();

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}


if(isset($_POST['save'])) {

    $sub_division->id = $_POST['id'];

    $sub_division->division_name = $_POST['division_name'];
    $sub_division->slider_sub_text = $_POST['slider_sub_text'];
    $sub_division->slider_text = $_POST['slider_text'];

    if(!empty($_FILES['icon_image']['name'])) {
        $icon = time().'_'.$_FILES['icon_image']['name'];
        move_uploaded_file($_FILES['icon_image']['tmp_name'], "images/".$icon);
        $sub_division->icon_img = "images/".$icon;
    } else {
        $sub_division->icon_img = $_POST['old_icon_img'];
    }

    if(!empty($_FILES['slider_image']['name'])) {
        $img = time().'_'.$_FILES['slider_image']['name'];
        move_uploaded_file($_FILES['slider_image']['tmp_name'], "images/".$img);
        $sub_division->slider_image = "images/".$img;
    } else {
        $sub_division->slider_image = $_POST['old_slider_image'];
    }

    if(empty($sub_division->id)) {
        $sub_division->create();
    } else {
        $sub_division->update();
    }

    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Service</title>

     <link rel="stylesheet"
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body class="container" style="margin-top:50px;">

<button class="btn btn-primary" data-toggle="modal" data-target="#sliderModal">Add User</button>

<br><br>

<table class="table table-bordered">

    <tr>
        <th>Sr No</th>
        <th>Icon Image</th>
        <th>Division Name</th>
        <th>Slider Sub Text</th>
        <th>Slider Text</th>
        <th>Slider Image</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

<?php 
    $count = 1;
    foreach($data as $rows) {
?>

<tr>
    
    <td><?php echo  $count; ?></td>
    <td><img src="<?php echo $rows['icon_img']; ?>" width="50"></td>
    <td><?php echo $rows['division_name']; ?></td>
    <td><?php echo $rows['slider_sub_text']; ?></td>
    <td><?php echo $rows['slider_text']; ?></td>
    <td><img src="<?php echo $rows['slider_image']; ?>" width="50"></td>

    <td>
        <a href="?id=<?php echo $rows['id']; ?>" class="btn btn-info"> <i class="fa fa-pencil"></i> </a>
    </td>
    <td>
       <a href="?delete=<?php echo $rows['id']; ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this record?');">
        <i class="fa fa-trash"></i>
    </a>
    </td>

</tr>

<?php $count++; } ?>

</table>

<!-- MODAL -->

<div id="sliderModal" class="modal fade" role="dialog">

    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <button type="button" class="close"  data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">
                        <?php echo ($id) ? 'Update' : 'Create'; ?> User
                    </h4>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $editData['id'] ?? ''; ?>">

                    <div class="form-group">
                        <label>Division Name</label>
                        <input type="text" name="division_name" class="form-control" value="<?php echo $editData['division_name'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Icon Image</label>
                        <input type="file" name="icon_image" class="form-control" value="<?php echo $email; ?>">
                        <input type="hidden" name="old_icon_img" value="<?php echo $editData['icon_img'] ?? ''; ?>">
                        <?php if(!empty($editData['icon_img'])) { ?>
                            <img src="<?php echo $editData['icon_img']; ?>" width="50">
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label>Slider Sub Text</label>
                        <input type="text" name="slider_sub_text" class="form-control" value="<?php echo $editData['slider_sub_text'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Slider Text</label>
                        <input type="text" name="slider_text" class="form-control" value="<?php echo $editData['slider_text'] ?? ''; ?>">
                    </div>

                    <div class="form-group">
                        <label>Slider Image</label>
                        <input type="file" name="slider_image" class="form-control" value="<?php echo $name; ?>">
                        <input type="hidden" name="old_slider_image" value="<?php echo $editData['slider_image'] ?? ''; ?>">
                        <?php if(!empty($editData['slider_image'])) { ?>
                            <img src="<?php echo $editData['slider_image']; ?>" width="50">
                        <?php } ?>
                    </div>

                </div>

                <div class="modal-footer">
                    <!-- <button type="submit" name="save" class="btn btn-success">Save</button> -->
                    <input type="submit" name="save" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(isset($_GET['id'])) { ?>

    <script>

    $(document).ready(function(){

        $('#sliderModal').modal('show');

    });

    </script>

<?php } ?>

</body>
</html>