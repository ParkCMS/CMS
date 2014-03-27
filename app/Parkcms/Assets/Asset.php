<?php

namespace Parkcms\Assets;

use URL;
use Config;

class Asset {
    public $assets = array();

    public function add($name, $source, $dependencies = array(), $attributes = array()) {
        $type = (pathinfo($source, PATHINFO_EXTENSION) == 'css') ? 'style' : 'script';

        return $this->$type($name, $source, $dependencies, $attributes);
    }

    public function style($name, $source, $dependencies = array(), $attributes = array()) {
        if(!array_key_exists('media', $attributes)) {
            $attributes['media'] = 'all';
        }

        $this->register('style', $name, $source, $dependencies, $attributes);

        return $this;
    }

    public function script($name, $source, $dependencies = array(), $attributes = array()) {
        $this->register('script', $name, $source, $dependencies, $attributes);

        return $this;
    }

    public function path($source)
    {
        if($root = Config::get('app.asset_url', false)) {
            return rtrim($root, '/').'/'.ltrim($source, '/');
        }
        return $source;
    }

    protected function register($type, $name, $source, $dependencies, $attributes) {
        $dependencies = (array) $dependencies;

        $attributes = (array) $attributes;

        $this->assets[$type][$name] = compact('source', 'dependencies', 'attributes');
    }

    public function styles($dom) {
        return $this->group($dom, 'style');
    }

    public function scripts($dom) {
        return $this->group($dom, 'script');
    }

    protected function group($dom, $group) {
        if(!isset($this->assets[$group]) or count($this->assets[$group]) == 0) {
            return array();
        }

        $assets = array();

        foreach ($this->arrange($this->assets[$group]) as $name => $data) {
            $assets[] = $this->asset($dom, $group, $name);
        }

        return $assets;
    }

    protected function asset($dom, $group, $name) {
        if(!isset($this->assets[$group][$name])) {
            return null;
        }

        $asset = $this->assets[$group][$name];

        if(!preg_match('/^(\w+:)?\/\//i', $asset['source'])) {
            $asset['source'] = $this->path($asset['source']);
        }

        $node = $dom->createElement($group == 'style' ? 'link' : 'script');

        foreach($asset['attributes'] as $key => $value) {
            $node->setAttribute($key, $value);
        }

        $node->setAttribute($group == 'style' ? 'href' : 'src', URL::to($asset['source']));

        return $node;
    }

    protected function arrange($assets) {
        list($original, $sorted) = array($assets, array());

        while (count($assets) > 0) {
            foreach ($assets as $asset => $value) {
                $this->evaluateAsset($asset, $value, $original, $sorted, $assets);
            }
        }

        return $sorted;
    }

    protected function evaluateAsset($asset, $value, $original, &$sorted, &$assets) {
        if (count($assets[$asset]['dependencies']) == 0) {
            $sorted[$asset] = $value;
            unset($assets[$asset]);
        } else {
            foreach ($assets[$asset]['dependencies'] as $key => $dependency) {
                if ( ! $this->dependencyIsValid($asset, $dependency, $original, $assets)) {
                    unset($assets[$asset]['dependencies'][$key]);
                    continue;
                }

                if (!isset($sorted[$dependency])) {
                    continue;
                }

                unset($assets[$asset]['dependencies'][$key]);
            }
        }
    }


    protected function dependencyIsValid($asset, $dependency, $original, $assets) {
        if(!isset($original[$dependency])) {
            return false;
        } elseif($dependency === $asset) {
            throw new \Exception("Asset [$asset] is dependent on itself.");
        } elseif (isset($assets[$dependency]) and in_array($asset, $assets[$dependency]['dependencies'])) {
            throw new \Exception("Assets [$asset] and [$dependency] have a circular dependency.");
        }

        return true;
    }
}
