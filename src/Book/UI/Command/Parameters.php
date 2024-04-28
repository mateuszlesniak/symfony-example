<?php

namespace App\Book\UI\Command;

enum Parameters: string
{
    case TITLE = 'title';
    case AUTHOR = 'author';
    case SORT = 'sort';
}
