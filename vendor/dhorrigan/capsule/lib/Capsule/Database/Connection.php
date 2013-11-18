<?php
/**
 * A simple wrapper class for the Laravel Database package.  This is only
 * to be used outside of a Laravel application.
 *
 * @author  Dan Horrigan <dan@dhorrigan.com>
 */

namespace Capsule\Database;

use RuntimeException;
use Illuminate\Database\Connectors\ConnectionFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\ConnectionResolver;
use Illuminate\Database\DatabaseManager;

/**
 * A simple wrapper class for the Laravel Database package.
 */
class Connection {

    /**
     * @var ConnectionResolver  Hold the ConnectionResolver object.
     */
    private static $resolver = null;

    /**
     * @var ConnectionFactory  Hold the ConnectionFactory object.
     */
    private static $factory = null;

    /**
     * @var bool  Holds whether the Eloquent Model object has the resolver assigned.
     */
    private static $modelInitialized = false;

    /**
     * @var bool  Holds whether any database connection has been made.
     */
    private static $connectionMade = false;

    /**
     * Creates a new Connection via the Factory then adds it to the resolver.  If
     * this is the first time it is ran, it will also initialize the Eloquent
     * Model with the ConnectionResolver object so your models work.
     *
     * @param   string  Name of the connection
     * @param   array   The config array for the connection
     * @param   bool    Whether to make this the default connection
     * @return  Illuminate\Database\Connectors\Connection
     */
    public static function make($name, array $config, $default = false) {
        $conn = self::getFactory()->make($config);
        self::getResolver()->addConnection($name, $conn);

        if ($default) {
            self::getResolver()->setDefaultConnection($name);
        }

        if ( ! self::$modelInitialized) {
            Model::setConnectionResolver(self::getResolver());
            self::$modelInitialized = true;
        }

        self::$connectionMade = true;
        return $conn;
    }

    /**
     * Gets a Connection from the resolver.  If $name is NULL
     * then it returns the default Connection.
     *
     * @param   string  The connection name
     * @return  Illuminate\Database\Connection
     * @throws  \RuntimeException
     */
    public static function get($name = null)
    {
        if ( ! self::$connectionMade) {
            throw new RuntimeException('No Database connections exist.  Please connect using Capsule\Database\Connection::make and try again.');
        }
        return static::getResolver()->connection($name);
    }

    /**
     * Access the ConnectionResolver
     *
     * @return  Illuminate\Database\ConnectionResolver
     */
    public static function getResolver()
    {
        if (is_null(self::$resolver)) {
            self::$resolver = new ConnectionResolver;
        }

        return static::$resolver;
    }


    /**
     * Access the ConnectionFactory
     *
     * @return  Illuminate\Database\ConnectionFactory
     */
    public static function getFactory()
    {
        if (is_null(self::$factory)) {
            self::$factory = new ConnectionFactory;
        }

        return static::$factory;
    }

}
