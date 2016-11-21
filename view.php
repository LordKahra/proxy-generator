<?php

//require_once 'gatherer.php';
require_once 'app_config.php';

function page_start ($title, $stylesheet, $images=NULL, $colors=false) {
    $headstart = <<<EOD
<!DOCTYPE html>
<html lang="en">
<head>
    <link href='https://fonts.googleapis.com/css?family=Rubik:400,900' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="$stylesheet" type="text/css" />
    <title>$title</title>
EOD;

$imagelink = '\n    <link rel="stylesheet" href="' . SITE_ROOT . 'css/css-images.css" type="text/css" />';
$cssfonts = "\n    <link rel=\"stylesheet\" href=\"css-images.css\" type=\"text/css\" />";
$csscolors = "\n    <link rel=\"stylesheet\" href=\"css-colors.css\" type=\"text/css\" />";
$csscolorsgrayscale = "\n    <link rel=\"stylesheet\" href=\"css-colors-barebones.css\" type=\"text/css\" />";
$cssalign = "\n    <link rel=\"stylesheet\" href=\"css-box-alignment.css\" type=\"text/css\" />";

$headend = <<<EOD
</head>
EOD;

$body = <<<EOD
<body>
    <h1>$title</h1>
EOD;

if (empty($title)) {
        $body = <<<EOD
<body>
EOD;
    }

    echo $headstart;
    
    echo $cssfonts;
    echo $colors ? $csscolors : $csscolorsgrayscale;
    /*if ($colors === "true") { echo $csscolors; }
    else { echo $csscolorsgrayscale; }*/
    echo $cssalign;
    
    if ($images) { echo $imagelink; }
    
    echo $headend;
    echo $body;
}

function page_end () {
    $end = <<<EOD
    
</body>
</html>
EOD;
    echo $end;
}

?>