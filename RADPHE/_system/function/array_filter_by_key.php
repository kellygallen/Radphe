<?php
function request_filter(array $request, array $keys,$LIMITdeep=3) {
    $LIMITdeep--;
    array_walk($request, function (&$value, $key) use ($keys) {
        if(is_array($value)&&(@$LIMITdeep>0)) {
            $value = request_filter($value, $keys,$LIMITdeep);
        }
    });

    return array_filter ($request, function ($value, $key) use ($keys) {
        return ! in_array($key, $keys);
    }, ARRAY_FILTER_USE_BOTH);
}
//print_r(request_filter($data, ['password']));
?>