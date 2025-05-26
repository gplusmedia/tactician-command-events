<?php

namespace League\Tactician\CommandEvents\Event;

use League\Event\HasEventName;

/**
 * Emitted when a command is received
 */
final class CommandReceived implements CommandEvent, HasEventName
{
    use HasCommand;

    public function __construct(protected object $command)
    {
    }

    public function eventName(): string
    {
        return 'command.received';
    }
}
