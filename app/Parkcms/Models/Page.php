<?php

namespace Parkcms\Models;

use Baum\Node;

class Page extends Node {
    
    protected $table = 'pages';

    protected $hidden = array('rgt', 'depth');
    
}
