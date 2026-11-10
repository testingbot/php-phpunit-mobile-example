<?php

// Runs the tests once per device in the config file, all at the same time.
// Usage: php lib/parallel.php <config file> <test directory>
$configFile = $argv[1] ?? 'config/android/parallel.conf.json';
$testDir = $argv[2] ?? 'tests/android';
$config = json_decode(file_get_contents($configFile), true, 512, JSON_THROW_ON_ERROR);

$phpunit = escapeshellarg(__DIR__ . '/../vendor/bin/phpunit');
$procs = [];

foreach (array_keys($config['environments']) as $taskId) {
    $cmd = 'CONFIG_FILE=' . escapeshellarg($configFile) . " TASK_ID=$taskId " . PHP_BINARY . " $phpunit " . escapeshellarg($testDir) . ' 2>&1';
    echo $cmd . PHP_EOL;
    $procs[$taskId] = popen($cmd, 'r');
}

$failed = false;
foreach ($procs as $proc) {
    while (!feof($proc)) {
        echo fgets($proc, 4096);
    }
    if (pclose($proc) !== 0) {
        $failed = true;
    }
}

exit($failed ? 1 : 0);
