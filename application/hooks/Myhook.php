<?php

class Myhook {
    public function testHook(){
        echo "<br><b>".'pre hook'."</b><br>";
    }
    public function testHook2($params){

        echo "<br><b>".$params[0]."</b><br>";
        echo "<br><b>".'pre hook'."</b><br>";
    }
}