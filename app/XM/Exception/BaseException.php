<?php

namespace App\XM\Exception;

use Throwable;

abstract class BaseException extends \Exception
{
    private array $details;

    public function __construct(string $message, int $status = 500, array $details = [], Throwable $previous = null)
    {
        $this->details = $details;
        parent::__construct($message, $status, $previous);
    }

    public function getDetails(): array
    {
        return $this->details;
    }

    public function getError(): string
    {
        $class = get_called_class();

        return basename(str_replace('\\', DIRECTORY_SEPARATOR, $class));
    }
}
