<?
include("conecta.php");
$sql = "SELECT * FROM messages WHERE published = 1 ORDER BY id DESC";
$query = mysql_query($sql) or die (mysql_error());
while ( $res = mysql_fetch_array($query) ) {
    $id = $res['id'];
    $datePost = $res['datePost'];
    $author = $res['authorName'];
    $message = $res['message'];
    $published = $res['published'];
    $email = $res['email'];
    $image = $res['image'];
    
    $author = utf8_encode($author);
    $message = utf8_encode($message);
    $email = utf8_encode($email);
    $image = urldecode($image);
    
    if ( $email == 'moreirapontocom@gmail.com' ) {
        $theBest = 'style="background-color: #069;color: #FFF;"';
        $theBestName = 'style="color: #FFF;"';
    } else {
        $theBest = 'style="background-color: #FFF;color: #333;"';
        $theBestName = 'style="color: #069;"';
    }
    ?>
    <li <?= $theBest; ?>>
        <span class="commentAuthor" <?= $theBestName; ?>><?= $author; ?></span>
        <?= $message; ?>
        <?
        if ( $image <> '' && substr($image,0,4) == 'http' ) {
            ?>
            <span class="messageImage">
                <img src="<?= $image; ?>" alt="" />
            </span>
            <?
        }
        ?>
    </li>
    <?
}
?>
