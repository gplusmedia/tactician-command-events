<?php

namespace League\Tactician\CommandEvents;

use Exception;
use League\Event\EventDispatcher;
use League\Event\EventDispatcherAware;
use League\Event\EventDispatcherAwareBehavior;
use League\Tactician\Middleware;

/**
 * Provides an event-driven middleware functionality
 */
final class EventMiddleware implements Middleware, EventDispatcherAware
{
    use EventDispatcherAwareBehavior;

    public function __construct(?EventDispatcher $dispatcher = null)
    {
        if ($dispatcher instanceof EventDispatcher) {
            $this->useEventDispatcher($dispatcher);
        }
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function execute($command, callable $next): mixed
    {
        try {
            $this->eventDispatcher()->dispatch(new Event\CommandReceived($command));
            $returnValue = $next($command);
            $this->eventDispatcher()->dispatch(new Event\CommandHandled($command));
            return $returnValue;
        } catch (Exception $e) {
            $event = new Event\CommandFailed($command, $e);
            $this->eventDispatcher()->dispatch($event);
            if (!$event->isExceptionCaught()) {
                throw $e;
            }
        }
        return null;
    }
}
