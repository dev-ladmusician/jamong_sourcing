<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CORE_Controller {

    function __construct () {
        parent::__construct();
    }

    function index()
    {
        $this->__get_views('_PLAYER/index');
    }
}
