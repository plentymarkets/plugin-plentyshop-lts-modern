!function(t){var e={};function r(n){if(e[n])return e[n].exports;var i=e[n]={i:n,l:!1,exports:{}};return t[n].call(i.exports,i,i.exports,r),i.l=!0,i.exports}r.m=t,r.c=e,r.d=function(t,e,n){r.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},r.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},r.t=function(t,e){if(1&e&&(t=r(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var n=Object.create(null);if(r.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)r.d(n,i,function(e){return t[e]}.bind(null,i));return n},r.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return r.d(e,"a",e),e},r.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},r.p="",r(r.s=1)}([function(t,e,r){"use strict";
/*! npm.im/object-fit-images 3.2.4 */var n="bfred-it:object-fit-images",i=/(object-fit|object-position)\s*:\s*([-.\w\s%]+)/g,o="undefined"==typeof Image?{style:{"object-position":1}}:new Image,s="object-fit"in o.style,c="object-position"in o.style,a="background-size"in o.style,u="string"==typeof o.currentSrc,l=o.getAttribute,f=o.setAttribute,g=!1;function d(t,e,r){var n="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='"+(e||1)+"' height='"+(r||0)+"'%3E%3C/svg%3E";l.call(t,"src")!==n&&f.call(t,"src",n)}function p(t,e){t.naturalWidth?e(t):setTimeout(p,100,t,e)}function m(t){var e=function(t){for(var e,r=getComputedStyle(t).fontFamily,n={};null!==(e=i.exec(r));)n[e[1]]=e[2];return n}(t),r=t[n];if(e["object-fit"]=e["object-fit"]||"fill",!r.img){if("fill"===e["object-fit"])return;if(!r.skipTest&&s&&!e["object-position"])return}if(!r.img){r.img=new Image(t.width,t.height),r.img.srcset=l.call(t,"data-ofi-srcset")||t.srcset,r.img.src=l.call(t,"data-ofi-src")||t.src,f.call(t,"data-ofi-src",t.src),t.srcset&&f.call(t,"data-ofi-srcset",t.srcset),d(t,t.naturalWidth||t.width,t.naturalHeight||t.height),t.srcset&&(t.srcset="");try{!function(t){var e={get:function(e){return t[n].img[e||"src"]},set:function(e,r){return t[n].img[r||"src"]=e,f.call(t,"data-ofi-"+r,e),m(t),e}};Object.defineProperty(t,"src",e),Object.defineProperty(t,"currentSrc",{get:function(){return e.get("currentSrc")}}),Object.defineProperty(t,"srcset",{get:function(){return e.get("srcset")},set:function(t){return e.set(t,"srcset")}})}(t)}catch(t){window.console&&console.warn("https://bit.ly/ofi-old-browser")}}!function(t){if(t.srcset&&!u&&window.picturefill){var e=window.picturefill._;t[e.ns]&&t[e.ns].evaled||e.fillImg(t,{reselect:!0}),t[e.ns].curSrc||(t[e.ns].supported=!1,e.fillImg(t,{reselect:!0})),t.currentSrc=t[e.ns].curSrc||t.src}}(r.img),t.style.backgroundImage='url("'+(r.img.currentSrc||r.img.src).replace(/"/g,'\\"')+'")',t.style.backgroundPosition=e["object-position"]||"center",t.style.backgroundRepeat="no-repeat",t.style.backgroundOrigin="content-box",/scale-down/.test(e["object-fit"])?p(r.img,(function(){r.img.naturalWidth>t.width||r.img.naturalHeight>t.height?t.style.backgroundSize="contain":t.style.backgroundSize="auto"})):t.style.backgroundSize=e["object-fit"].replace("none","auto").replace("fill","100% 100%"),p(r.img,(function(e){d(t,e.naturalWidth,e.naturalHeight)}))}function b(t,e){var r=!g&&!t;if(e=e||{},t=t||"img",c&&!e.skipTest||!a)return!1;"img"===t?t=document.getElementsByTagName("img"):"string"==typeof t?t=document.querySelectorAll(t):"length"in t||(t=[t]);for(var i=0;i<t.length;i++)t[i][n]=t[i][n]||{skipTest:e.skipTest},m(t[i]);r&&(document.body.addEventListener("load",(function(t){"IMG"===t.target.tagName&&b(t.target,{skipTest:e.skipTest})}),!0),g=!0,t="img"),e.watchMQ&&window.addEventListener("resize",b.bind(null,t,{skipTest:e.skipTest}))}b.supportsObjectFit=s,b.supportsObjectPosition=c,function(){function t(t,e){return t[n]&&t[n].img&&("src"===e||"srcset"===e)?t[n].img:t}c||(HTMLImageElement.prototype.getAttribute=function(e){return l.call(t(this,e),e)},HTMLImageElement.prototype.setAttribute=function(e,r){return f.call(t(this,e),e,String(r))})}(),t.exports=b},function(t,e,r){"use strict";r.r(e);var n=r(0),i=r.n(n);var o={PlentyShopLTSModern:class{constructor(){this.getHeaderElementsAndHeights(),document.addEventListener("scroll",()=>this.updateHeaderBackgrounds())}getHeaderElementsAndHeights(){this.bgTransparentElements=document.querySelectorAll("#page-header-parent > .bg-transparent:not(.unfixed)");const t=document.querySelectorAll("#page-header-parent > *"),e=document.querySelectorAll(".negative-margin-top");let r=0;t.forEach(t=>r+=t.offsetHeight),e.forEach(t=>t.style.setProperty("margin-top",-Math.ceil(r)+"px","important"));for(const e of t){if(!e.classList.contains("unfixed"))break;this.unfixedElementsHeight+=e.offsetHeight}this.updateHeaderBackgrounds()}updateHeaderBackgrounds(){const t=window.pageYOffset>this.unfixedElementsHeight;this.bgTransparentElements.forEach(e=>e.classList.toggle("bg-transparent",!t))}}};document.addEventListener("DOMContentLoaded",()=>{i()(),new o})}]);