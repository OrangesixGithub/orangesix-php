<?php

namespace Orangecode\Helpers\Service\Response\Enum;

enum Field: string
{
    case Valid = "is-valid";
    case Invalid = "is-invalid";
}
