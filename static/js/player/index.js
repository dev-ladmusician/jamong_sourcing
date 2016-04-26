///**
// * Created by SangBeom on 2016-04-20.
// */
//embedpano(
//    {
//        //used in flash
//        //swf: "krpano.swf",
//
//        //null is used
//        //xml: "pano.xml",
//        xml: null,
//
//        //The #id of the html element where the viewer should be embedded.
//        // There will be an 'alert()' error when no target will be set.
//        target: "pano"
//    });
var dir = 'static/js/krpano/';
embedpano({swf:dir + "krpano.swf", xml:dir +"krpano.xml", target:"pano", html5:"only"});