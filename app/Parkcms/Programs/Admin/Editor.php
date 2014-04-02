<?php

namespace Parkcms\Programs\Admin;

use Illuminate\Foundation\Application;
use Illuminate\View\Environment as View;

use InvalidArgumentException;
use ReflectionException;
use Closure;

abstract class Editor
{
    protected $app = null;
    protected $endpoints = array();

    public function __construct(Application $app, View $view)
    {
        $this->app = $app;
        $view->addNamespace('fields', __DIR__ . '/Fields/views');
    }

    abstract public function register();

    public function addEndpoint($end, $action, $verb='any')
    {
        if (isset($this->endpoints[$end])) {
            throw new InvalidArgumentException("Endpoint already registered!");
        }

        $verb = strtolower($verb);

        if (is_string($action)) {
            $explodedAction = explode('@', $action);
            
            if (class_exists($explodedAction[0])) {
                $this->endpoints[$end] = array(
                    'object' => $explodedAction[0],
                    'action' => $explodedAction[1],
                    'verb'   => $verb
                );
                return;
            } else {
                if (method_exists($this, $action)) {
                    $this->endpoints[$end] = array(
                        'object' => $this,
                        'action' => $action,
                        'verb'   => $verb
                    );
                    return;
                }
                throw new ReflectionException('Endpoint could not be resolved!');
            }
        } else if ($action instanceof Closure) {
            $this->endpoints[$end] = array(
                'object' => 'closure',
                'action' => $action,
                'verb'   => $verb
            );
            return;
        } else {
            throw new InvalidArgumentException('Action could not be resolved');
        }
    }

    public function addResourceEndpoint($resource, $resolver)
    {
        $endpoints = array(
            array('action' => 'index', 'verb' => 'get'),
            array('action' => 'create', 'verb' => 'get'),
            array('action' => 'store', 'verb' => 'post'),
            array('action' => 'show', 'verb' => 'get'),
            array('action' => 'edit', 'verb' => 'get'),
            array('action' => 'update', 'verb' => 'put'),
            array('action' => 'destroy', 'verb' => 'delete')
        );

        if (is_string($resolver)) {
            $resolver = $this->app->make($resolver);
        }

        foreach ($endpoints as $endpoint) {
            if (method_exists($resolver, $endpoint['action'])) {
                $route = ($resource != '') ? $resource . '_' . $endpoint['action'] : $endpoint['action'];
                $this->endpoints[$route] = array(
                    'object' => $resolver,
                    'action' => $endpoint['action'],
                    'verb'   => $endpoint['verb']
                );
            }
        }
    }

    public function handleEndpoint($endpoint, $reqType, array $properties)
    {
        if (isset($this->endpoints[$endpoint])) {
            $object = $this->endpoints[$endpoint]['object'];
            $action = $this->endpoints[$endpoint]['action'];
            $verb   = $this->endpoints[$endpoint]['verb'];

            if ($verb !== 'any' && $verb !== strtolower($reqType)) {
                throw new EndpointNotFoundException('Invalid HTTP verb!');
            }

            if ($object === 'closure') {
                return $action($properties);
            }

            if ($object === $this) {

                return $this->{$action}($properties);
            }

            $obj = $this->app->make($object);

            return $obj->{$action}($properties);
        } else {
            throw new EndpointNotFoundException('No endpoint for action ' . $endpoint . ' found');
        }
    }

    public function route($route, $reqType, array $properties)
    {
        return $this->handleEndpoint($route, $reqType, $properties);
    }

    protected function makeField($field)
    {
        $editorNamespace = str_replace('/', '\\', dirname(str_replace('\\', '/', get_called_class())));
        if (class_exists($editorNamespace . '\\Fields\\'. ucfirst($field))) {
            return $this->app->make($editorNamespace . '\\'. ucfirst($field));
        }

        if (class_exists('Parkcms\Programs\Admin\Fields\\' . ucfirst($field))) {
            return $this->app->make('Parkcms\Programs\Admin\Fields\\' . ucfirst($field));
        }

        return $this->app->make($field);
    }
}