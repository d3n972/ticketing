<?php
namespace App\Models;

class JSONResponse{
    public $error=false;
    public $message="";
    public $data=[];

    public function __construct($e=false,$m="",$d=[]){

        $this->error=$e;
        $this->message=$m;
        $this->data=$d;

     }
}
