<?php
spl_autoload_register(
    function ($classname) {
        $classpath = SAI_SENDSMS_PATH . 'src' . DS . $classname . '.php';

        if (file_exists($classpath)) {
            require_once $classpath;
        }
    }
);
