<?php

namespace App\Parsers;

abstract class AbstractHandler implements HandlerInterface
{
    /** @var  ?HandlerInterface */
    protected ?HandlerInterface $next = null;

    /** set the next handler */
    public function setNext(?HandlerInterface $next) : void
    {
        $this->next = $next;
    }

    /** run the next handler */
    public function next(): array|HandlerInterface
    {
        return $this->next?->handle();
    }
}
