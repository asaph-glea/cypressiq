<?php
$files = glob("storage/framework/views/*.php");
foreach ($files as $file) {
    exec("php -l " . escapeshellarg($file), $out, $ret);
    if ($ret !== 0) {
        echo "Error in $file: " . implode("\n", $out) . "\n";
    }
}
