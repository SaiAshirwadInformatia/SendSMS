<?php
spl_autoload_register(
    function ($classname) {
        $foldersToCheckIn = ['src', 'test'];
        foreach ($foldersToCheckIn as $folderName) {
            $classpath = SAI_SENDSMS_PATH . $folderName . DS . $classname . '.php';

            if (file_exists($classpath)) {
                require_once $classpath;
                break;
            }
        }
    }
);
