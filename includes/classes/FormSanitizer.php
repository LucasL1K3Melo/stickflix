<?php

    class FormSanitizer {

        public static function sanitizeFormString($inputText){

            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);
            $inputText = strtolower($inputText);
            $inputText = ucfirst($inputText); 
    
            return $inputText;
        } # ./ End sanitizeFormString function

        public static function sanitizeFormUsername($inputText){

            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);

            return $inputText;
        } # ./ End sanitizeUsername function

        public static function sanitizeFormPassword($inputText){

            $inputText = strip_tags($inputText);

            return $inputText;
        } # ./ End sanitizeFormPassword function

        public static function sanitizeFormEmail($inputText){

            $inputText = strip_tags($inputText);
            $inputText = str_replace(" ", "", $inputText);

            return $inputText;
        } # ./ End sanitizeFormEmail function

    }

?>