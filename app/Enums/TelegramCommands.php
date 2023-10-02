<?php

namespace App\Enums;

enum TelegramCommands: string
{
    case INFO = '/info';
    case LOAD_BOOK = '/loadBook';
    case DOWNLOAD_FILE = '/downloadFile';
}
