/*!
 * jQuery UI Effects Fade 1.13.2
 * http://jqueryui.com
 *
 * Copyright jQuery Foundation and other contributors
 * Released under the MIT license.
 * http://jquery.org/license
 */
!function(e){"use strict";"function"==typeof define&&define.amd?define(["jquery","../version","../effect"],e):e(jQuery)}((function(e){"use strict";return e.effects.define("fade","toggle",(function(t,i){var n="show"===t.mode;e(this).css("opacity",n?0:1).animate({opacity:n?1:0},{queue:!1,duration:t.duration,easing:t.easing,complete:i})}))}));
//# sourceMappingURL=effect-fade-min.js.map