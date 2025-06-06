<?php

namespace spec\League\Tactician\CommandEvents\Event;

use League\Event\HasEventName;
use League\Tactician\CommandEvents\Event\CommandEvent;
use League\Tactician\CommandEvents\Event\CommandHandled;
use spec\League\Tactician\CommandEvents\Command;
use PhpSpec\ObjectBehavior;

final class CommandHandledSpec extends ObjectBehavior
{
    function let(Command $command)
    {
        $this->beConstructedWith($command);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(CommandHandled::class);
    }

    function it_is_a_command_event(): void
    {
        $this->shouldImplement(CommandEvent::class);
    }

    function it_is_an_event(): void
    {
        $this->shouldImplement(HasEventName::class);
    }

    function it_has_a_command(Command $command): void
    {
        $this->getCommand()->shouldReturn($command);
    }

    function it_has_a_name(): void
    {
        $this->eventName()->shouldReturn('command.handled');
    }
}
