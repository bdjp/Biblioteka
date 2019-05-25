<?php 
    namespace App\Core;

    final class Field {
        private $pattern;
        private $editable;
    

    public function __construct(string $pattern, bool $editable) {
        $this->pattern  = $pattern;
        $this->editable = $editable;
    }

    public function isValid(string $value) {
        return preg_match($this->pattern, $value);
    }

    public function isEditable() {
        return $this->editable;
    }

    public static function editableInteger (int $length): Field {
        return new Field('|^\-?[1-9][0-9]{0,' .($length-1) . '}$|', true);
    }

    public static function readonlyInteger (int $length): Field {
        return new Field('|^\-?[1-9][0-9]{0,' .($length-1) . '}$|', false);
    }

    public static function editableIpAddress (int $length): Field {
        return new Field('@^([0-9]{1,3}(\.[0-9]{1,3}){3})|(::[0-9]+)$@', true);
    }

    public static function readonlyIpAddress (int $length): Field {
        return new Field('@^([0-9]{1,3}(\.[0-9]{1,3}){3})|(::[0-9]+)$@', false);
    }

    public static function editableString (int $length): Field {
        return new Field('|^.{0,' .($length-1) . '}$|', true);
    }

    public static function readonlyString (int $length): Field {
        return new Field('|^.{0,' .($length-1) . '}$|', false);
    }
    
    public static function editableDateTime(): Field {
        return new Field('|^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$|', true);
    }

    public static function readonlyDateTime(): Field {
        return new Field('|^[0-9]{4}\-[0-9]{2}\-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2}$|', false);
    }

    public static function editableDate(): Field {
        return new Field('|^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$|', true);
    }

    public static function readonlyDate(): Field {
        return new Field('|^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$|', false);
    }

    public static function editableTime(): Field {
        return new Field('|^[0-9]{2}:[0-9]{2}:[0-9]{2}$|', true);
    }

    public static function readonlyTime(): Field {
        return new Field('|^[0-9]{2}:[0-9]{2}:[0-9]{2}$|', false);
    }

    public static function editableBit(): Field {
        return new Field('|^[01]$|', true);
    }

    public static function readonlyBit(): Field {
        return new Field('|^[01]$|', false);
    }
}