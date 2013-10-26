<?php

header("Pragma: public"); // required
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false); // required for certain browsers
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$file.csv\"");
header("Content-Transfer-Encoding: binary");

echo '"' . implode('","', $header) . '"' . "\n";

foreach($data as $row)
{
    echo '"' . implode('","', $row) . '"' . "\n";
}
