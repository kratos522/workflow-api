<?php

namespace App;

class PolyBaseFactory {

    public static function getWorkflow($workflow_type) {
        $log = new \Log;
        // grab request variable
        $workflow = implode(explode(" ",ucwords(str_replace("_", " ", $workflow_type))));
        // construct our class name and check its existence
        $class = 'App\\'.$workflow."Workflow";
        if(class_exists($class)) {
            // return a new Ruler object
            $log::alert($class);
            return new $class();
        }
        $log::alert('Unsupported workflow Class');
        // otherwise we fail
        throw new Exception('Unsupported workflow Class');
    }
}
