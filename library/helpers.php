<?php

    if (!function_exists('p'))
    {
        function p($title, $value = "NOT_SUPPLIED")
        {
            if ($value != "NOT_SUPPLIED") {
                echo '<b>' . $title . '</b>:<br />';
                echo '<pre>';
                print_r($value);
                echo '</pre>';
            }
            else
            {
                echo '<pre>';
                print_r($title);
                echo '</pre>';
            }

        }

    }

    if (!function_exists('k'))
    {
        function k($title, $value = "NOT_SUPPLIED")
        {
            if ($value != "NOT_SUPPLIED")
                echo '<b>' . $title . '</b>:' . $value . '<br />';
            else
                echo $title . '<br />';
        }

    }

    if (!function_exists("starts_with")) {
        function starts_with($haystack, $needle)
        {
            $length = strlen($needle);
            return (substr($haystack, 0, $length) === $needle);
        }
    }

    if (!function_exists("ends_with")) {
        function ends_with($haystack, $needle)
        {
            $length = strlen($needle);
            if ($length == 0) {
                return true;
            }

            return (substr($haystack, -$length) === $needle);
        }
    }

    if (!function_exists("current_path")) {
        function current_path()
        {
            return strtok($_SERVER["REQUEST_URI"],'?');
        }
    }

    if (!function_exists("current_path_processed")) {
        function current_path_processed()
        {
            return trim( str_replace( "/", "-", current_path() ), "-" );
        }
    }
