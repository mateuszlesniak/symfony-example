<?php

namespace App\Book\Command;

enum Parameters: string
{
    case TITLE = 'title';
    case AUTHOR = 'author';

    case SORT = 'sort';
}
