/*
+--------------------------------------------------------------------+
                                                  
                                                  
/-`                                            `-/
dddhso/-`                                `-/oshddd
dddddddddhso/-`                    `-/oshddddddddd
dddddddddddddddhso++++++++++++++oshddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
ddddddddddddds++sdddddddddddddddds++sddddddddddddd
dddddddddddd-    -dddddddddddddd-    -dddddddddddd
dddddddddddd-    -dddddddddddddd-    -dddddddddddd
ddddddddddddds++sdddddddddddddddds++sddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd
dddddddddddddddddddddddddddddddddddddddddddddddddd


+--------------------------------------------------------------------+

    felixg.io - inLine

    Version: 1.0.3
    Realase: 2021-10-12
    Created by: Felice Gattuso
    Twitter: @felixg_io 
    Instagram: @felixg.io
    Docs: https://felixg.io/docs/products/inline
    
+--------------------------------------------------------------------+

*/
function inLine() {
    "use strict";

    function t() {
        if (q.onBlur = function (t) {
            !H.toolbar || H.dropdown || t.target == H.toolbar || H.toolbar.contains(t.target) || i()
        }, this.contentWindow.document.getElementsByTagName("head")[0].appendChild(W('@keyframes il_rumble{0%,to{transform:translate3d(0,0,0)}10%,30%,50%,70%,90%{transform:translate3d(-2px,0,0)}20%,40%,60%,80%{transform:translate3d(2px,0,0)}}button,input{border:0;margin:0;padding:0;appearance:none;background:none;outline:0;font-size:100%;color:currentColor}*{box-sizing:border-box;-webkit-tap-highlight-color:transparent;touch-action:manipulation}html{font-family:sans-serif;font-size:15px}input{font-size:16px}:root{--il__panel-backgroundColor:white;--il__panel-color:#252525;--il__button-hover-backgroundColor:rgba(0,0,0,.075);--il__button-open-backgroundColor:rgba(0,0,0,.1);--il__button-active-backgroundColor:#007cba20;--il__button-active-color:#007cba;--il__button-active-hover-backgroundColor:#007cba30;--il__button-active-hover-color:#007cba;--il__button-cancel-backgroundColor:#ff645c;--il__button-cancel-color:white;--il__button-cancel-hover-backgroundColor:#ff645c30;--il__button-cancel-hover-color:#ff645c;--il__button-confirm-backgroundColor:#6cd26c;--il__button-confirm-color:white;--il__button-confirm-hover-backgroundColor:#6cd26c30;--il__button-confirm-hover-color:#6cd26c;--il__tooltip-backgroundColor:#333;--il__tooltip-color:white;--il__dropdown-backgroundColor:white;--il__dropdown-color:#252525;--il__input-backgroundColor:rgba(0,0,0,0.075);--il__input-color:#252525;--il__button-reset-color:#ff645c}.il--dark{--il__panel-backgroundColor:#333333;--il__panel-color:#F4F4F4;--il__button-hover-backgroundColor:rgba(0,0,0,.15);--il__button-focus-backgroundColor:rgba(255,255,255,.15);--il__button-active-backgroundColor:#111111;--il__button-active-color:#F4F4F4;--il__button-active-hover-backgroundColor:#222222;--il__button-active-hover-color:#F4F4F4;--il__button-cancel-backgroundColor:#222222;--il__button-cancel-color:white;--il__button-cancel-hover-backgroundColor:#111111;--il__button-cancel-hover-color:white;--il__button-confirm-backgroundColor:#222222;--il__button-confirm-color:white;--il__button-confirm-hover-backgroundColor:#111111;--il__button-confirm-hover-color:white;--il__button-open-backgroundColor:rgba(0,0,0,.125);--il__tooltip-backgroundColor:white;--il__tooltip-color:#333;--il__dropdown-backgroundColor:#333333;--il__dropdown-color:#F4F4F4;--il__input-backgroundColor:#222222;--il__input-color:#F4F4F4;--il__button-reset-color:#ff645c}.il--purple{--il__panel-backgroundColor:linear-gradient(120deg,rgba(95,82,255,1) 0%,rgba(200,109,215,1) 100%);--il__panel-color:#F4F4F4;--il__button-hover-backgroundColor:rgba(0,0,0,.15);--il__button-focus-backgroundColor:rgba(255,255,255,.15);--il__button-active-backgroundColor:#F4F4F4;--il__button-active-color:rgba(95,82,255,1);--il__button-active-hover-backgroundColor:rgba(0,0,0,0.2);--il__button-active-hover-color:#F4F4F4;--il__button-open-backgroundColor:rgba(0,0,0,.125)}.il--rumble{animation:il_rumble 0.3s cubic-bezier(0.7,0,0.175,1)}.il__toolbar{position:fixed;opacity:0;visibility:hidden;transform:translateY(1rem) translateX(-50%);transition:opacity 0.6s cubic-bezier(0.165,0.84,0.44,1),visibility 0.6s cubic-bezier(0.165,0.84,0.44,1),transform 0.6s cubic-bezier(0.165,0.84,0.44,1);will-change:transform,opacity,visibility;pointer-events:none}.il__toolbar.il--visible{pointer-events:auto;opacity:1;visibility:visible;transform:translateY(0) translateX(-50%)}@media (max-width:767px){.il__toolbar{top:1rem!important;left:0!important;width:100%!important;transform:translateY(-1rem)}.il__toolbar.il--visible{transform:translateY(0)}}.il__tooltip{position:absolute;border-radius:0.5rem;background:var(--il__tooltip-backgroundColor);color:var(--il__tooltip-color);padding:0.25rem 0.5rem;top:100%;opacity:0;transition:opacity 0.3s ease,transform 0.3s ease;will-change:opacity,transform;transform:translateY(0) translateX(-50%);font-size:14px;white-space:nowrap;font-weight:bold;pointer-events:none;box-shadow:0 0 1rem rgba(0,0,0,0.1)}.il__tooltip.il--visible{transform:translateY(0.5rem) translateX(-50%);opacity:1}.il__dropdown{position:absolute;border-radius:0.5rem;background:var(--il__dropdown-backgroundColor);color:var(--il__dropdown-color);box-shadow:0 0 1rem rgba(0,0,0,0.1);opacity:0;transition:opacity 0.3s ease,transform 0.3s ease;will-change:opacity,transform;transform:translateY(0) translateX(-50%);pointer-events:none;outline:0}.il__dropdown.il--visible{transform:translateY(0.5rem) translateX(-50%);opacity:1;pointer-events:auto}.il__dropdown--link{padding:0.5rem;width:16rem}.il__dropdown--link input.il__input{padding:0.75rem;border-radius:0.5rem;background:var(--il__input-backgroundColor);color:var(--il__input-color);margin:0.125rem;width:calc(100% - (.125rem * 2))}.il__dropdown--link .il__footer{display:flex;align-items:center;justify-content:center}.il__dropdown--link .il__footer button.il__button{flex:1}.il__dropdown--link .il__footer button.il__button--cancel{background:var(--il__button-cancel-backgroundColor);color:var(--il__button-cancel-color)}.il__dropdown--link .il__footer button.il__button--cancel:focus,.il__dropdown--link .il__footer button.il__button--cancel:hover{background:var(--il__button-cancel-hover-backgroundColor);color:var(--il__button-cancel-hover-color)}.il__dropdown--link .il__footer button.il__button--confirm{background:var(--il__button-confirm-backgroundColor);color:var(--il__button-confirm-color)}.il__dropdown--link .il__footer button.il__button--confirm:focus,.il__dropdown--link .il__footer button.il__button--confirm:hover{background:var(--il__button-confirm-hover-backgroundColor);color:var(--il__button-confirm-hover-color)}.il__dropdown--color{padding:0.5rem;width:10rem}.il__dropdown--color input.il__input{padding:0.75rem;border-radius:0.5rem;background:var(--il__input-backgroundColor);color:var(--il__input-color);margin:0.125rem;width:calc(100% - (.125rem * 2));margin-bottom:0.5rem}.il__dropdown--color .il__group{display:flex;flex-wrap:wrap}.il__dropdown--color .il__group button{margin:0;flex:0 0 20%;max-width:20%;padding:0.1rem;cursor:pointer;position:relative}.il__dropdown--color .il__group button.il--resetStyle{color:var(--il__button-reset-color)}.il__dropdown--color .il__group button.il--resetStyle:after{background-color:transparent;box-shadow:inset 0 0 0 2px currentColor}.il__dropdown--color .il__group button.il--resetStyle:before{content:"";position:absolute;top:50%;left:50%;width:0.75rem;height:2px;transform:translate(-50%,-50%);background-color:currentColor;transition:transform 0.3s ease;will-change:transform}.il__dropdown--color .il__group button:not(.il--resetStyle):focus:after,.il__dropdown--color .il__group button:not(.il--resetStyle):hover:after{transform:scale(0.75)}.il__dropdown--color .il__group button:after{display:block;content:"";padding-bottom:99%;background-color:currentColor;border-radius:4rem;transition:transform 0.3s ease;will-change:transform}.il__panel{position:absolute;top:0;left:50%;transform:translateX(-45%);opacity:0;transition:opacity 0.3s ease,transform 0.3s ease;will-change:opacity,transform;pointer-events:none;background:var(--il__panel-backgroundColor);color:var(--il__panel-color);box-shadow:0 0.5rem 1.5rem rgba(0,0,0,0.2);border-radius:0.5rem;overflow:hidden;outline:0;max-width:calc(100vw - 2rem)}.il__panel:after,.il__panel:before{content:"";position:absolute;width:3rem;top:0;height:100%;pointer-events:none;background:var(--il__panel-backgroundColor);opacity:0;visibility:hidden;transition:opacity 0.3s ease,visibility 0.3s ease;will-change:opacity}.il__panel:before{left:-3rem;box-shadow:1rem 0 2rem 0.75rem var(--il__panel-backgroundColor)}.il__panel:after{right:-3rem;box-shadow:-1rem 0 2rem 0.75rem var(--il__panel-backgroundColor)}.il__panel--left:before,.il__panel--right:after{opacity:1;visibility:visible}.il__panel__container{display:flex;align-items:center;padding:0.25rem;overflow-x:auto;width:100%}@media (max-width:767px){.il__panel{box-shadow:0 0.5rem 1.5rem rgba(0,0,0,0.2),0 0 0 1px rgba(0,0,0,0.1)}}.il__panel.il--visible{transform:translateX(-50%);opacity:1;pointer-events:auto}.il__panel.il--hidden{transform:translateX(-55%);opacity:0;pointer-events:none}.il__panel button.il__button:last-child:after{content:"";position:absolute;height:100%;width:2.5rem;display:inline-block;margin-left:1rem}button.il__button{flex-shrink:0;flex:0 0 2.5rem;width:2.5rem;height:2.5rem;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;cursor:pointer;margin:0.125rem;border:1px solid transparent}button.il__button[style*=rgb]{background-color:currentColor!important}button.il__button[style*=rgb] svg{color:rgba(0,0,0,0.75)}button.il__button[style*=rgb].il--light svg{color:rgba(255,255,255,0.75)}button.il__button svg{width:1.25rem;height:1.25rem;flex-shrink:0}button.il__button.il--open{background:var(--il__button-open-backgroundColor);color:var(--il__button-open-color)}button.il__button.il--active,button.il__button.il--active:hover{background:var(--il__button-active-backgroundColor);color:var(--il__button-active-color)}button.il__button:not(.il--active):focus,button.il__button:not(.il--active):hover{background:var(--il__button-hover-backgroundColor);color:var(--il__button-hover-color)}')), this.contentWindow.document.addEventListener("mousedown", q.onBlur), q.options.customCSS) {
            var t = this.contentWindow.document.createElement("link");
            t.rel = "stylesheet", t.href = q.options.customCSS, this.contentWindow.document.getElementsByTagName("head")[0].appendChild(t)
        }
        "contentEditable" in H.trigger ? H.trigger.contentEditable = !0 : "designMode" in this.contentWindow.document && (this.contentWindow.document.designMode = "on")
    }

    function o(t) {
        var o = R("div", {
            class: "il__panel il__panel--" + t.id + " " + (t.class || "") + " il--" + q.options.theme,
            "aria-label": t.label,
            tabIndex: 0
        }), e = R("div", {class: "il__panel__container"});
        return o.appendChild(e), setTimeout((function () {
            e.addEventListener("scroll", P), P.call(e)
        }), 10), o
    }

    function e() {
        var t = j();
        if (t && H.toolbar) {
            var o = H.toolbar.querySelector(".il__panel.il--visible:not(.il--hidden)").getBoundingClientRect(),
                e = {top: t.offset.top + t.offset.height + 4, left: t.offset.left + t.offset.width / 2};
            e.left - o.width / 2 < 0 && (e.left = o.width / 2 + 16), e.left + o.width / 2 > q.window.innerWidth && (e.left = q.window.innerWidth - o.width / 2 - 16), e.top + o.height > q.window.innerHeight && (e.top = t.offset.top - o.height - 4), e.top < 0 && (e.top = 16), H.toolbar.style.top = e.top + "px", H.toolbar.style.left = e.left + "px"
        }
    }

    function n() {
        if (i(), H.selection = j(), H.selection) {
            H.toolbar = R("div", {class: "il__toolbar il--" + q.options.theme, role: "application"});
            var t = v();
            H.toolbar.appendChild(t), H.iframe.contentWindow.document.body.appendChild(H.toolbar), l(), H.iframe.style.display = "block"
        }
    }

    function i(t) {
        if (H.toolbar) {
            var o = H.toolbar;
            H.toolbar = !1, T(), o.classList.remove("il--visible"), setTimeout((function () {
                o.remove(), H.iframe.style.display = "none", r(), t && t()
            }), 400)
        }
    }

    function r() {
        q.window.removeEventListener("resize", q.onResize), q.window.removeEventListener("scroll", q.onScroll), H.trigger.removeEventListener("scroll", q.onScroll), q.options.onToolbarClose && q.options.onToolbarClose(H)
    }

    function l() {
        q.onResize = function () {
            e()
        }, q.window.addEventListener("resize", q.onResize), q.timeout = !1, q.onScroll = function () {
            if (H.dropdown) return !1;
            H.toolbar && (H.toolbar.classList.remove("il--visible"), clearInterval(q.timeout), q.timeout = setTimeout((function () {
                H.toolbar && (e(), H.toolbar.classList.add("il--visible"))
            }), 250))
        }, q.window.addEventListener("scroll", q.onScroll), H.trigger.addEventListener("scroll", q.onScroll), setTimeout((function () {
            e(), H.toolbar.classList.add("il--visible"), q.options.onToolbarOpen && q.options.onToolbarOpen(H, j())
        }), 10)
    }

    function a(t, o) {
        var e = j(), n = !1;
        if (o.command) {
            switch (o.command) {
                case"insertUnorderedList":
                    n = F(e.node, "ul");
                    break;
                case"insertUnorderedList":
                    n = F(e.node, "ol");
                    break;
                case"bold":
                    n = F(e.node, "strong") || F(e.node, "b");
                    break;
                default:
                    n = document.queryCommandState(o.command)
            }
            n && "underline" == o.id && (n = !F(e.node, "a"))
        }
        o.tag && (n = S(e.node, o.tag)), (o.tag || o.command) && (n ? (t.classList.add("il--active"), t.setAttribute("aria-pressed", "true")) : (t.classList.remove("il--active"), t.setAttribute("aria-pressed", "false")))
    }

    function c(t) {
        return '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.5">' + t + "</g></svg>"
    }

    function s(t) {
        t.html;
        var o = {
            class: "il__button il__button--" + t.id + " " + (t.class || ""),
            tabIndex: 0,
            "aria-label": t.label,
            role: "button",
            "aria-pressed": "false"
        };
        t.svg && (o.html = c(t.svg)), t.html && (o.html = t.html);
        var e = R("button", o);
        return a(e, t), t.label && e.addEventListener("mouseenter", (function () {
            w({text: t.label, target: e})
        })), e.onclick = function () {
            if (H.dropdown && !H.dropdown.contains(e) && H.dropdown.exit(), t.onclick && t.onclick(e), t.tag) {
                var o = S(j().node, t.tag);
                o ? (M(o), e.classList.remove("il--active")) : (D(t.tag), e.classList.add("il--active")), i()
            }
            t.command && (q.document.execCommand("styleWithCSS", !1, !1), q.document.execCommand(t.command, !1, null), a(e, t))
        }, e
    }

    function d(t) {
        var o = !1;
        switch (t.id) {
            case"align":
                o = f(t);
                break;
            case"link":
                o = p(t);
                break;
            case"color":
                o = b(t)
        }
        return o
    }

    function u(t) {
        return s({
            svg: '<path d="M17 24h16M23 33.9L13.1 24l9.9-9.9"/>',
            label: q.options.labels.back,
            id: "back",
            onclick: t
        })
    }

    function p(t) {
        var o = j(), e = F(o.node, "a"), n = !!e && S(o.node, "a"), r = function () {
            H.dropdown.exit(), i()
        };
        t.onclick = function (t) {
            t.classList.contains("il--open") ? (t.classList.remove("il--open"), H.dropdown && H.dropdown.exit()) : (t.classList.add("il--open"), H.dropdown = m({
                label: q.options.labels.linkPanel, target: t, id: "link", append: function (t) {
                    var o = function () {
                        var t = i.value;
                        if (!t.length) return i.focus(), E(i), !1;
                        e ? n.setAttribute("href", t) : document.execCommand("CreateLink", !1, t), r()
                    }, i = R("input", {
                        class: "il__input",
                        value: n ? n.getAttribute("href") : "",
                        placeholder: q.options.labels.linkPlaceholder
                    });
                    i.addEventListener("keypress", (function (t) {
                        13 == t.keyCode && o(), 27 == t.keyCode && H.dropdown.exit()
                    })), t.appendChild(i), setTimeout((function () {
                        i.focus()
                    }), 10);
                    var l = R("div", {class: "il__footer"});
                    t.appendChild(l);
                    var a = {
                        cancel: {
                            visible: e,
                            id: "cancel",
                            label: q.options.labels.removeLink,
                            svg: '<path d="M16 24h16M19 34.221h-3.731C9.598 34.221 5 29.624 5 23.952c0-5.177 3.83-9.459 8.812-10.166M35.798 33.734c4.138-1.325 7.134-5.204 7.134-9.782 0-5.671-4.598-10.268-10.269-10.268h-3.731M7 7l34 34"/>',
                            onclick: function () {
                                M(n), r()
                            }
                        },
                        confirm: {
                            visible: !0,
                            id: "confirm",
                            label: q.options.labels.confirmLink,
                            svg: '<path d="M16 24h16M19 34.221h-3.731C9.598 34.221 5 29.624 5 23.952c0-5.671 4.598-10.268 10.269-10.268H19M28.932 34.221h3.731c5.671 0 10.269-4.597 10.269-10.269 0-5.671-4.598-10.268-10.269-10.268h-3.731"/>',
                            onclick: function () {
                                o()
                            }
                        }
                    };
                    Object.keys(a).forEach((function (t) {
                        var o = a[t];
                        if (o.visible) {
                            var e = s(o);
                            l.appendChild(e)
                        }
                    }))
                }
            }))
        };
        var l = s(t);
        return e && l.classList.add("il--active"), l
    }

    function b(t) {
        var e = {
            textColor: {
                class: "il--unstyled il--colorPicker",
                id: "textColor",
                label: q.options.labels.textColor,
                property: "color",
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd"><rect class="line" width="26" height="4" x="11" y="37" fill="currentColor" rx="2"/><g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.5"><path d="M14 31l9.03-19.995a1 1 0 011.821-.004L34 31h0M19 22.5h10"/></g></g></svg>',
                onclick: function (t) {
                    h({id: "textColor", target: t, command: "foreColor", property: "color"})
                }
            },
            backgroundColor: {
                class: "il--unstyled il--colorPicker",
                id: "backgroundColor",
                label: q.options.labels.backgroundColor,
                property: "background-color",
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="4.5"><path d="M30.816 7.946l8.836 8.836-17.09 19.679-11.425-11.424zM12.299 35.299L8.718 38.88"/><path d="M30.157 38.88h10" class="line" /></g></svg>',
                onclick: function (t) {
                    h({id: "backgroundColor", target: t, command: "hilitecolor", property: "background-color"})
                }
            }
        };
        return t.onclick = function (n) {
            var i = j();
            t.panel.classList.add("il--hidden");
            var r = o({label: q.options.labels.colorPanel, id: t.id}), l = u((function () {
                r.classList.remove("il--visible"), setTimeout((function () {
                    r.remove()
                }), 600), t.panel.classList.remove("il--hidden"), t.panel.focus()
            }));
            r.querySelector(".il__panel__container").appendChild(l), Object.keys(e).forEach((function (t, o) {
                var n = e[t], l = s(n);
                i && g(l, B(i.node, n.property)), r.querySelector(".il__panel__container").appendChild(l)
            })), H.toolbar.appendChild(r), setTimeout((function () {
                r.classList.add("il--visible"), r.focus()
            }), 25)
        }, s(t)
    }

    function g(t, o) {
        o && "rgba(0, 0, 0, 0)" != o && "rgb(0, 0, 0)" != o && (k(o) ? t.classList.remove("il--light") : t.classList.add("il--light"), t.style.color = o)
    }

    function f(t) {
        var e = {
            justifyLeft: {
                id: "justifyLeft",
                label: q.options.labels.justifyLeft,
                svg: '<path d="M11 14h26M11 24.5h16M11 35h6"/>',
                command: "justifyLeft"
            },
            justifyCenter: {
                id: "justifyCenter",
                label: q.options.labels.justifyCenter,
                svg: '<path d="M11 14h26M16 24.5h16M21 35h6"/>',
                command: "justifyCenter"
            },
            justifyRight: {
                id: "justifyRight",
                label: q.options.labels.justifyRight,
                svg: '<path d="M11 14h26M21 24.5h16M31 35h6"/>',
                command: "justifyRight"
            },
            justifyFull: {
                id: "justifyFull",
                label: q.options.labels.justifyFull,
                svg: '<path d="M11 14h26M11 24.5h26M11 35h18.023"/>',
                command: "justifyFull"
            }
        }, n = !1;
        Object.keys(e).forEach((function (t, o) {
            q.document.queryCommandState(t) && (n = t)
        }));
        j();
        return t.svg = e[n].svg, t.onclick = function (n) {
            t.panel.classList.add("il--hidden");
            var i = o({label: q.options.labels.alignPanel, id: t.id}), r = u((function () {
                i.classList.remove("il--visible"), setTimeout((function () {
                    i.remove()
                }), 600), t.panel.classList.remove("il--hidden"), t.panel.focus()
            }));
            i.querySelector(".il__panel__container").appendChild(r), Object.keys(e).forEach((function (t, o) {
                var r = e[t];
                r.onclick = function () {
                    i.querySelectorAll("button").forEach((function (t, o) {
                        t.classList.remove("il--active")
                    })), n.innerHTML = c(r.svg)
                };
                var l = s(r);
                a(l, r), i.querySelector(".il__panel__container").appendChild(l)
            })), H.toolbar.appendChild(i), setTimeout((function () {
                i.classList.add("il--visible"), i.focus()
            }), 25)
        }, s(t)
    }

    function _() {
        H.content = H.trigger.innerHTML, H.output && (H.output.value = H.content)
    }

    function m(t) {
        var o = t.target.getBoundingClientRect(), e = R("div", {
            class: "il__dropdown il__dropdown--" + t.id + " " + (t.class || "") + " il--" + q.options.theme,
            "aria-label": t.label,
            role: "application",
            tabIndex: 0
        });
        t.append && t.append(e), H.iframe.contentWindow.document.body.appendChild(e), setTimeout((function () {
            e.focus()
        }), 10);
        !function () {
            var t = e.getBoundingClientRect(), n = {top: o.top + o.height, left: o.left + o.width / 2};
            n.left < 0 && (n.left = 16), n.left + t.width / 2 > q.window.innerWidth && (n.left = q.window.innerWidth - t.width / 2 - 16), n.top + t.height + 32 > q.window.innerHeight && (n.top = o.top - t.height - 16), n.top < 0 && (n.top = 16), e.style.top = n.top + "px", e.style.left = n.left + "px"
        }();
        var n = function () {
            H.dropdown = !1, e.classList.remove("il--visible"), t.target.classList.remove("il--open"), setTimeout((function () {
                q.window.removeEventListener("resize", l), q.window.removeEventListener("scroll", r), H.iframe.contentWindow.document.removeEventListener("mousedown", i), e.remove()
            }), 600)
        }, i = function (o) {
            o.target == t.target || t.target.contains(o.target) || o.target == e || e.contains(o.target) || e.exit()
        };
        Object.defineProperty(e, "exit", {
            value: function () {
                n()
            }, configurable: !0
        }), H.iframe.contentWindow.document.addEventListener("mousedown", i);
        var r = function () {
            if (H.dropdown) return !1;
            n()
        };
        q.window.addEventListener("scroll", r);
        var l = function () {
            n()
        };
        return q.window.addEventListener("resize", l), setTimeout((function () {
            e.classList.add("il--visible")
        }), 10), e
    }

    function h(t) {
        if (t.target.classList.contains("il--open")) t.target.classList.remove("il--open"), t.target.setAttribute("aria-pressed", "false"), H.dropdown && H.dropdown.exit(); else {
            var o = function (o) {
                q.document.execCommand("styleWithCSS", !1, !0), q.document.execCommand(t.command, !1, o), g(t.target, o)
            };
            t.target.classList.add("il--open"), t.target.setAttribute("aria-pressed", "true"), H.dropdown = m({
                label: q.options.labels.colorPalette,
                target: t.target,
                id: "color",
                append: function (e) {
                    var n = R("input", {class: "il__input", placeholder: "#000000"});
                    n.addEventListener("keypress", (function (t) {
                        13 == t.keyCode && o(this.value)
                    })), e.appendChild(n);
                    var i = R("div", {class: "il__group"});
                    e.appendChild(i);
                    var r = R("button", {class: "il--resetStyle", "aria-label": q.options.labels.removeStyle});
                    r.onclick = function () {
                        n.value = "", t.target.setAttribute("style", ""), q.document.execCommand(t.command, !1, "inherit"), g(t.target, "")
                    }, r.addEventListener("mouseenter", (function () {
                        w({text: q.options.labels.removeStyle, target: r})
                    })), i.appendChild(r), q.options.colors.forEach((function (t) {
                        var e = R("button", {"aria-label": t});
                        e.style.color = t, e.onclick = function () {
                            n.value = t, o(t)
                        }, i.appendChild(e)
                    }))
                }
            })
        }
    }

    function v() {
        var t = o({id: "index", label: q.options.labels.indexPanel, class: "il--visible"}), e = {
            bold: {
                id: "bold",
                command: "bold",
                label: q.options.labels.bold,
                svg: '<path d="M14 10h9.68a7.04 7.04 0 010 14.08H14h0V10zM14 24.08h12.32a7.04 7.04 0 010 14.08H14h0V24.08z"/>'
            },
            italic: {
                id: "italic",
                command: "italic",
                label: q.options.labels.italic,
                svg: '<path d="M28.134 9.757l-7.61 28.401M31.219 9.757h-6.917M24.242 38.158h-6.917"/>'
            },
            underline: {
                id: "underline",
                command: "underline",
                label: q.options.labels.underline,
                svg: '<path d="M14 39h20M34 9.435v11.38C34 26.44 29.523 31 24 31s-10-4.56-10-10.186V9.435"/>'
            },
            superscript: {
                id: "superscript",
                command: "superscript",
                label: q.options.labels.superscript,
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="490.003" height="460.14" viewBox="0 0 367.502 345.105"><g fill-rule="evenodd"><path fill="currentColor" d="M244.886 123.25c5.92-5.92 5.92-15.515 0-21.435-5.917-5.917-15.515-5.917-21.432 0l-85.678 85.677L52.1 101.815c-5.92-5.917-15.515-5.917-21.436 0-5.917 5.92-5.917 15.515 0 21.435l85.678 85.678-85.678 85.677c-5.917 5.917-5.917 15.515 0 21.432 5.92 5.92 15.515 5.92 21.436 0l85.677-85.677 85.678 85.677c5.917 5.92 15.515 5.92 21.432 0 5.92-5.917 5.92-15.515 0-21.432l-85.678-85.677zM268.729 36.746c0-8.37 6.786-15.156 15.156-15.156h22.735c20.928 0 37.89 16.963 37.89 37.89 0 20.929-16.962 37.892-37.89 37.892a7.579 7.579 0 0 0-7.578 7.578v7.578h30.312c8.37 0 15.157 6.787 15.157 15.157 0 8.37-6.787 15.156-15.157 15.156h-45.469c-8.37 0-15.156-6.787-15.156-15.156V104.95c0-20.928 16.963-37.89 37.89-37.89a7.579 7.579 0 0 0 0-15.157h-22.734c-8.37 0-15.156-6.787-15.156-15.157z"/></g></svg>'
            },
            subscript: {
                id: "subscript",
                command: "subscript",
                label: q.options.labels.subscript,
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="700pt" height="700pt" viewBox="0 0 700 700"><g fill-rule="evenodd"><path fill="currentColor" d="M473.41 116.764c11.654-11.654 11.654-30.54 0-42.195-11.648-11.647-30.541-11.647-42.188 0L262.568 243.222 93.915 74.57c-11.654-11.647-30.54-11.647-42.194 0-11.648 11.654-11.648 30.54 0 42.195l168.653 168.653L51.72 454.07c-11.648 11.647-11.648 30.54 0 42.188 11.654 11.654 30.54 11.654 42.194 0l168.653-168.653 168.654 168.653c11.647 11.654 30.54 11.654 42.187 0 11.655-11.648 11.655-30.54 0-42.188L304.756 285.417zM520.344 423.84c0-16.476 13.359-29.835 29.834-29.835h44.752c41.196 0 74.587 33.39 74.587 74.587 0 41.195-33.39 74.586-74.587 74.586-8.237 0-14.917 6.68-14.917 14.918v14.917h59.67c16.475 0 29.834 13.36 29.834 29.835 0 16.476-13.359 29.835-29.834 29.835h-89.505c-16.475 0-29.834-13.36-29.834-29.835v-44.752c0-41.196 33.39-74.587 74.586-74.587 8.238 0 14.918-6.68 14.918-14.917 0-8.238-6.68-14.918-14.918-14.918h-44.752c-16.475 0-29.834-13.359-29.834-29.834z"/></g></svg>'
            },
            strikeThrough: {
                id: "strikeThrough",
                command: "strikeThrough",
                label: q.options.labels.strikeThrough,
                svg: '<path d="M9 24h30M32.5 16.5c0-4.142-3.806-7.5-8.5-7.5s-8.5 3.358-8.5 7.5c0 4.142 3.806 7.5 8.5 7.5M15.5 31.5c0 4.142 3.806 7.5 8.5 7.5s8.5-3.358 8.5-7.5c0-4.142-3.806-7.5-8.5-7.5"/>'
            },
            unorderedList: {
                id: "unorderedList",
                command: "insertUnorderedList",
                label: q.options.labels.unorderedList,
                svg: '<path d="M22.5 32.5h13.177M22.5 15.5h13.177M13 32.5h1.78M13 15.5h1.78"/>',
                onclick: function () {
                    H.toolbar.querySelector(".il__button--orderedList").classList.remove("il--active")
                }
            },
            orderedList: {
                id: "orderedList",
                command: "insertOrderedList",
                label: q.options.labels.orderedList,
                svg: '<path d="M16.114 37h-5.12l4.475-6.08a1.959 1.959 0 00-.467-2.773 2.938 2.938 0 00-3.33-.003l-.003.003a1.89 1.89 0 00-.41 2.733M10.636 10h2.408v9.295M23.74 32.5h13.177M23.74 15.5h13.177"/>',
                onclick: function () {
                    H.toolbar.querySelector(".il__button--unorderedList").classList.remove("il--active")
                }
            },
            align: {id: "align", label: q.options.labels.align, custom: !0},
            link: {
                id: "link",
                label: q.options.labels.link,
                svg: '<path d="M16 24h16M19 34.221h-3.731C9.598 34.221 5 29.624 5 23.952c0-5.671 4.598-10.268 10.269-10.268H19M28.932 34.221h3.731c5.671 0 10.269-4.597 10.269-10.269 0-5.671-4.598-10.268-10.269-10.268h-3.731"/>',
                custom: !0
            },
            color: {
                id: "color",
                label: q.options.labels.color,
                html: '<svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48"><g fill="none" fill-rule="evenodd" transform="translate(5 5)"><circle cx="15" cy="11" r="3" fill="currentColor"/><circle cx="23" cy="11" r="3" fill="currentColor"/><circle cx="29" cy="17" r="3" fill="currentColor"/><circle cx="9" cy="17" r="3" fill="currentColor"/><path stroke="currentColor" stroke-width="4.5" d="M19 0C8.444 0 0 8.444 0 19s8.444 19 19 19c1.689 0 3.167-1.478 3.167-3.167 0-.844-.211-1.477-.845-2.11-.422-.634-.844-1.267-.844-2.112 0-1.689 1.478-3.167 3.166-3.167h3.8C33.356 27.444 38 22.8 38 16.89 38 7.6 29.556 0 19 0z"/></g></svg>',
                custom: !0
            }
        };
        return q.options.toolbar.forEach((function (o) {
            var n = e[o];
            if (n) {
                n.panel = t;
                var i = n.custom ? d(n) : s(n);
                t.querySelector(".il__panel__container").appendChild(i)
            }
        })), t
    }

    function w(t) {
        if (I()) return !1;
        var o = t.target ? t.target.getBoundingClientRect() : null,
            e = H.toolbar ? H.toolbar.getBoundingClientRect() : null;
        if (!o && !e) return !1;
        var n = R("div", {class: "il__tooltip", html: t.text});
        H.iframe.contentWindow.document.body.appendChild(n), n.style.top = (o.top + o.height + n.offsetHeight + 8 > q.window.innerHeight ? e.top - n.offsetHeight - 8 : o.top + o.height) + "px", n.style.left = o.left + o.width / 2 + "px", setTimeout((function () {
            n.classList.add("il--visible")
        }), 10);
        var i = function () {
            n.classList.remove("il--visible"), setTimeout((function () {
                n.remove()
            }), 300)
        };
        t.target.addEventListener("mouseleave", i), H.iframe.contentWindow.document.addEventListener("mousedown", i)
    }

    function k(t) {
        var o = !1;
        return t.includes("rgb") ? o = C(t) : t.includes("#") && (o = t), x(o)
    }

    function y(t) {
        return ["FF", "FC", "FA", "F7", "F5", "F2", "F0", "ED", "EB", "E8", "E6", "E3", "E0", "DE", "DB", "D9", "D6", "D4", "D1", "CF", "CC", "C9", "C7", "C4", "C2", "BF", "BD", "BA", "B8", "B5", "B3", "B0", "AD", "AB", "A8", "A6", "A3", "A1", "9E", "9C", "99", "96", "94", "91", "8F", "8C", "8A", "87", "85", "82", "80", "7D", "7A", "78", "75", "73", "70", "6E", "6B", "69", "66", "63", "61", "5E", "5C", "59", "57", "54", "52", "4F", "4D", "4A", "47", "45", "42", "40", "3D", "3B", "38", "36", "33", "30", "2E", "2B", "29", "26", "24", "21", "1F", "1C", "1A", "17", "14", "12", "0F", "0D", "0A", "08", "05", "03", "00"].reverse()[parseInt(t)]
    }

    function C(t) {
        var o = [];
        return t.replace(/[\d+\.]+/g, (function (t) {
            o.push(parseFloat(t))
        })), "#" + o.slice(0, 3).map(L).join("") + y(100 * (4 == o.length ? o[3] : 1))
    }

    function L(t) {
        var o = t.toString(16);
        return 1 == o.length ? "0" + o : o
    }

    function x(t) {
        const o = t.replace("#", "");
        return (299 * parseInt(o.substr(0, 2), 16) + 587 * parseInt(o.substr(2, 2), 16) + 114 * parseInt(o.substr(4, 2), 16)) / 1e3 > 155
    }

    function E(t) {
        t.classList.add("il--rumble"), setTimeout((function () {
            t.classList.remove("il--rumble")
        }), 300)
    }

    function M(t) {
        for (var o = t.parentNode; t.firstChild;) o.insertBefore(t.firstChild, t), t && t.remove()
    }

    function S(t, o) {
        return !!t.tagName && (t.tagName.toLowerCase() == o ? t : S(t.parentNode, o))
    }

    function F(t, o) {
        return !!(t && t.tagName && H.trigger.contains(t)) && (t.tagName.toLowerCase() == o || F(t.parentNode, o))
    }

    function T() {
        q.window.getSelection ? q.window.getSelection().empty ? q.window.getSelection().empty() : q.window.getSelection().removeAllRanges && q.window.getSelection().removeAllRanges() : q.document.selection && q.document.selection.empty(), H.selection = !1
    }

    function A(t) {
        try {
            return t instanceof HTMLElement
        } catch (o) {
            return "object" == typeof t && 1 === t.nodeType && "object" == typeof t.style && "object" == typeof t.ownerDocument
        }
    }

    function j() {
        var t = q.window.getSelection();
        if (!t.toString()) return !1;
        var o = t.getRangeAt(0).getBoundingClientRect(), e = z();
        return !!t.focusNode && {text: t.toString(), offset: o, node: e}
    }

    function B(t, o) {
        return !!A(t) && q.window.getComputedStyle(t, null).getPropertyValue(o)
    }

    function R(t, o) {
        (o = o || {}).attributes, o.style;
        var e = q.document.createElement(t);
        return o && Object.keys(o).forEach((function (t) {
            var n = o[t];
            switch (t) {
                case"html":
                    e.innerHTML = n;
                    break;
                case"style":
                    Object.keys(n).forEach((function (t) {
                        e.style[t] = n[t]
                    }));
                    break;
                default:
                    e.setAttribute(t, n)
            }
        })), e
    }

    function N(t, o) {
        for (var e in o) try {
            o[e].constructor == Object ? t[e] = N(t[e], o[e]) : t[e] = o[e]
        } catch (n) {
            t[e] = o[e]
        }
        return t
    }

    function W(t) {
        var o = q.document.createElement("style");
        return o.type = "text/css", o.styleSheet ? o.styleSheet.cssText = t : o.appendChild(q.document.createTextNode(t)), o
    }

    function z(t) {
        var o, e, n;
        return document.selection ? ((o = document.selection.createRange()).collapse(t), o.parentElement()) : ((e = window.getSelection()).getRangeAt ? e.rangeCount > 0 && (o = e.getRangeAt(0)) : ((o = document.createRange()).setStart(e.anchorNode, e.anchorOffset), o.setEnd(e.focusNode, e.focusOffset), o.collapsed !== e.isCollapsed && (o.setStart(e.focusNode, e.focusOffset), o.setEnd(e.anchorNode, e.anchorOffset))), o ? 3 === (n = o[t ? "startContainer" : "endContainer"]).nodeType ? n.parentNode : n : void 0)
    }

    function D(t) {
        var o = q.document.all ? q.document.selection.createRange().text : q.document.getSelection(), e = o.toString(),
            n = document.createElement(t);
        n.textContent = e;
        var i = o.getRangeAt(0);
        i.deleteContents(), i.insertNode(n)
    }

    function I() {
        return "ontouchstart" in window || navigator.maxTouchPoints > 0 || navigator.msMaxTouchPoints > 0
    }

    function P() {
        if (this.scrollWidth > this.parentNode.offsetWidth + 1) {
            var t = this.scrollWidth - this.parentNode.offsetWidth;
            this.scrollLeft > 0 ? this.parentNode.classList.add("il__panel--left") : this.parentNode.classList.remove("il__panel--left"), this.scrollLeft < t ? this.parentNode.classList.add("il__panel--right") : this.parentNode.classList.remove("il__panel--right")
        } else this.parentNode.classList.remove("il__panel--left"), this.parentNode.classList.remove("il__panel--right")
    }

    function O() {
        I() ? (q.onSelectionChange = function (t) {
            clearInterval(q.timeout), q.timeout = setTimeout((function () {
                t.target.activeElement == H.trigger && n()
            }), 350)
        }, q.document.addEventListener("selectionchange", q.onSelectionChange)) : (q.timeout = !1, q.onMouseUp = function (t) {
            clearInterval(q.timeout), q.timeout = setTimeout((function () {
                n()
            }), 10)
        }, q.onKeyUp = function (t) {
            clearInterval(q.timeout), q.timeout = setTimeout((function () {
                n()
            }), 350)
        }, H.trigger.addEventListener("mouseup", q.onMouseUp), H.trigger.addEventListener("keyup", q.onKeyUp))
    }

    var H = {};
    H.trigger = !!arguments[0] && document.querySelector(arguments[0]), H.set = function (t) {
        t && (q.options = N(q.options, t)), i()
    }, H.destroy = function () {
        var t = function () {
            q.onMouseUp && H.trigger.removeEventListener("mouseup", q.onMouseUp), q.onKeyUp && H.trigger.removeEventListener("mouseup", q.onKeyUp), q.onSelectionChange && q.document.removeEventListener("selectionchange", q.onSelectionChange), q.textarea && (H.trigger.remove(), H.output.style.display = "inherit"), H.iframe.remove(), q.options.onDestroy && q.options.onDestroy(), q = !1, H = !1
        };
        H.toolbar ? i((function () {
            t()
        })) : t()
    };
    var q = {
        options: {
            autoInit: !0,
            theme: "light",
            output: !1,
            html: !1,
            toolbar: ["bold", "italic", "underline", "superscript", "subscript", "strikeThrough", "align", "unorderedList", "orderedList", "color", "link"],
            colors: ["#199AA8", "#ABD356", "#F9C909", "#F45945", "#222C3A", "#4A5360", "#727985", "#99A0AB", "#C1C6D0"],
            labels: {
                back: "Back",
                indexPanel: "inLine editor toolbar",
                bold: "Bold",
                italic: "Italic",
                underline: "Underline",
                strikeThrough: "Strike",
                superscript: "Superscript",
                subscript: "Subscript",
                unorderedList: "Unordered list",
                orderedList: "Ordered list",
                align: "Align",
                alignPanel: "Align panel",
                justifyLeft: "Left",
                justifyCenter: "Center",
                justifyRight: "Right",
                justifyFull: "Justified",
                link: "Link",
                color: "Color",
                colorPanel: "Color panel",
                colorPalette: "Color palette",
                textColor: "Text color",
                backgroundColor: "Background color",
                linkPlaceholder: "Your link here",
                linkPanel: "Link panel",
                removeLink: "Remove link",
                confirmLink: "Confirm link",
                removeStyle: "Remove style"
            },
            onChange: !1,
            onReady: !1,
            onDestroy: !1,
            onToolbarOpen: !1,
            onToolbarClose: !1
        }
    };
    if (arguments[1] && (q.options = N(q.options, arguments[1])), q.document = H.trigger.ownerDocument, q.window = q.document.defaultView || q.document.parentWindow, H.trigger.tagName && ["TEXTAREA", "DIV"].includes(H.trigger.tagName)) return "TEXTAREA" == H.trigger.tagName && (q.textarea = !0, H.output = H.trigger, H.trigger = q.document.createElement("div"), H.trigger.innerHTML = H.output.value, H.output.parentNode.insertBefore(H.trigger, H.output.nextSibling), H.output.classList.add("il__output"), H.output.style.display = "none"), "DIV" == H.trigger.tagName && (H.trigger.setAttribute("contenteditable", !0), H.trigger.classList.add("il__trigger"), q.options.output && (H.output = q.document.querySelector(q.options.output))), "spellcheck" in H.trigger && (H.trigger.spellcheck = !1), q.options.html && (H.trigger.innerHTML = q.options.html), _(), q.options.onChange && H.trigger.addEventListener("input", (function () {
        q.options.onChange(H), _()
    })), H.iframe = R("iframe", {
        class: "il__frame",
        style: {
            width: "100%",
            height: "100%",
            border: 0,
            position: "fixed",
            top: 0,
            left: 0,
            display: "none",
            zIndex: 2147483647
        }
    }), H.iframe.onload = function () {
        t.call(this)
    }, q.document.body.appendChild(H.iframe), H.trigger && q.options.autoInit && O(), q.options.onReady && q.options.onReady(H), H;
    console.error("Invalid selector, you can initialize inLine only on textarea or div tag.")
}