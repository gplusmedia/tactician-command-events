<?php

/*
 * This file is part of the Tactician Command Events package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace League\Tactician\CommandEvents;

use League\Event\Event;
use League\Tactician\Command;

/**
 * Emitted when something happens with a command
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class CommandEvent extends Event
{
    /**
     * @var Command
     */
    protected $command;

    /**
     * @param Command $command
     */
    public function __construct(Command $command)
    {
        $this->command = $command;
    }

    /**
     * Returns the command
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }
}
