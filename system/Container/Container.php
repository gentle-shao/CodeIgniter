<?php

namespace CodeIgniter\Container;

use DI\Container as BaseContainer;
use Psr\Container\ContainerInterface;

class Container extends BaseContainer implements ContainerInterface
{
    /**
     * The globally available container instance.
     *
     * @var static
     */
    protected static $instance;

    /**
     * Return globally available container instance.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
