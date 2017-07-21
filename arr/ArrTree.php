<?php

namespace ArrTree;


class ArrTree {

    public static function search($needle, array $haystack, $strict = null)
    {
        $scalars = array_filter($haystack, function ($value) {
            return !is_array($value);
        });

        $found   = array_search($needle, $scalars, $strict);
        if ($found) {
            return $found;
        }

        $arrays = array_diff($haystack, $scalars);
        foreach ($arrays as $value) {
            $found = self::search($needle, $value);
            if ( ! is_null($found)) {
                return $found;
            }
        }

        return null;
    }
}
//
$x = ArrTree::search('asd', [2, 3, []]);
//$x = ArrTree::search('asd', [2, 'rty' => 'asd']);
//var_dump( $x );


//        array_map(function ($value) use ($needle){
//            return self::search($needle, $value);
//        }, $scalars);

//        return array_reduce($haystack, function ($carry, $item) use ($needle){
//            if(!is_null($carry)){
//                return $carry;
//            }
//            return self::search($needle, $item);
//        });
//    }
//    private static function lazySearch($needle, array $haystack)
//    {
//        foreach ($haystack as $value) {
//            $found = self::search($needle, $value);
//            if(!is_null($found)){
//                return $found;
//            }
//        }
//
//        return null;
//    }



//var_dump( ArrTree::search('asd',
//    [
//        ['2334', '-1' => 1],
//        [0, ['asd2'], 'd'],
//        [[],[1,2,3, [2, 'rty' => 'asd']], []]
//    ]) );

//        array_map(function ($key, $value) use ($needle){
//        }, array_keys($haystack), $haystack);