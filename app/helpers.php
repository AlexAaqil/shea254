<?php

/* 
 * 
 * formatPhoneNumber function is to be used to format phone numbers in a more
 * comprehensible way so it's 254 746 055 487 instead of 254746055487
 * 
*/

if (! function_exists('format_phone_number')) {
    function format_phone_number($number) {
        // Remove any non-digit characters (optional, depending on your input)
        $number = preg_replace('/\D/', '', $number);
        // Add spaces after every three digits
        return preg_replace('/(\d{3})(?=\d)/', '$1 ', $number);
    }
}