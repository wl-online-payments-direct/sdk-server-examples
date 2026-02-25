<?php

namespace OnlinePayments\ExampleApp\Presentation\Models\Errors;

use OnlinePayments\ExampleApp\Application\Interfaces\Responses\ResponseInterface;

final class SystemErrorResponse implements ResponseInterface
{
    public int $code;
    public ?string $description;

    public function __construct(int $code, ?string $description = null)
    {
        $this->code = $code;
        $this->description = $description;
    }

    public function toArray(): array
    {
        return [
            'code' => $this->code,
            'description' => $this->description,
        ];
    }
}
