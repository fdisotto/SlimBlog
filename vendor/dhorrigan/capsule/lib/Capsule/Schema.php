<?php
/**
 * A simple wrapper class for the Laravel Database package.  This is only
 * to be used outside of a Laravel application.
 *
 * @author  Dan Horrigan <dan@dhorrigan.com>
 */

namespace Capsule;

/**
 * Implements an easy to use Schema Facade
 */
class Schema {

    /**
     * Passes calls through to the Connection Schema object.
     *
     * @param   string  The method name
     * @param   array   The method parameters sent
     * @return  mixed   The result of the call
     */
    public static function __callStatic($method, $parameters) {
        return call_user_func_array(array(Database\Connection::get()->getSchemaBuilder(), $method), $parameters);
    }
}
