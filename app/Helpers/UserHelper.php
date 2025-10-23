<?php

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

if (! function_exists('user')) {
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function user()
    {
        return session()?->get('user')?->user;
    }
}

if (! function_exists('passport')) {
    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    function passport()
    {
        return session()?->get('passport');
    }
}
