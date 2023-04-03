<?php

namespace ClaireDv\LaravelArrayHelpers;

use Illuminate\Support\Arr;

class ArrayHelper extends Arr
{

    /**
     * Returns false if items DO not share any values
     *
     * @param   array  $array1
     * @param   array  $array2
     *
     * @return  bool
     */
    public static function sharesAnyValues(array $array1, array $array2) : bool
    {
        return !empty(array_intersect($array1, $array2));
    }


    /**
     * Sorts an array of items by key
     * Using the order of the values in the second array
     * e.g.
     * $arrayToSort = ['surname' => 'Smith', 'title' => 'Mr', 'firstName' => 'Dave']
     * $orderArray = [0 => 'title', 1 => 'firstName', 2 => 'surname' ]
     * $returnArray = [ 'title' => 'Mr', 'firstName' => 'Dave', 'surname' => 'Smith',]
     *
     *
     * @param array $array
     * @param array $orderArray
     * @return array
     */
    public static function sortArrayByArray(array $arrayToSort, array $orderArray) : array
    {
        $ordered = array();
        foreach ($orderArray as $key) {
            if (array_key_exists($key, $arrayToSort)) {
                $ordered[$key] = $arrayToSort[$key];
                unset($arrayToSort[$key]);
            }
        }
        return $ordered + $arrayToSort;
    }



    /**
     * An array contains only the value passed
     *
     * @param array $array
     * @param int|string $value
     * @return boolean
    */
    public static function hasOnlyValue(array $array, $value) : bool
    {
        if (count($array) !== 1) {
            return false;
        }

        return $array[0] === $value;
    }


    /**
     * Is array multi dimensional (has nested arrays)
     *
     * @param array $array
     * @return boolean
     */
    public static function isMulti(array $array)
    {
        rsort($array);
        return isset($array[0]) && is_array($array[0]);
    }


    /**
     * Converts a flat or multi dimensional array into a string
     *
     * @param array $array
     * @param boolean $includeKeys Whether to include keys in the return string
     * @param string $valueSeparator The string to separate each value in the array
     * @param string $string The start of the return string
     * @param string $keySeparator The string to join the key and the value
     * @return string
     */
    public static function arrayToString(
        array $array,
        bool $includeKeys = true,
        string $valueSeparator = ', ',
        string $keySeparator  = ' : ',
        string $string = '',
    ): string {

         // Get rid of any nulls
        $array = array_filter($array, function($value) {
            return $value !== null;
          });

          // Loop through all items
        foreach ($array as $key => $value) {
            // If we are including keys in the final string
            // and the key is a string, add it to the return string
            if ($includeKeys && is_string($key)) {
                $string .= $key . $keySeparator;
            }

            // If the value in an array, pass it back into this method
            if (is_array($value)) {
                $string = self::arrayToString(
                    $value,
                    $includeKeys,
                    $valueSeparator,
                    $keySeparator,
                    $string
                );

                $string .= $key === array_key_last($array) ? '' : $valueSeparator;
            }  else {
                // Add the value to the string
                $string .= $value;

                // Add the seperator to the final string, providing it's not the last
                // item in the array
                $string .= $key === array_key_last($array) ? '' : $valueSeparator;
            }
        }

        return $string;
    }


    /**
     * Replace all {} with a value from the given array using keys
     *
     * @param string $string
     * @param array $array
     * @return string
    */
    public static function replaceBracesWithValues(
        string $string,
         array $array
         ) : string
    {
    foreach ($array as $key => $value) {
        $placeholder = sprintf('{%s}', $key);
        $string  = str_replace($placeholder, $value, $string);
    }

    return $string;
    }
}
