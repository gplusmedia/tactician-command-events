<?php

namespace League\Tactician\CommandEvents\Event;

use Exception;
use League\Event\HasEventName;

/**
 * Emitted when a command is failed
 */
final class CommandFailed implements CommandEvent, HasEventName
{
    use HasCommand;

    /**
     * Checks whether exception is caught
     */
    private bool $exceptionCaught = false;

    public function __construct(
        protected object $command,
        private readonly Exception $exception
    ) {
    }

    /**
     * Returns the exception
     * @return Exception
     */
    public function getException(): Exception
    {
        return $this->exception;
    }

    /**
     * Indicates that exception is caught
     */
    public function catchException(): void
    {
        $this->exceptionCaught = true;
    }

    /**
     * Checks whether exception is caught
     * @return bool
     */
    public function isExceptionCaught(): bool
    {
        return $this->exceptionCaught;
    }

    public function eventName(): string
    {
        return 'command.failed';
    }
}
