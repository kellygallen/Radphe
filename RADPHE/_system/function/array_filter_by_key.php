<?php
function request_filter(array $request, array $keys,$LIMITdeep=3) {
    $LIMITdeep--;
    array_walk($request, function (&$value, $key) use ($keys) {
        switch (gettype($value)) { 
//SERIALIZE METHOD IS PROBABLY BETTER.
//            case (substr(serialize($value), 0, 12)=='O:6:"mysqli"'):
//                $value = 'MSQLi class:'.get_class($value).' TRUNCATED type:'.gettype($value).' parent:'.get_parent_class($value);             
//                break;
            case 'string': 
            case 'array': 
            case 'NULL': 
            case 'null':
            case 'integer': 
            case 'int': 
            case 'double': 
            case 'float': 
            case 'boolean': 
            case 'bool': 
                break;

            case 'resource': 
            case 'resource (stream)': 
            case 'resource (closed)': 
                $value = 'Resource type:'.get_resource_type($value).' TRUNCATED is_resource:'.is_resource($value).' bool:'.$value ? 'TRUE' : 'FALSE';
                if (0) {
                    $value = array('TRUNKATED'=>$value,'SERIALIZED'=>serialize($value));
                } else if (1) {
                    $value = array('TRUNKATED'=>$value,'SERIAL-HEADER'=>substr(serialize($value),0,100));
                } else {
                    $value = 'Resource type:'.get_resource_type($value).' TRUNCATED is_resource:'.is_resource($value).' bool:'.$value ? 'TRUE' : 'FALSE';
                }                
                break;

            case 'object': 
            case 'class@anonymous':
//            case (in_array(@get_class($value),get_declared_classes())):
                $value = 'Object class:'.get_class($value).' TRUNCATED type:'.gettype($value).' parent:'.get_parent_class($value);
                break;             

            default: 
                break;
        }
        if(is_array($value)&&(@$LIMITdeep>0)) {
            $value = request_filter($value, $keys,$LIMITdeep);
        }
    });

    return array_filter ($request, function ($value, $key) use ($request,$keys) {
        return ! in_array($key, $keys);
    }, ARRAY_FILTER_USE_BOTH);
}
//print_r(request_filter($data, ['password']));
?>