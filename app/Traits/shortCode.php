<?php

namespace App\Traits;

trait shortCode {


    public function runCode() {

        return substr(str_pad(rand(0,'11'.round(microtime(true))), 17 , "0", STR_PAD_LEFT), 9);

    }

}
