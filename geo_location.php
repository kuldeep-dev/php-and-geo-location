How to make distance between two google address in sql



open your sql server like phpMyadmin then select the database after that execute the query below in the SQL command. Then you can use the function on any file on your server  .

DELIMITER $$

DROP FUNCTION IF EXISTS `get_distance_in_miles_between_geo_locations` $$
CREATE FUNCTION get_distance_in_miles_between_geo_locations(geo1_latitude decimal(10,6), geo1_longitude decimal(10,6), geo2_latitude decimal(10,6), geo2_longitude decimal(10,6))
returns decimal(10,3) DETERMINISTIC
BEGIN
return ((ACOS(SIN(geo1_latitude * PI() / 180) * SIN(geo2_latitude * PI() / 180) + COS(geo1_latitude * PI() / 180) * COS(geo2_latitude * PI() / 180) * COS((geo1_longitude - geo2_longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515);
END $$

DELIMITER ;

Then execute select query:

SELECT ID, get_distance_in_miles_between_geo_locations($latitude,$longitude,latitude,longitude) as distance  FROM users HAVING distance < 50 ORDER BY distance


=============================================================================

get latitude longitude from an address in php

Use following code to get the latitude longitude of an address:


$address_geo ="Sec 17 Chandigarh";

// We get the JSON results from this request
$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address_geo).'&sensor=false');

// We convert the JSON to an array
$geo = json_decode($geo, true);

// If everything is cool
if ($geo['status'] = 'OK') {
   // We set our values
   $latitude = $geo['results'][0]['geometry']['location']['lat'];
   $longitude = $geo['results'][0]['geometry']['location']['lng'];
}



========================================================================================


Send email with attachment in php

We have tested this code is working good .This method is using the mail() function of PHP so you can send the attachment file in the email.

you can post you file in $fileatt variable or you can give the link of file in the $fileatt variable.

It will be auto rename so you can pass the name in $fileattname.


$name        = "Name goes here";
$email       = "looklikeme05@gmail.com";
$to          = "$name <$email>";
$from        = "Signature";
$subject     = "Here is your attachment";
$mainMessage = "Hi, here's the file.";
$fileatt     = "".time()."filename.pdf";
$fileatttype = "application/pdf";
$fileattname = "newname.pdf";
$headers = "From: $from";

// File
$file = fopen($fileatt, 'rb');
$data = fread($file, filesize($fileatt));
fclose($file);

// This attaches the file
$semi_rand     = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers      .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$message = "This is a multi-part message in MIME format.\n\n" .
"-{$mime_boundary}\n" .
"Content-Type: text/plain; charset=\"iso-8859-1\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$mainMessage  . "\n\n";

$data = chunk_split(base64_encode($data));
$message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatttype};\n" .
" name=\"{$fileattname}\"\n" .
"Content-Disposition: attachment;\n" .
" filename=\"{$fileattname}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"-{$mime_boundary}-\n";

// Send the email
if(mail($to, $subject, $message, $headers)) {

    echo "The email was sent.";
    echo "<script>window.location='../index.php'</script>";

}
else {

    echo "There was an error sending the mail.";
    echo "<script>window.location='../index.php'</script>";

}



=================================================================================


How to open a word document in browser using with PHP or HTML.


You can read any doc file on your browser so copy and paste this code in any file and give the file link in the readfile .


<?php
header('Content-disposition: inline');
header('Content-type: application/msword'); use correct MIME type
readfile('asdf.doc');
exit;
?>



======================================================================================



