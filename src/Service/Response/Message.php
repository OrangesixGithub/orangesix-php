<?php

namespace Orangecode\Helpers\Service\Response;
use Orangecode\Helpers\Service\Response\Enum\Message as MessageEnum;

class Message
{
    /** @var string */
    public string $message;

    /** @var string|MessageEnum */
    public string|MessageEnum $type;

    /** @var string|null */
    public ?string $icon;

    /**
     * @param string $message
     * @param MessageEnum $type
     * @param string|null $icon
     */
    public function __construct(string $message, MessageEnum $type = MessageEnum::Success, string $icon = null)
    {
        $this->message = $message;
        $this->type = $type;
        $this->icon = $icon;
        if (empty($icon))
            $this->icon = match ($type) {
                MessageEnum::Error => "bi bi-bug",
                MessageEnum::Success => "bi bi-check-circle",
                MessageEnum::Warning => "bi bi-exclamation-triangle",
                default => "bi bi-info-circle",
            };
    }
}
