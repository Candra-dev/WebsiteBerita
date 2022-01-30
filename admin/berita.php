<form method="POST" action="" enctype="multipart/form-data">

<tr>
<td>foto diri</td>
<td>:</td>
<td><input type="file" name="file"></td>
</tr>
<tr>
<td></td>
<td></td>
<td><input type="submit" name="hasil" value="kirim"></td>
</tr>

</form>

<?php
if ( isset($_POST["hasil"])) {
    $file     = $_FILES["file"]["name"];
    $source = $_FILES["file"]["tmp_name"];
    

    move_uploaded_file($source, "gambar/".$file);

}

?>