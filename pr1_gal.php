<?php
?>
<!DOCTYPE html>
<html>
<head>
<style>
body{
  margin: 0;
  color: #F9FBF2;
  background: #c8c8c8;
  font: 600 18px/18px 'Open Sans';
  text-shadow: 1px 1px 2px #4C4C4C;
  text-align: center;
}
.gallery-wrap{
  width: 100%;
  margin: auto;
  margin-top: 30px;
  max-width: 980px;
  min-height: 580px;
  position: relative;
  background: url(sunset.jpg) no-repeat center;
  box-shadow: 0 12px 15px 0 rgba(0,0,0,.24), 0 17px 50px 0 rgba(0, 0, 0, .19);
  text-align: left;
}
.gallery {
  align-self: center;
  margin: 10px 30px;
  float: left;
  width: 180px;
  height: 135px;
}

.gallery:hover {
  border: 0.5px solid #777;
}

.gallery img {
  width: 100%;
  height: auto;
  box-shadow: 0 12px 15px 0 rgba(0,0,0,.24), 0 17px 50px 0 rgba(0, 0, 0, .19);
}
.form {
  padding: 70px 50px 50px 300px;
}
.button{
  text-shadow: 1px 1px 3px #4C4C4C;
  color: #F9FBF2;
  font: 600 15px 'Open Sans';
  border-radius: 25px;
  background: #85BAA1;
  padding: 10px 40px;
  color: #fff;
  border: 0px;
  margin-left:10px;
}
.input {
  border: none;
  width: 50%;
  padding: 10px 10px;
  border-radius: 25px;
  background: rgba(255,255,255,.15);
} 
} 
</style>
</head>
<body>
<div class='gallery-wrap'>
  <form method="post" action='' enctype="multipart/form-data" class='form'>
    <input type="file" name="image" accept="image/*" value="Upload" class='input'>
    <input type="submit" name="submit" value='Upload' class='button'>
  </form>
</html>
<?php
// Tạo connection
$servername = 'localhost';
$username = "root";
$password = '';
$database = 'myDB';
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die('Connection failed:' . $conn->connect_error);
}

// Tạo bảng 
$sql = 'CREATE TABLE project1_gal (
id INT(6) PRIMARY KEY,
image LONGTEXT NOT NULL
)';
$conn->query($sql);
if (isset($_POST['submit'])) {
  $name = $_FILES['image']['name'];
  $target_dir = 'img/';
  $target_file = $target_dir . basename($_FILES['image']['name']);
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  $extensions_arr = array('jpg', 'jpeg', 'png', 'gif');
  if (in_array($imageFileType, $extensions_arr)) {
    if (!file_exists($target_dir . basename($target_file, PATHINFO_EXTENSION))) {
      $query = "INSERT INTO project1_gal(name) VALUES ('".$name."')";
      $conn->query($query);
      move_uploaded_file($_FILES['image']['tmp_name'], $target_dir.$name);
    }
  }
}

$current_record = mysqli_fetch_array($conn->query("SELECT COUNT(*) FROM project1_gal"))[0];
for ($i = 1; $i <= $current_record; $i++) {
  $sql = "SELECT name FROM project1_gal WHERE id= '$i'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result);
  $image = $row['name'];
  $image_src = "img/".$image;
?>
  <html>
    <div class='gallery'>
      <img class='img' src='<?php echo $image_src;?>'>
    </div>
  </html>
<?php
}
?>
<html>
</div>
</body>
</html>