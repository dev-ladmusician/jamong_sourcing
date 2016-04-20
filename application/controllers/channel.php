<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel extends CORE_Controller {

    function __construct () {
        parent::__construct();
    }

    function index()
    {
        $this->__get_views('_CHANNEL/index');
    }

    function home()
    {
        $this->__get_views('_CHANNEL/index');
    }

    function list_VR()
    {
        $this->__get_views('_CHANNEL/list_vr');
    }

    function list_sub()
    {
        $this->__get_views('_CHANNEL/list_sub');
    }
}
