<?php

namespace Parkcms\Programs\Admin;

interface Field
{
    public function create(array $properties);

    public function render();
}