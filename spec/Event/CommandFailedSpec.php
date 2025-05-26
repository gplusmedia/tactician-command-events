<?php

namespace spec\League\Tactician\CommandEvents\Event;

use Exception;
use League\Event\HasEventName;
use League\Tactician\CommandEvents\Event\CommandEvent;
use League\Tactician\CommandEvents\Event\CommandFailed;
use spec\League\Tactician\CommandEvents\Command;
use PhpSpec\ObjectBehavior;

final class CommandFailedSpec extends ObjectBehavior
{
    function let(Command $command, Exception $e): void
    {
        $this->beConstructedWith($command, $e);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(CommandFailed::class);
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
        $this->getCommand()->shouldreturn($command);
    }

    function it_has_a_name(): void
    {
        $this->eventName()->shouldReturn('command.failed');
    }

    function it_has_an_exception(Exception $e): void
    {
        $this->getException()->shouldReturn($e);
    }

    function it_is_not_caught_by_default(): void
    {
        $this->isExceptionCaught()->shouldReturn(false);

        $this->catchException();

        $this->isExceptionCaught()->shouldReturn(true);
    }
}
