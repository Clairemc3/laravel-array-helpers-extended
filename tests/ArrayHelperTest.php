<?php declare(strict_types=1);

use ClaireDv\LaravelArrayHelpers\ArrayHelper;
use PHPUnit\Framework\TestCase;

final class ArrayHelperTest extends TestCase
{
    /**
     * Testing sharesAnyValues()
     *
     * @return void
     */
    public function testsharesAnyValuesReturnsTrue(): void
    {
        // Given I have a shared value in two arrays
        $array1 = ['one', 'two', 'three'];
        $array2 = ['three', 'four', 'five'];

        // Then the sharesAnyValues method should return true
        $this->assertTrue(ArrayHelper::sharesAnyValues($array1, $array2));
    }


    /**
     * Testing sharesAnyValues()
     *
     * @return void
     */
    public function testsharesAnyValuesReturnsFalse(): void
    {
        // Given I have two values with no shared values
        $array1 = ['one', 'two', 'three'];
        $array2 = ['four', 'five', 'six'];

        // Then the sharesAnyValues method should return true
        $this->assertFalse(ArrayHelper::sharesAnyValues($array1, $array2));
    }


    /**
     * Testing hasOnlyValue()
     *
     * @return void
     */
    public function testHasOnlyValueIsReturnsTrue(): void
    {
        // Given I have an array with one value
        $array1 = ['one'];

        // Given I am looking for a string value in the array
        $valueToLookFor = 'one';

        // Then the hasOnlyValue method should return true
        $this->assertTrue(ArrayHelper::hasOnlyValue($array1, $valueToLookFor));
    }


    /**
     * Testing hasOnlyValue()
     *
     * @return void
     */
    public function testHasOnlyValueReturnsFalse(): void
    {
        // Given I have an array with multiple values
        $array1 = ['one', 'two'];

        // Given I am looking for a string value which is not in the array
        $valueToLookFor = 'one';

        // Then the hasOnlyValue method should return false
        $this->assertFalse(ArrayHelper::hasOnlyValue($array1, $valueToLookFor));
    }

    /**
     * Testing isMulti()
     *
     * @return void
     */
    public function testIsMultiReturnsTrue(): void
    {
        // Given I have an multi dimensional array
        $array1 = ['one' => ['two']];

        // Then the isMulti method should return true
        $this->assertTrue(ArrayHelper::isMulti($array1));
    }


    /**
     * Testing isMulti()
     *
     * @return void
     */
    public function testIsMultiReturnsFalse(): void
    {
        // Given I have an multi dimensional array
        $array1 = ['one', 'two'];

        // Then the isMulti method should return false
        $this->assertFalse(ArrayHelper::isMulti($array1));
    }


    /**
     * Testing arrayToString()
     *
     * @return void
     */
    public function testItRetunsAMultiArrayAsAString(): void
    {
        // Given I have an multi dimensional array
        $arrayToConvert = [
            'name' =>  'pete',
            'hobbies' => [
                'reading', 'writing'
        ]];

        // Then the arrayToString method should return the expected string
        $expectedReturnString = 'name : pete, hobbies : reading, writing';
        $this->assertEquals($expectedReturnString,
            ArrayHelper::arrayToString($arrayToConvert)
        );
    }


    /**
     * Testing replaceBracesWithValues()
     *
     * @return void
     */
    public function testItReplacesBracesWithValuesInAnArray(): void
    {
        // Given I have a string with curly braces
        $stringWithBraces = 'Dear {firstName}, Your order number is {orderNumber}';

        // Given I have an array with keys which match the strings
        // inside the curly braces
        $arrayWithValues = ['firstName' => 'Claire', 'orderNumber' => 'AB-1234'];

        // Then the replaceBracesWithArray method should return the expected string
        $expectedReturnString = 'Dear Claire, Your order number is AB-1234';
        $this->assertEquals($expectedReturnString,
            ArrayHelper::replaceBracesWithValues($stringWithBraces, $arrayWithValues)
        );
    }





    /**
     * Testing sortByArray()
     *
     * @return void
     */
    public function testSortByArrayReturnsASortedArray(): void
    {
        // Given I have a an assoc array and index array
        $arrayToSort = ['surname' => 'Smith', 'title' => 'Mr', 'firstName' => 'Dave'];
        $orderArray = [ 0 => 'title', 1 => 'firstName', 2 => 'surname' ];

        $expectedReturnArray = [ 'title' => 'Mr', 'firstName' => 'Dave', 'surname' => 'Smith'];

        // Then the sharesAnyValues method should return true
        $this->assertEquals($expectedReturnArray,
            ArrayHelper::sortArrayByArray($arrayToSort, $orderArray)
        );
    }

}
