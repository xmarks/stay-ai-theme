<?php

namespace App\Enums;

enum QueryType: string
{
    case FRONT_PAGE = 'front_page';
    case HOME = 'home';
    case PAGE = 'page';
    case SINGLE = 'single';
    case ARCHIVE = 'archive';
    case TAX = 'tax';
    case CATEGORY = 'category';
    case TAG = 'tag';
    case DAY = 'day';
    case MONTH = 'month';
    case YEAR = 'year';
    case AUTHOR = 'author';
    case SEARCH = 'search';
    case PAGED = 'paged';
    case NOT_FOUND = '404';
}
