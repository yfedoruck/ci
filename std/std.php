<?php
// namespace std;
// return end(json_decode(json_encode($o), true));

class std
{
    public static function object(array $array)
    {
        $bad = (object)$array;
        $good = new \stdClass();
        foreach ($bad as $key => $value) {
            $good->{$key} = $value;
        }

        return $good;
    }

    private static function get_php_function($object_function)
    {
        if (strpos($object_function, 'object') !== false) {
            $php_function = str_replace('object', 'array', $object_function);
        } else {
            $php_function = $object_function;
        }

        return $php_function;
    }

    public static function object_change_key_case(stdClass $input, $case = CASE_LOWER)
    {
        $php_function = self::get_php_function(__FUNCTION__);
        $arrOutput = $php_function((array)$input, $case);
        return self::object($arrOutput);
    }

    public static function object_chunk(stdClass $object, $size, $preserve_keys = false)
    {
        $arrOutput = array_chunk((array)$object, $size, $preserve_keys);
        return self::object($arrOutput);
    }

    public static function object_column(stdClass $input, $column_key, $index_key = null)
    {
        $arrOutput = array_column((array)$input, $column_key, $index_key);
        return self::object($arrOutput);
    }

    public static function object_combine( stdClass $keys , stdClass $values)
    {
        $arrOutput = array_combine((array)$keys, (array)$values);
        return self::object($arrOutput);
    }

    public static function object_count_values(stdClass $object)
    {
        $arrOutput = array_count_values((array)$object);
        return self::object($arrOutput);
    }
    
    public static function object_fill_keys ( array $keys , $value )
    {
		$arrOutput = array_fill_keys($keys, $value);
		return self::object($arrOutput);
	}
	
    public static function object_fill($start_index ,$num, $value)
    {
		$arrOutput = array_fill($start_index ,$num, $value);
		return self::object($arrOutput);
	}
	
    public static function object_filter(array $array, $callback, $flag = 0 )
    {
		$arrOutput = array_filter($array, $callback, $flag);
		return self::object($arrOutput);
	}
}

