<?php

namespace Insecia\Api;

class IptcFormatter {

    public static function format($tag, $value) 
    {
        switch($tag) {
            case 'FIELD_DATE_CREATED': 
                return date('d.m.Y', strtotime($value[0]));

            case 'FIELD_BY_LINE':
            case 'FIELD_KEYWORDS':
                return rtrim(implode(', ', $value), ', ');

            default:
                return $value[0];
        }
    }
} 
