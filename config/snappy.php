<?php

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $binaryPdf = '"C:\Program Files\wkhtmltopdf\bin\wkhtmltopdf"';
    $binaryImg = '"C:\Program Files\wkhtmltopdf\bin\wkhtmltoimage"';
}else{
    $binaryPdf = '"/opt/wkhtmltox/bin/wkhtmltopdf"';
    $binaryImg = '"/opt/wkhtmltox/bin/wkhtmltoimage"';
}


return array(


    'pdf' => array(
        'enabled' => true,
        'binary'  => $binaryPdf,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary'  => $binaryImg,
        'timeout' => false,
        'options' => array(),
        'env'     => array(),
    ),


);
