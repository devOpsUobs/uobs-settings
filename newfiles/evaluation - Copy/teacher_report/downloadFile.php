<?php
// Get Filename from CMS/Framework/Library or temporary variable:
$newDoc = 'phpExcelReport.xlsx';

$d=$_GET['d'];


/* Add our HTTP Headers */
// http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html
// http://www.w3.org/Protocols/rfc2616/rfc2616-sec19.html

// Doc generated on the fly, may change so do not cache it; mark as public or
// private to be cached.
header('Pragma: no-cache');
// Mark file as already expired for cache; mark with RFC 1123 Date Format up to
// 1 year ahead for caching (ex. Thu, 01 Dec 1994 16:00:00 GMT)
header('Expires: 0');
// Forces cache to re-validate with server
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
// DocX Content Type
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// Tells browser we are sending file
header('Content-Disposition: attachment; filename='.$d.'.xlsx;');
// Tell proxies and gateways method of file transfer
header('Content-Transfer-Encoding: binary');
// Indicates the size to receiving browser
header('Content-Length: '.filesize($newDoc));

// Send the file:
readfile($newDoc);

// Delete the file if you so choose. BE CAREFULE; YOU MAY NEED TO DO THIS
// THROUGH YOUR FRAMEWORK:
unlink($newDoc);

// End the session. BE CAREFUL; YOU NEED TO DO THIS THROUGH YOUR FRAMEWORK:

?>