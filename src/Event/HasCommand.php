<?php

namespace League\Tactician\CommandEvents\Event;

/**
 * Holds the command object for an event
 */
trait HasCommand
{
    protected object $command;

    /**
     * Returns the command
     * @return object
     */
    public function getCommand(): object
    {
        return $this->command;
    }
}
