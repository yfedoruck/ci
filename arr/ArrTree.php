<?php

namespace ArrTree;


class ArrTree
{
    public static function search($needle, array $haystack, $strict = null)
    {
        $arrays = $scalars = [];
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $arrays[$key] = $value;
            } else {
                $scalars[$key] = $value;
            }
        }

        $found = array_search($needle, $scalars, $strict);
        if ($found !== false) {
            return $found;
        }

        foreach ($arrays as $value) {
            $found = self::search($needle, $value, $strict);
            if ($found !== false) {
                return $found;
            }
        }

        return false;
    }
}
//
//$x = ArrTree::search('asd', [2, 3, []]);
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

//var_dump(array_search('qwe', [0]), true);
//die("\n-qwe-\n");

var_dump( ArrTree::search('asd',
    [
        ['2334', '-1' => 1],
        [0, ['sf' => 'asd2'], 'd'],
        [[],[1,2,3, [2, 'rty' => 'asd']], []]
    ], true) );

//        array_map(function ($key, $value) use ($needle){
//        }, array_keys($haystack), $haystack);