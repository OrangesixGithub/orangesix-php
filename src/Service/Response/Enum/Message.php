<?php

namespace Orangesix\Service\Response\Enum;

enum Message: string
{
    case Success = 'success';
    case Warning = 'warning';
    case Error = 'error';
    case Info = 'info';
}
