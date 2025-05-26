<?php

namespace spec\League\Tactician\CommandEvents;

use Exception;
use League\Event\EventDispatcher;
use League\Event\EventDispatcherAware;
use League\Tactician\CommandEvents\Event\CommandFailed;
use League\Tactician\CommandEvents\Event\CommandHandled;
use League\Tactician\CommandEvents\Event\CommandReceived;
use League\Tactician\CommandEvents\EventMiddleware;
use League\Tactician\Middleware;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

final class EventMiddlewareSpec extends ObjectBehavior
{
    function let(EventDispatcher $emitter): void
    {
        $this->beConstructedWith($emitter);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(EventMiddleware::class);
    }

    function it_is_a_middleware(): void
    {
        $this->shouldImplement(Middleware::class);
    }

    function it_is_aan_emitter_aware(): void
    {
        $this->shouldImplement(EventDispatcherAware::class);
    }

    function it_executes_a_command(Command $command, EventDispatcher $emitter): void
    {
        $emitter->dispatch(Argument::type(CommandReceived::class))->shouldBeCalled();
        $emitter->dispatch(Argument::type(CommandHandled::class))->shouldBeCalled();

        $this->execute($command, function() {});
    }

    function it_executes_a_faulty_command_and_fails(Command $command, EventDispatcher $emitter): void
    {
        $emitter
            ->dispatch(Argument::type(CommandReceived::class))
            ->shouldBeCalled();

        $emitter
            ->dispatch(Argument::type(CommandFailed::class))
            ->shouldBeCalled();

        $this->shouldThrow(Exception::class)->during('execute', [$command, function() {
            throw new Exception();
        }]);
    }

    function it_executes_a_faulty_command_and_handles_the_exception(Command $command, EventDispatcher $emitter): void
    {
        $emitter
            ->dispatch(Argument::type(CommandReceived::class))
            ->shouldBeCalled();

        $emitter
            ->dispatch(Argument::type(CommandFailed::class))
            ->will(function($args) {
                $args[0]->catchException();
            });

        $this->shouldNotThrow(Exception::class)->during('execute', [$command, function() {
            throw new Exception();
        }]);
    }
}
