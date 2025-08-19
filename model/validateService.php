<?php
    class validateService{
        public function validateName($name){
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[a-zA-Z ]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validateStringLength( $string, $maxLength, $minLength = 1){
            $string = trim($string);
    
            if (strlen($string) > $maxLength || strlen($string) < $minLength) {
                return false;
            } else {
                return true;
            }
        }
    
        public function validateIisEmail($email) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            } else {
                return true;
            }
        }
    
        public function validatePhoneNumber($name) {
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[0-9]{10}+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validateNumber($name) {
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[0-9]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validatePassword($name){
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[0-9a-zA-Z!@#$&]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validateAddress($name){
            $name = trim($name);
            
            if( strlen($name) > 0 && preg_match('/^[A-Za-z0-9!@#$%^&* \n(){}[\],.<>?\/-_=+;\'"]+/', $name) ){
            //if( strlen($name) > 0 && preg_match('/^[0-9a-zA-Z,.:\-_ ]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validatePlace($name){
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[0-9a-zA-Z._\- ]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validateUrl($name){
            $name = trim($name);
    
            if( strlen($name) > 0 ){
                if ( filter_var( $name, FILTER_VALIDATE_URL ) ){
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    
        public function validateString($name){
            $name = trim($name);
    
            if( strlen($name) > 0 && preg_match('/^[0-9a-zA-Z.,-_ !@#%&]+$/', $name) ){
                return true;
            } else {
                return false;
            }
        }
    
        public function validateDate($date){
            $date = trim($date);
            $date = date_create($date);

            if( $date == "" ){
                return false;
            } else {
                $date = date_format($date,"d/m/Y");
    
                $dateArray  = explode('/', $date);
    
                if (count($dateArray) == 3) {
                    if (checkdate($dateArray[1], $dateArray[0], $dateArray[2])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        }

        // redirect function
        public function redirectToHome( $rootPathAdmin ){
            header( "Location: " . $rootPathAdmin . "/?action=dashboard" );
        }
    }
?>