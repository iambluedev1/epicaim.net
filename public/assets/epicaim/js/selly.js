function ready() {
    var e = document.querySelectorAll("[data-selly-product]"),
        t = ".selly-close{z-index:9999999999;height:40px;position:fixed;right:30px;top:15px;width:40px;margin:0;border-radius:50%;cursor:pointer}.selly-close:hover{background:rgba(0,0,0,.4)}.selly-close:after,.selly-close:before{background:#fff;content:'';display:block;left:50%;position:absolute;top:50%;height:70%;width:2px}.selly-close:before{-webkit-transform:translateX(-50%) translateY(-50%) rotate(45deg);-webkit-transform-origin:center center;transform:translateX(-50%) translateY(-50%) rotate(45deg);transform-origin:center center}.selly-close:after{-webkit-transform:translateX(50%) translateY(50%) rotate(-45deg);-webkit-transform-origin:center center;transform:translateX(-50%) translateY(-50%) rotate(-45deg);transform-origin:center center}",
        l = document.head || document.getElementsByTagName("head")[0],
        o = document.createElement("style");
    for (o.type = "text/css", o.styleSheet ? o.styleSheet.cssText = t : o.appendChild(document.createTextNode(t)), l.appendChild(o), i = 0; i < e.length; i++) {
        var n = e[i].getAttribute("data-selly-product");
        e[i].addEventListener("click", sellyClick.bind(null, n))
    }
}

function sellyClick(e) {
    for (var t = document.querySelectorAll("[data-selly-product='" + e + "']")[0], l = "?", o = 0; o < 2; o++) {
        console.log("data-selly-custom-" + o);
        var n = t.getAttribute("data-selly-custom-" + o);
        console.log(n), n && (k = "" === l ? "?" : "&", l = l + k + "custom[" + o + "]=" + encodeURIComponent(n), console.log(l))
    }
    el = document.querySelectorAll("[data-selly-product='" + e + "']")[0], enabled.indexOf(e) > -1 ? (document.body.style.overflowY = "hidden", document.documentElement.style.overflowY = "hidden", document.getElementById("selly-" + e).style.display = "block") : (enabled.push(e), document.body.style.overflowY = "hidden", document.documentElement.style.overflowY = "hidden", document.body.insertAdjacentHTML("beforeend", '<div id="selly-' + e + '" style="overflow-y: scroll;overflow-x: hidden;position: fixed; z-index: 999999; background: rgba(0, 0, 0, 0.63); width: 100%; height: 100%; top: 0; margin-left: auto; margin-right: auto; "><span class="selly-close" onclick="hideSelly()"></span><div style=" position: relative; width: 100%; height: 0; padding-bottom: 56.25%; "><iframe src="https://selly.gg/p/' + e + "/embed" + l + '" style="border: none;height: 100vh;width: 500px;margin-left: auto;margin-right: auto;left: 50%;position: absolute;margin-left: -250px;"></iframe></div></div>'))
}

function hideSelly() {
    var e = document.querySelectorAll("[id*='selly-']");
    for (i = 0; i < e.length; i++) {
        var t = e[i];
        void 0 !== t && (t.style.display = "none")
    }
    document.body.style.overflowY = null, document.documentElement.style.overflowY = null
}

var enabled = [];
"loading" !== document.readyState ? ready() : document.addEventListener("DOMContentLoaded", ready);