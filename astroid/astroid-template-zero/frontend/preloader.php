<?php
/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2019 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 * 	DO NOT MODIFY THIS FILE DIRECTLY AS IT WILL BE OVERWRITTEN IN THE NEXT UPDATE
 *  You can easily override all files under /frontend/ folder.
 *	Just copy the file to ROOT/templates/YOURTEMPLATE/html/frontend/ folder to create and override
 */
// No direct access.
defined('_JEXEC') or die;
extract($displayData);

$enable_preloader = $template->params->get('preloader', 1);
if (!$enable_preloader) {
   return;
}

$preloder_setting = $template->params->get('preloder_setting', 'animations');
$preloader_animation = $template->params->get('preloader_animation', 'circle');
$preloader_image = $template->params->get('preloader_image', '');
$preloader_size = $template->params->get('preloader_size', 40);
$preloader_color = $template->params->get('preloader_color', '');
$preloader_bgcolor = $template->params->get('preloader_bgcolor', '');

if($preloder_setting == "animations"){
   switch ($preloader_animation) {
      case 'rotating-plane':
         $preloaderHTML = '<div class="sk-rotating-plane"></div>';
         $preloaderStyles = '.sk-rotating-plane{width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;background-color:' . $preloader_color . ';margin:0px auto;-webkit-animation:sk-rotatePlane 1.2s infinite ease-in-out;animation:sk-rotatePlane 1.2s infinite ease-in-out}@-webkit-keyframes sk-rotatePlane{0%{-webkit-transform:perspective(120px) rotateX(0) rotateY(0);transform:perspective(120px) rotateX(0) rotateY(0)}50%{-webkit-transform:perspective(120px) rotateX(-180.1deg) rotateY(0);transform:perspective(120px) rotateX(-180.1deg) rotateY(0)}100%{-webkit-transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg);transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg)}}@keyframes sk-rotatePlane{0%{-webkit-transform:perspective(120px) rotateX(0) rotateY(0);transform:perspective(120px) rotateX(0) rotateY(0)}50%{-webkit-transform:perspective(120px) rotateX(-180.1deg) rotateY(0);transform:perspective(120px) rotateX(-180.1deg) rotateY(0)}100%{-webkit-transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg);transform:perspective(120px) rotateX(-180deg) rotateY(-179.9deg)}}';
         break;
      case 'double-bounce':
         $preloaderHTML = '<div class="sk-double-bounce"><div class="sk-child sk-double-bounce1"></div><div class="sk-child sk-double-bounce2"></div></div>';
         $preloaderStyles = '.sk-double-bounce{width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative;margin:0px auto}.sk-double-bounce .sk-child{width:100%;height:100%;border-radius:50%;background-color:' . $preloader_color . ';opacity:.6;position:absolute;top:0;left:0;-webkit-animation:sk-doubleBounce 2s infinite ease-in-out;animation:sk-doubleBounce 2s infinite ease-in-out}.sk-double-bounce .sk-double-bounce2{-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-doubleBounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes sk-doubleBounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}';
         break;
      case 'wave':
         $preloaderHTML = '<div class="sk-wave"><div class="sk-rect sk-rect1"></div><div class="sk-rect sk-rect2"></div><div class="sk-rect sk-rect3"></div><div class="sk-rect sk-rect4"></div><div class="sk-rect sk-rect5"></div></div>';
         $preloaderStyles = '.sk-wave{margin:0px auto;width:50px;height:' . $preloader_size . 'px;text-align:center;font-size:10px}.sk-wave .sk-rect{background-color:' . $preloader_color . ';height:100%;width:6px;display:inline-block;-webkit-animation:sk-waveStretchDelay 1.2s infinite ease-in-out;animation:sk-waveStretchDelay 1.2s infinite ease-in-out}.sk-wave .sk-rect1{-webkit-animation-delay:-1.2s;animation-delay:-1.2s}.sk-wave .sk-rect2{-webkit-animation-delay:-1.1s;animation-delay:-1.1s}.sk-wave .sk-rect3{-webkit-animation-delay:-1s;animation-delay:-1s}.sk-wave .sk-rect4{-webkit-animation-delay:-.9s;animation-delay:-.9s}.sk-wave .sk-rect5{-webkit-animation-delay:-.8s;animation-delay:-.8s}@-webkit-keyframes sk-waveStretchDelay{0%,100%,40%{-webkit-transform:scaleY(.4);transform:scaleY(.4)}20%{-webkit-transform:scaleY(1);transform:scaleY(1)}}@keyframes sk-waveStretchDelay{0%,100%,40%{-webkit-transform:scaleY(.4);transform:scaleY(.4)}20%{-webkit-transform:scaleY(1);transform:scaleY(1)}}';
         break;
      case 'wandering-cubes':
         $preloaderHTML = '<div class="sk-wandering-cubes"><div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div></div>';
         $preloaderStyles = '.sk-wandering-cubes{margin:0px auto;width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative}.sk-wandering-cubes .sk-cube{background-color:' . $preloader_color . ';width:10px;height:10px;position:absolute;top:0;left:0;-webkit-animation:sk-wanderingCube 1.8s ease-in-out -1.8s infinite both;animation:sk-wanderingCube 1.8s ease-in-out -1.8s infinite both}.sk-wandering-cubes .sk-cube2{-webkit-animation-delay:-.9s;animation-delay:-.9s}@-webkit-keyframes sk-wanderingCube{0%{-webkit-transform:rotate(0);transform:rotate(0)}25%{-webkit-transform:translateX(30px) rotate(-90deg) scale(.5);transform:translateX(30px) rotate(-90deg) scale(.5)}50%{-webkit-transform:translateX(30px) translateY(30px) rotate(-179deg);transform:translateX(30px) translateY(30px) rotate(-179deg)}50.1%{-webkit-transform:translateX(30px) translateY(30px) rotate(-180deg);transform:translateX(30px) translateY(30px) rotate(-180deg)}75%{-webkit-transform:translateX(0) translateY(30px) rotate(-270deg) scale(.5);transform:translateX(0) translateY(30px) rotate(-270deg) scale(.5)}100%{-webkit-transform:rotate(-360deg);transform:rotate(-360deg)}}@keyframes sk-wanderingCube{0%{-webkit-transform:rotate(0);transform:rotate(0)}25%{-webkit-transform:translateX(30px) rotate(-90deg) scale(.5);transform:translateX(30px) rotate(-90deg) scale(.5)}50%{-webkit-transform:translateX(30px) translateY(30px) rotate(-179deg);transform:translateX(30px) translateY(30px) rotate(-179deg)}50.1%{-webkit-transform:translateX(30px) translateY(30px) rotate(-180deg);transform:translateX(30px) translateY(30px) rotate(-180deg)}75%{-webkit-transform:translateX(0) translateY(30px) rotate(-270deg) scale(.5);transform:translateX(0) translateY(30px) rotate(-270deg) scale(.5)}100%{-webkit-transform:rotate(-360deg);transform:rotate(-360deg)}}';
         break;
      case 'pulse':
         $preloaderHTML = '<div class="sk-spinner sk-spinner-pulse"></div>';
         $preloaderStyles = '.sk-spinner-pulse{width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;margin:0px auto;background-color:' . $preloader_color . ';border-radius:100%;-webkit-animation:sk-pulseScaleOut 1s infinite ease-in-out;animation:sk-pulseScaleOut 1s infinite ease-in-out}@-webkit-keyframes sk-pulseScaleOut{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}@keyframes sk-pulseScaleOut{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}';
         break;
      case 'chasing-dots':
         $preloaderHTML = '<div class="sk-chasing-dots"><div class="sk-child sk-dot1"></div><div class="sk-child sk-dot2"></div></div>';
         $preloaderStyles = '.sk-chasing-dots{margin:0px auto;width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative;text-align:center;-webkit-animation:sk-chasingDotsRotate 2s infinite linear;animation:sk-chasingDotsRotate 2s infinite linear}.sk-chasing-dots .sk-child{width:60%;height:60%;display:inline-block;position:absolute;top:0;background-color:' . $preloader_color . ';border-radius:100%;-webkit-animation:sk-chasingDotsBounce 2s infinite ease-in-out;animation:sk-chasingDotsBounce 2s infinite ease-in-out}.sk-chasing-dots .sk-dot2{top:auto;bottom:0;-webkit-animation-delay:-1s;animation-delay:-1s}@-webkit-keyframes sk-chasingDotsRotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes sk-chasingDotsRotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@-webkit-keyframes sk-chasingDotsBounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes sk-chasingDotsBounce{0%,100%{-webkit-transform:scale(0);transform:scale(0)}50%{-webkit-transform:scale(1);transform:scale(1)}}';
         break;
      case 'three-bounce':
         $preloaderHTML = '<div class="sk-three-bounce"> <div class="sk-child sk-bounce1"></div><div class="sk-child sk-bounce2"></div><div class="sk-child sk-bounce3"></div></div>';
         $preloaderStyles = '.sk-three-bounce{margin:0px auto;width:80px;text-align:center}.sk-three-bounce .sk-child{width:20px;height:20px;background-color:' . $preloader_color . ';border-radius:100%;display:inline-block;-webkit-animation:sk-three-bounce 1.4s ease-in-out 0s infinite both;animation:sk-three-bounce 1.4s ease-in-out 0s infinite both}.sk-three-bounce .sk-bounce1{-webkit-animation-delay:-.32s;animation-delay:-.32s}.sk-three-bounce .sk-bounce2{-webkit-animation-delay:-.16s;animation-delay:-.16s}@-webkit-keyframes sk-three-bounce{0%,100%,80%{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes sk-three-bounce{0%,100%,80%{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}';
         break;
      case 'circle':
         $preloaderHTML = '<div class="sk-circle"> <div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div></div>';
         $preloaderStyles = '.sk-circle{margin:0px auto;width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative}.sk-circle .sk-child{width:100%;height:100%;position:absolute;left:0;top:0}.sk-circle .sk-child:before{content:"";display:block;margin:0 auto;width:15%;height:15%;background-color:' . $preloader_color . ';border-radius:100%;-webkit-animation:sk-circleBounceDelay 1.2s infinite ease-in-out both;animation:sk-circleBounceDelay 1.2s infinite ease-in-out both}.sk-circle .sk-circle2{-webkit-transform:rotate(30deg);-ms-transform:rotate(30deg);transform:rotate(30deg)}.sk-circle .sk-circle3{-webkit-transform:rotate(60deg);-ms-transform:rotate(60deg);transform:rotate(60deg)}.sk-circle .sk-circle4{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg)}.sk-circle .sk-circle5{-webkit-transform:rotate(120deg);-ms-transform:rotate(120deg);transform:rotate(120deg)}.sk-circle .sk-circle6{-webkit-transform:rotate(150deg);-ms-transform:rotate(150deg);transform:rotate(150deg)}.sk-circle .sk-circle7{-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg)}.sk-circle .sk-circle8{-webkit-transform:rotate(210deg);-ms-transform:rotate(210deg);transform:rotate(210deg)}.sk-circle .sk-circle9{-webkit-transform:rotate(240deg);-ms-transform:rotate(240deg);transform:rotate(240deg)}.sk-circle .sk-circle10{-webkit-transform:rotate(270deg);-ms-transform:rotate(270deg);transform:rotate(270deg)}.sk-circle .sk-circle11{-webkit-transform:rotate(300deg);-ms-transform:rotate(300deg);transform:rotate(300deg)}.sk-circle .sk-circle12{-webkit-transform:rotate(330deg);-ms-transform:rotate(330deg);transform:rotate(330deg)}.sk-circle .sk-circle2:before{-webkit-animation-delay:-1.1s;animation-delay:-1.1s}.sk-circle .sk-circle3:before{-webkit-animation-delay:-1s;animation-delay:-1s}.sk-circle .sk-circle4:before{-webkit-animation-delay:-.9s;animation-delay:-.9s}.sk-circle .sk-circle5:before{-webkit-animation-delay:-.8s;animation-delay:-.8s}.sk-circle .sk-circle6:before{-webkit-animation-delay:-.7s;animation-delay:-.7s}.sk-circle .sk-circle7:before{-webkit-animation-delay:-.6s;animation-delay:-.6s}.sk-circle .sk-circle8:before{-webkit-animation-delay:-.5s;animation-delay:-.5s}.sk-circle .sk-circle9:before{-webkit-animation-delay:-.4s;animation-delay:-.4s}.sk-circle .sk-circle10:before{-webkit-animation-delay:-.3s;animation-delay:-.3s}.sk-circle .sk-circle11:before{-webkit-animation-delay:-.2s;animation-delay:-.2s}.sk-circle .sk-circle12:before{-webkit-animation-delay:-.1s;animation-delay:-.1s}@-webkit-keyframes sk-circleBounceDelay{0%,100%,80%{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes sk-circleBounceDelay{0%,100%,80%{-webkit-transform:scale(0);transform:scale(0)}40%{-webkit-transform:scale(1);transform:scale(1)}}';
         break;
      case 'cube-grid':
         $preloaderHTML = '<div class="sk-cube-grid"> <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>';
         $preloaderStyles = '.sk-cube-grid{width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;margin:0px auto}.sk-cube-grid .sk-cube{width:33.33%;height:33.33%;background-color:' . $preloader_color . ';float:left;-webkit-animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out;animation:sk-cubeGridScaleDelay 1.3s infinite ease-in-out}.sk-cube-grid .sk-cube1{-webkit-animation-delay:.2s;animation-delay:.2s}.sk-cube-grid .sk-cube2{-webkit-animation-delay:.3s;animation-delay:.3s}.sk-cube-grid .sk-cube3{-webkit-animation-delay:.4s;animation-delay:.4s}.sk-cube-grid .sk-cube4{-webkit-animation-delay:.1s;animation-delay:.1s}.sk-cube-grid .sk-cube5{-webkit-animation-delay:.2s;animation-delay:.2s}.sk-cube-grid .sk-cube6{-webkit-animation-delay:.3s;animation-delay:.3s}.sk-cube-grid .sk-cube7{-webkit-animation-delay:0ms;animation-delay:0ms}.sk-cube-grid .sk-cube8{-webkit-animation-delay:.1s;animation-delay:.1s}.sk-cube-grid .sk-cube9{-webkit-animation-delay:.2s;animation-delay:.2s}@-webkit-keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}@keyframes sk-cubeGridScaleDelay{0%,100%,70%{-webkit-transform:scale3D(1,1,1);transform:scale3D(1,1,1)}35%{-webkit-transform:scale3D(0,0,1);transform:scale3D(0,0,1)}}';
         break;
      case 'fading-circle':
         $preloaderHTML = '<div class="sk-fading-circle"> <div class="sk-circle1 sk-circle"></div><div class="sk-circle2 sk-circle"></div><div class="sk-circle3 sk-circle"></div><div class="sk-circle4 sk-circle"></div><div class="sk-circle5 sk-circle"></div><div class="sk-circle6 sk-circle"></div><div class="sk-circle7 sk-circle"></div><div class="sk-circle8 sk-circle"></div><div class="sk-circle9 sk-circle"></div><div class="sk-circle10 sk-circle"></div><div class="sk-circle11 sk-circle"></div><div class="sk-circle12 sk-circle"></div></div>';
         $preloaderStyles = '.sk-fading-circle{margin:0px auto;width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative}.sk-fading-circle .sk-circle{width:100%;height:100%;position:absolute;left:0;top:0}.sk-fading-circle .sk-circle:before{content:"";display:block;margin:0 auto;width:15%;height:15%;background-color:' . $preloader_color . ';border-radius:100%;-webkit-animation:sk-circleFadeDelay 1.2s infinite ease-in-out both;animation:sk-circleFadeDelay 1.2s infinite ease-in-out both}.sk-fading-circle .sk-circle2{-webkit-transform:rotate(30deg);-ms-transform:rotate(30deg);transform:rotate(30deg)}.sk-fading-circle .sk-circle3{-webkit-transform:rotate(60deg);-ms-transform:rotate(60deg);transform:rotate(60deg)}.sk-fading-circle .sk-circle4{-webkit-transform:rotate(90deg);-ms-transform:rotate(90deg);transform:rotate(90deg)}.sk-fading-circle .sk-circle5{-webkit-transform:rotate(120deg);-ms-transform:rotate(120deg);transform:rotate(120deg)}.sk-fading-circle .sk-circle6{-webkit-transform:rotate(150deg);-ms-transform:rotate(150deg);transform:rotate(150deg)}.sk-fading-circle .sk-circle7{-webkit-transform:rotate(180deg);-ms-transform:rotate(180deg);transform:rotate(180deg)}.sk-fading-circle .sk-circle8{-webkit-transform:rotate(210deg);-ms-transform:rotate(210deg);transform:rotate(210deg)}.sk-fading-circle .sk-circle9{-webkit-transform:rotate(240deg);-ms-transform:rotate(240deg);transform:rotate(240deg)}.sk-fading-circle .sk-circle10{-webkit-transform:rotate(270deg);-ms-transform:rotate(270deg);transform:rotate(270deg)}.sk-fading-circle .sk-circle11{-webkit-transform:rotate(300deg);-ms-transform:rotate(300deg);transform:rotate(300deg)}.sk-fading-circle .sk-circle12{-webkit-transform:rotate(330deg);-ms-transform:rotate(330deg);transform:rotate(330deg)}.sk-fading-circle .sk-circle2:before{-webkit-animation-delay:-1.1s;animation-delay:-1.1s}.sk-fading-circle .sk-circle3:before{-webkit-animation-delay:-1s;animation-delay:-1s}.sk-fading-circle .sk-circle4:before{-webkit-animation-delay:-.9s;animation-delay:-.9s}.sk-fading-circle .sk-circle5:before{-webkit-animation-delay:-.8s;animation-delay:-.8s}.sk-fading-circle .sk-circle6:before{-webkit-animation-delay:-.7s;animation-delay:-.7s}.sk-fading-circle .sk-circle7:before{-webkit-animation-delay:-.6s;animation-delay:-.6s}.sk-fading-circle .sk-circle8:before{-webkit-animation-delay:-.5s;animation-delay:-.5s}.sk-fading-circle .sk-circle9:before{-webkit-animation-delay:-.4s;animation-delay:-.4s}.sk-fading-circle .sk-circle10:before{-webkit-animation-delay:-.3s;animation-delay:-.3s}.sk-fading-circle .sk-circle11:before{-webkit-animation-delay:-.2s;animation-delay:-.2s}.sk-fading-circle .sk-circle12:before{-webkit-animation-delay:-.1s;animation-delay:-.1s}@-webkit-keyframes sk-circleFadeDelay{0%,100%,39%{opacity:0}40%{opacity:1}}@keyframes sk-circleFadeDelay{0%,100%,39%{opacity:0}40%{opacity:1}}';
         break;
      case 'folding-cube':
         $preloaderHTML = '<div class="sk-folding-cube"> <div class="sk-cube1 sk-cube"></div><div class="sk-cube2 sk-cube"></div><div class="sk-cube4 sk-cube"></div><div class="sk-cube3 sk-cube"></div></div>';
         $preloaderStyles = '.sk-folding-cube{margin:0px auto;width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;position:relative;-webkit-transform:rotateZ(45deg);transform:rotateZ(45deg)}.sk-folding-cube .sk-cube{float:left;width:50%;height:50%;position:relative;-webkit-transform:scale(1.1);-ms-transform:scale(1.1);transform:scale(1.1)}.sk-folding-cube .sk-cube:before{content:"";position:absolute;top:0;left:0;width:100%;height:100%;background-color:' . $preloader_color . ';-webkit-animation:sk-foldCubeAngle 2.4s infinite linear both;animation:sk-foldCubeAngle 2.4s infinite linear both;-webkit-transform-origin:100% 100%;-ms-transform-origin:100% 100%;transform-origin:100% 100%}.sk-folding-cube .sk-cube2{-webkit-transform:scale(1.1) rotateZ(90deg);transform:scale(1.1) rotateZ(90deg)}.sk-folding-cube .sk-cube3{-webkit-transform:scale(1.1) rotateZ(180deg);transform:scale(1.1) rotateZ(180deg)}.sk-folding-cube .sk-cube4{-webkit-transform:scale(1.1) rotateZ(270deg);transform:scale(1.1) rotateZ(270deg)}.sk-folding-cube .sk-cube2:before{-webkit-animation-delay:.3s;animation-delay:.3s}.sk-folding-cube .sk-cube3:before{-webkit-animation-delay:.6s;animation-delay:.6s}.sk-folding-cube .sk-cube4:before{-webkit-animation-delay:.9s;animation-delay:.9s}@-webkit-keyframes sk-foldCubeAngle{0%,10%{-webkit-transform:perspective(140px) rotateX(-180deg);transform:perspective(140px) rotateX(-180deg);opacity:0}25%,75%{-webkit-transform:perspective(140px) rotateX(0);transform:perspective(140px) rotateX(0);opacity:1}100%,90%{-webkit-transform:perspective(140px) rotateY(180deg);transform:perspective(140px) rotateY(180deg);opacity:0}}@keyframes sk-foldCubeAngle{0%,10%{-webkit-transform:perspective(140px) rotateX(-180deg);transform:perspective(140px) rotateX(-180deg);opacity:0}25%,75%{-webkit-transform:perspective(140px) rotateX(0);transform:perspective(140px) rotateX(0);opacity:1}100%,90%{-webkit-transform:perspective(140px) rotateY(180deg);transform:perspective(140px) rotateY(180deg);opacity:0}}';
         break;
      case 'bouncing-loader':
         $preloaderHTML = '<div class="bouncing-loader"><div></div><div></div><div></div></div>';
         $preloaderStyles = '.bouncing-loader{display:flex;justify-content:center;margin: 0 auto;}.bouncing-loader>div{width:' . $preloader_size . 'px;height:' . $preloader_size . 'px;margin:1rem 0.2rem 0;background:' . $preloader_color . ';border-radius:50%;animation:bouncing-loader 0.6s infinite alternate;}.bouncing-loader>div:nth-child(2){animation-delay:0.2s;}.bouncing-loader>div:nth-child(3){animation-delay:0.4s;}@keyframes bouncing-loader{to{opacity:0.1;transform:translate3d(0, -1rem, 0);}}';
         break;
      case 'donut':
         $preloaderHTML = '<div class="donut"></div>';
         $preloaderStyles = '@keyframes donut-spin{ 0% { transform:rotate(0deg); } 100% { transform:rotate(360deg); } } .donut {display:inline-block;border:4px solid rgba(0, 0, 0, 0.1);border-left-color:' . $preloader_color . ';border-radius:50%;margin:0 auto;width: ' . $preloader_size . 'px;height: ' . $preloader_size . 'px;animation:donut-spin 1.2s linear infinite;}';
         break;
      default:
         $preloaderHTML = '';
         $preloaderStyles = '';
         break;
   }
}elseif($preloder_setting == "image"){

   $preloader_image = $template->params->get('preloader_image', '');
   if (!empty($preloader_image)) {
      $styles = [];
      $styles[] = 'background-image:url(' . JURI::root() . $template->SeletedMedia(). '/' . $preloader_image . ')';
      $styles[] = 'background-repeat:' . $template->params->get('preloader_image_repeat', 'inherit');
      $styles[] = 'background-size:' . $template->params->get('preloader_image_size', 'inherit');
      $styles[] = 'background-position:' . $template->params->get('preloader_image_position', 'inherit');
      $styles[] = 'height:'.'100%';
      $styles[] = 'width:'.'100%';
   }
   $preloaderHTML = '<div class="preloader-image"></div>';
   $preloaderStyles = '.preloader-image{ '.implode(';', $styles).' }';

}
$template->addStyledeclaration('#astroid-preloader{background:' . $preloader_bgcolor . ';height:100%;left:0;position:fixed;top:0;width:100%;z-index:99999}');
$template->addStyledeclaration($preloaderStyles);
?>
<div id="astroid-preloader" class="d-flex align-items-center">
   <?php echo $preloaderHTML; ?>
</div>