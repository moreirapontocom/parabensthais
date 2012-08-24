<?
$name = $_GET['name'];
$email = $_GET['email'];
$message = $_GET['message'];
$image = $_GET['image'];

$name = trim($name);
$email = trim($email);
$message = trim($message);
$image = trim($image);

$name = htmlspecialchars($name);
$email = htmlspecialchars($email);
$message = htmlspecialchars($message);
$image = htmlspecialchars($image);

$name = addslashes($name);
$email = addslashes($email);
$message = addslashes($message);
$image = addslashes($image);

$author = utf8_decode($author);
$message = utf8_decode($message);
$email = utf8_decode($email);
$image = utf8_decode($image);

$name = substr($name,0,100);
$email = substr($email,0,100);
$image = urlencode($image);

if ( $name <> '' && $email <> '' && $message <> '' ) {
    include('conecta.php');
    $sql = "INSERT INTO messages (authorName,email,message,image) VALUES ('".$name."','".$email."','".$message."','".$image."')";
    if ( mysql_query($sql) or die (mysql_error()) )
        return true;
    else
        return false;
}
?>