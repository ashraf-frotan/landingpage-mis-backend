<?php

    // get file name
    function fileName($path)
    {
        $pos=strripos($path,'/');
        return substr($path,$pos+1);
    }