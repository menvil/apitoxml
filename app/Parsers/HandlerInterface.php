<?php

namespace App\Parsers;

interface HandlerInterface
{
    /** set the next handler: */
    public function setNext(?HandlerInterface $next);
    /** run this handler's code */
    public function handle() : array|HandlerInterface;
    /** run the next handler  */
    public function next() : array|HandlerInterface;
}
