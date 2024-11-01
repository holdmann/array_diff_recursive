<?php

if (!function_exists('array_diff_recursive')) {
    /**
     * Make array_diff() works with multidimensional arrays.
     *
     * @see https://stackoverflow.com/questions/3876435/recursive-array-diff
     *
     * @param array $arr1
     * @param array $arr2
     * @return array
     */
    function array_diff_recursive(array $arr1, array $arr2): array
    {
        $outputDiff = [];

        foreach ($arr1 as $key => $value)
        {
            //if the key exists in the second array, recursively call this function
            //if it is an array, otherwise check if the value is in arr2
            if (array_key_exists($key, $arr2))
            {
                if (is_array($value))
                {
                    $recursiveDiff = array_diff_recursive($value, $arr2[$key]);

                    if (count($recursiveDiff))
                    {
                        $outputDiff[$key] = $recursiveDiff;
                    }
                }
                else if (!in_array($value, $arr2))
                {
                    $outputDiff[$key] = $value;
                }
            }
            //if the key is not in the second array, check if the value is in
            //the second array (this is a quirk of how array_diff works)
            else if (!in_array($value, $arr2))
            {
                $outputDiff[$key] = $value;
            }
        }

        return $outputDiff;
    }
}