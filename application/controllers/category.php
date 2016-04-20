<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CORE_Controller {

    function __construct () {
        parent::__construct();
    }

    function index()
    {
        $str = $this->input->get('query');

        $data = array();
        array_push($data,$str);

        if(!strcmp("new",$str)){
            array_push($data, "신규");
        }else if(!strcmp("hot",$str)){
            array_push($data, "인기");
        }else if(!strcmp("show",$str)){
            array_push($data, "공연");
        }else if(!strcmp("sports",$str)){
            array_push($data, "스포츠");
        }else if(!strcmp("travel",$str)){
            array_push($data, "여행");
        }else if(!strcmp("business",$str)){
            array_push($data, "기업");
        }else if(!strcmp("entertainment",$str)){
            array_push($data, "엔터테인먼트");
        }else if(!strcmp("drama",$str)){
            array_push($data, "드라마");
        }else{
            array_push($data, "기타");
        }

        $this->__get_views('_CATEGORY/index', array("title"=>$data[1], "sub"=>$data[0]));
    }
}
