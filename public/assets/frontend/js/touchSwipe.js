/**
 * jQuery Plugin to obtain touch gestures from iPhone, iPod Touch and iPad, should also work with Android mobile phones (not tested yet!)
 * Common usage: wipe images (left and right to show the previous or next image)
 * 
 * @author Andreas Waltl, netCU Internetagentur (http://www.netcu.de)
 * @version 1.1.1 (9th December 2010) - fix bug (older IE's had problems)
 * @version 1.1 (1st September 2010) - support wipe up and wipe down
 * @version 1.0 (15th July 2010)
 */
!function(e){e.fn.touchwipe=function(t){var n={min_move_x:20,min_move_y:20,wipeLeft:function(){},wipeRight:function(){},wipeUp:function(){},wipeDown:function(){},preventDefaultEvents:!0};return t&&e.extend(n,t),this.each(function(){function e(){this.removeEventListener("touchmove",t),o=null,c=!1}function t(t){if(n.preventDefaultEvents&&t.preventDefault(),c){var i=t.touches[0].pageX,h=t.touches[0].pageY,a=o-i,s=u-h;Math.abs(a)>=n.min_move_x?(e(),a>0?n.wipeLeft():n.wipeRight()):Math.abs(s)>=n.min_move_y&&(e(),s>0?n.wipeDown():n.wipeUp())}}function i(e){1==e.touches.length&&(o=e.touches[0].pageX,u=e.touches[0].pageY,c=!0,this.addEventListener("touchmove",t,!1))}var o,u,c=!1;"ontouchstart"in document.documentElement&&this.addEventListener("touchstart",i,!1)}),this}}(jQuery);