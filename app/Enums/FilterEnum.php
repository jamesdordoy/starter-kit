<?php

namespace App\Enums;

enum FilterEnum: string
{
    case SEARCH = 'search';
    case DATE = 'date';
    case DATE_FROM = 'date_from';
    case DATE_TO = 'date_to';
    case DATE_RANGE = 'date_range';
    case DESCRIPTION = 'description';

    public function description(): string
    {
        return match ($this) {
            self::SEARCH => 'Search',
            self::DATE => 'Date',
            self::DATE_FROM => 'Date From',
            self::DATE_TO => 'Date To',
            self::DATE_RANGE => 'Date Range',
            self::DESCRIPTION => 'Description',
        };
    }
}
