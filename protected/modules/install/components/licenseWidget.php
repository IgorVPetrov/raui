<?php


class licenseWidget extends CWidget
{
    public $autoOpen = true;

    public function run() {

        $license = @file_get_contents('#?host='.$_SERVER['HTTP_HOST']);

        if ($license){
            echo $license;
        }else{
            $this->render('application.modules.install.views.license');
        }
    }
}