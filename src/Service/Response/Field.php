<?php

namespace Orangecode\Helpers\Service\Response;

use Orangecode\Helpers\Service\Response\Enum\Field as FieldEnum;

class Field
{
    /** @var string */
    public string $field;

    /** @var string | array */
    public string|array $message;

    /** @var FieldEnum */
    public FieldEnum $messageType;

    /** @var bool */
    public bool $disabled;

    /**
     * @param string $field
     * @param string|array $message
     * @param FieldEnum $messageType
     * @param bool $disabled
     */
    public function __construct(string $field, string|array $message, FieldEnum $messageType = FieldEnum::Invalid, bool $disabled = false)
    {
        $this->field = $field;
        $this->disabled = $disabled;
        if (gettype($message) == "string")
            $message = [$message];
        $this->message = [$field => $message];
        $this->messageType = $messageType;
    }
}
