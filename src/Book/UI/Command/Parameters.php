<?php

declare(strict_types=1);

namespace App\Book\UI\Command;

enum Parameters: string
{
    case TITLE = 'title';
    case AUTHOR = 'author';
    case SORT = 'sort';
}
