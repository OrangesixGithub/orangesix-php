<?php

namespace Orangecode\Service\Response\Enum;

enum Field: string
{
    case Valid = 'is-valid';
    case Invalid = 'is-invalid';
}
