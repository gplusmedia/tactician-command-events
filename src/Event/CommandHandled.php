<?php

namespace League\Tactician\CommandEvents\Event;

use League\Event\HasEventName;

/**
 * Emitted when a command is handled
 */
final class CommandHandled implements CommandEvent, HasEventName
{
    use HasCommand;

    public function __construct(protected object $command)
    {
    }

    public function eventName(): string
    {
        return 'command.handled';
    }
}
