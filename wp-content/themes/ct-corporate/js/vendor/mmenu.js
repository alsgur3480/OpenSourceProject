/*
 * jQuery mmenu v5.4.0
 * @requires jQuery 1.7.0 or later
 *
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 * www.frebsite.nl
 *
 * Licensed under the MIT license:
 * http://en.wikipedia.org/wiki/MIT_License
 */
! function(e) {
    function t() {
        e[n].glbl || (l = {
            $wndw: e(window),
            $html: e("html"),
            $body: e("body")
        }, a = {}, i = {}, r = {}, e.each([a, i, r], function(e, t) {
            t.add = function(e) {
                e = e.split(" ");
                for (var n = 0, s = e.length; s > n; n++) t[e[n]] = t.mm(e[n])
            }
        }), a.mm = function(e) {
            return "mm-" + e
        }, a.add("wrapper menu panel nopanel current highest opened subopened navbar hasnavbar title btn prev next listview nolistview inset vertical selected divider spacer hidden fullsubopen"), a.umm = function(e) {
            return "mm-" == e.slice(0, 3) && (e = e.slice(3)), e
        }, i.mm = function(e) {
            return "mm-" + e
        }, i.add("parent sub"), r.mm = function(e) {
            return e + ".mm"
        }, r.add("transitionend webkitTransitionEnd mousedown mouseup touchstart touchmove touchend click keydown"), e[n]._c = a, e[n]._d = i, e[n]._e = r, e[n].glbl = l)
    }
    var n = "mmenu",
        s = "5.4.0";
    if (!e[n]) {
        e[n] = function(e, t, n) {
            this.$menu = e, this._api = ["bind", "init", "update", "setSelected", "getInstance", "openPanel", "closePanel", "closeAllPanels"], this.opts = t, this.conf = n, this.vars = {}, this.cbck = {}, "function" == typeof this.___deprecated && this.___deprecated(), this._initMenu(), this._initAnchors();
            var s = this.$menu.children(this.conf.panelNodetype);
            return this._initAddons(), this.init(s), "function" == typeof this.___debug && this.___debug(), this
        }, e[n].version = s, e[n].addons = {}, e[n].uniqueId = 0, e[n].defaults = {
            extensions: [],
            navbar: {
                add: !0,
                title: "Menu",
                titleLink: "panel"
            },
            onClick: {
                setSelected: !0
            },
            slidingSubmenus: !0
        }, e[n].configuration = {
            classNames: {
                divider: "Divider",
                inset: "Inset",
                panel: "Panel",
                selected: "Selected",
                spacer: "Spacer",
                vertical: "Vertical"
            },
            clone: !1,
            openingInterval: 25,
            panelNodetype: "ul, ol, div",
            transitionDuration: 400
        }, e[n].prototype = {
            init: function(e) {
                e = e.not("." + a.nopanel), e = this._initPanels(e), this.trigger("init", e), this.trigger("update")
            },
            update: function() {
                this.trigger("update")
            },
            setSelected: function(e) {
                this.$menu.find("." + a.listview).children().removeClass(a.selected), e.addClass(a.selected), this.trigger("setSelected", e)
            },
            openPanel: function(t) {
                var s = t.parent();
                if (s.hasClass(a.vertical)) {
                    var i = s.parents("." + a.subopened);
                    if (i.length) return this.openPanel(i.first());
                    s.addClass(a.opened)
                } else {
                    if (t.hasClass(a.current)) return;
                    var r = this.$menu.children("." + a.panel),
                        l = r.filter("." + a.current);
                    r.removeClass(a.highest).removeClass(a.current).not(t).not(l).not("." + a.vertical).addClass(a.hidden), e[n].support.csstransitions || l.addClass(a.hidden), t.hasClass(a.opened) ? t.nextAll("." + a.opened).addClass(a.highest).removeClass(a.opened).removeClass(a.subopened) : (t.addClass(a.highest), l.addClass(a.subopened)), t.removeClass(a.hidden).addClass(a.current), setTimeout(function() {
                        t.removeClass(a.subopened).addClass(a.opened)
                    }, this.conf.openingInterval)
                }
                this.trigger("openPanel", t)
            },
            closePanel: function(e) {
                var t = e.parent();
                t.hasClass(a.vertical) && (t.removeClass(a.opened), this.trigger("closePanel", e))
            },
            closeAllPanels: function() {
                this.$menu.find("." + a.listview).children().removeClass(a.selected).filter("." + a.vertical).removeClass(a.opened);
                var e = this.$menu.children("." + a.panel),
                    t = e.first();
                this.$menu.children("." + a.panel).not(t).removeClass(a.subopened).removeClass(a.opened).removeClass(a.current).removeClass(a.highest).addClass(a.hidden), this.openPanel(t)
            },
            togglePanel: function(e) {
                var t = e.parent();
                t.hasClass(a.vertical) && this[t.hasClass(a.opened) ? "closePanel" : "openPanel"](e)
            },
            getInstance: function() {
                return this
            },
            bind: function(e, t) {
                this.cbck[e] = this.cbck[e] || [], this.cbck[e].push(t)
            },
            trigger: function() {
                var e = this,
                    t = Array.prototype.slice.call(arguments),
                    n = t.shift();
                if (this.cbck[n])
                    for (var s = 0, a = this.cbck[n].length; a > s; s++) this.cbck[n][s].apply(e, t)
            },
            _initMenu: function() {
                this.opts.offCanvas && this.conf.clone && (this.$menu = this.$menu.clone(!0), this.$menu.add(this.$menu.find("[id]")).filter("[id]").each(function() {
                    e(this).attr("id", a.mm(e(this).attr("id")))
                })), this.$menu.contents().each(function() {
                    3 == e(this)[0].nodeType && e(this).remove()
                }), this.$menu.parent().addClass(a.wrapper);
                var t = [a.menu];
                this.opts.slidingSubmenus || t.push(a.vertical), this.opts.extensions = this.opts.extensions.length ? "mm-" + this.opts.extensions.join(" mm-") : "", this.opts.extensions && t.push(this.opts.extensions), this.$menu.addClass(t.join(" "))
            },
            _initPanels: function(t) {
                var n = this,
                    s = this.__findAddBack(t, "ul, ol");
                this.__refactorClass(s, this.conf.classNames.inset, "inset").addClass(a.nolistview + " " + a.nopanel), s.not("." + a.nolistview).addClass(a.listview);
                var r = this.__findAddBack(t, "." + a.listview).children();
                this.__refactorClass(r, this.conf.classNames.selected, "selected"), this.__refactorClass(r, this.conf.classNames.divider, "divider"), this.__refactorClass(r, this.conf.classNames.spacer, "spacer"), this.__refactorClass(this.__findAddBack(t, "." + this.conf.classNames.panel), this.conf.classNames.panel, "panel");
                var l = e(),
                    d = t.add(t.find("." + a.panel)).add(this.__findAddBack(t, "." + a.listview).children().children(this.conf.panelNodetype)).not("." + a.nopanel);
                this.__refactorClass(d, this.conf.classNames.vertical, "vertical"), this.opts.slidingSubmenus || d.addClass(a.vertical), d.each(function() {
                    var t = e(this),
                        s = t;
                    t.is("ul, ol") ? (t.wrap('<div class="' + a.panel + '" />'), s = t.parent()) : s.addClass(a.panel);
                    var i = t.attr("id");
                    t.removeAttr("id"), s.attr("id", i || n.__getUniqueId()), t.hasClass(a.vertical) && (t.removeClass(n.conf.classNames.vertical), s.add(s.parent()).addClass(a.vertical)), l = l.add(s)
                });
                var o = e("." + a.panel, this.$menu);
                l.each(function() {
                    var t = e(this),
                        s = t.parent(),
                        r = s.children("a, span").first();
                    if (s.is("." + a.menu) || (s.data(i.sub, t), t.data(i.parent, s)), !s.children("." + a.next).length && s.parent().is("." + a.listview)) {
                        var l = t.attr("id"),
                            d = e('<a class="' + a.next + '" href="#' + l + '" data-target="#' + l + '" />').insertBefore(r);
                        r.is("span") && d.addClass(a.fullsubopen)
                    }
                    if (!t.children("." + a.navbar).length && !s.hasClass(a.vertical)) {
                        if (s.parent().is("." + a.listview)) var s = s.closest("." + a.panel);
                        else var r = s.closest("." + a.panel).find('a[href="#' + t.attr("id") + '"]').first(),
                            s = r.closest("." + a.panel);
                        var o = e('<div class="' + a.navbar + '" />');
                        if (s.length) {
                            var l = s.attr("id");
                            switch (n.opts.navbar.titleLink) {
                                case "anchor":
                                    _url = r.attr("href");
                                    break;
                                case "panel":
                                case "parent":
                                    _url = "#" + l;
                                    break;
                                case "none":
                                default:
                                    _url = !1
                            }
                            o.append('<a class="' + a.btn + " " + a.prev + '" href="#' + l + '" data-target="#' + l + '" />').append(e('<a class="' + a.title + '"' + (_url ? ' href="' + _url + '"' : "") + " />").text(r.text())).prependTo(t), n.opts.navbar.add && t.addClass(a.hasnavbar)
                        } else n.opts.navbar.title && (o.append('<a class="' + a.title + '">' + n.opts.navbar.title + "</a>").prependTo(t), n.opts.navbar.add && t.addClass(a.hasnavbar))
                    }
                });
                var c = this.__findAddBack(t, "." + a.listview).children("." + a.selected).removeClass(a.selected).last().addClass(a.selected);
                c.add(c.parentsUntil("." + a.menu, "li")).filter("." + a.vertical).addClass(a.opened).end().not("." + a.vertical).each(function() {
                    e(this).parentsUntil("." + a.menu, "." + a.panel).not("." + a.vertical).first().addClass(a.opened).parentsUntil("." + a.menu, "." + a.panel).not("." + a.vertical).first().addClass(a.opened).addClass(a.subopened)
                }), c.children("." + a.panel).not("." + a.vertical).addClass(a.opened).parentsUntil("." + a.menu, "." + a.panel).not("." + a.vertical).first().addClass(a.opened).addClass(a.subopened);
                var u = o.filter("." + a.opened);
                return u.length || (u = l.first()), u.addClass(a.opened).last().addClass(a.current), l.not("." + a.vertical).not(u.last()).addClass(a.hidden).end().appendTo(this.$menu), l
            },
            _initAnchors: function() {
                var t = this;
                l.$body.on(r.click + "-oncanvas", "a[href]", function(s) {
                    var i = e(this),
                        r = !1,
                        d = t.$menu.find(i).length;
                    for (var o in e[n].addons)
                        if (r = e[n].addons[o].clickAnchor.call(t, i, d)) break;
                    if (!r && d) {
                        var c = i.attr("href");
                        if (c.length > 1 && "#" == c.slice(0, 1)) try {
                            var u = e(c, t.$menu);
                            u.is("." + a.panel) && (r = !0, t[i.parent().hasClass(a.vertical) ? "togglePanel" : "openPanel"](u))
                        } catch (h) {}
                    }
                    if (r && s.preventDefault(), !r && d && i.is("." + a.listview + " > li > a") && !i.is('[rel="external"]') && !i.is('[target="_blank"]')) {
                        t.__valueOrFn(t.opts.onClick.setSelected, i) && t.setSelected(e(s.target).parent());
                        var p = t.__valueOrFn(t.opts.onClick.preventDefault, i, "#" == c.slice(0, 1));
                        p && s.preventDefault(), t.__valueOrFn(t.opts.onClick.blockUI, i, !p) && l.$html.addClass(a.blocking), t.__valueOrFn(t.opts.onClick.close, i, p) && t.close()
                    }
                })
            },
            _initAddons: function() {
                for (var t in e[n].addons) e[n].addons[t].add.call(this), e[n].addons[t].add = function() {};
                for (var t in e[n].addons) e[n].addons[t].setup.call(this)
            },
            __api: function() {
                var t = this,
                    n = {};
                return e.each(this._api, function() {
                    var e = this;
                    n[e] = function() {
                        var s = t[e].apply(t, arguments);
                        return "undefined" == typeof s ? n : s
                    }
                }), n
            },
            __valueOrFn: function(e, t, n) {
                return "function" == typeof e ? e.call(t[0]) : "undefined" == typeof e && "undefined" != typeof n ? n : e
            },
            __refactorClass: function(e, t, n) {
                return e.filter("." + t).removeClass(t).addClass(a[n])
            },
            __findAddBack: function(e, t) {
                return e.find(t).add(e.filter(t))
            },
            __filterListItems: function(e) {
                return e.not("." + a.divider).not("." + a.hidden)
            },
            __transitionend: function(e, t, n) {
                var s = !1,
                    a = function() {
                        s || t.call(e[0]), s = !0
                    };
                e.one(r.transitionend, a), e.one(r.webkitTransitionEnd, a), setTimeout(a, 1.1 * n)
            },
            __getUniqueId: function() {
                return a.mm(e[n].uniqueId++)
            }
        }, e.fn[n] = function(s, a) {
            return t(), s = e.extend(!0, {}, e[n].defaults, s), a = e.extend(!0, {}, e[n].configuration, a), this.each(function() {
                var t = e(this);
                if (!t.data(n)) {
                    var i = new e[n](t, s, a);
                    t.data(n, i.__api())
                }
            })
        }, e[n].support = {
            touch: "ontouchstart" in window || navigator.msMaxTouchPoints,
            csstransitions: function() {
                if ("undefined" != typeof Modernizr) return Modernizr.csstransitions;
                var e = document.body || document.documentElement,
                    t = e.style,
                    n = "transition";
                if ("string" == typeof t[n]) return !0;
                var s = ["Moz", "webkit", "Webkit", "Khtml", "O", "ms"];
                n = n.charAt(0).toUpperCase() + n.substr(1);
                for (var a = 0; a < s.length; a++)
                    if ("string" == typeof t[s[a] + n]) return !0;
                return !1
            }()
        };
        var a, i, r, l
    }
}(jQuery);
/*
 * jQuery mmenu offCanvas addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(t) {
    var e = "mmenu",
        o = "offCanvas";
    t[e].addons[o] = {
        setup: function() {
            if (this.opts[o]) {
                var n = this.opts[o],
                    i = this.conf[o];
                a = t[e].glbl, this._api = t.merge(this._api, ["open", "close", "setPage"]), ("top" == n.position || "bottom" == n.position) && (n.zposition = "front"), "string" != typeof i.pageSelector && (i.pageSelector = "> " + i.pageNodetype), a.$allMenus = (a.$allMenus || t()).add(this.$menu), this.vars.opened = !1;
                var r = [s.offcanvas];
                "left" != n.position && r.push(s.mm(n.position)), "back" != n.zposition && r.push(s.mm(n.zposition)), this.$menu.addClass(r.join(" ")).parent().removeClass(s.wrapper), this.setPage(a.$page), this._initBlocker(), this["_initWindow_" + o](), this.$menu[i.menuInjectMethod + "To"](i.menuWrapperSelector)
            }
        },
        add: function() {
            s = t[e]._c, n = t[e]._d, i = t[e]._e, s.add("offcanvas slideout modal background opening blocker page"), n.add("style"), i.add("resize")
        },
        clickAnchor: function(t) {
            if (!this.opts[o]) return !1;
            var e = this.$menu.attr("id");
            if (e && e.length && (this.conf.clone && (e = s.umm(e)), t.is('[href="#' + e + '"]'))) return this.open(), !0;
            if (a.$page) {
                var e = a.$page.first().attr("id");
                return e && e.length && t.is('[href="#' + e + '"]') ? (this.close(), !0) : !1
            }
        }
    }, t[e].defaults[o] = {
        position: "left",
        zposition: "back",
        modal: !1,
        moveBackground: !0
    }, t[e].configuration[o] = {
        pageNodetype: "div",
        pageSelector: null,
        wrapPageIfNeeded: !0,
        menuWrapperSelector: "body",
        menuInjectMethod: "prepend"
    }, t[e].prototype.open = function() {
        if (!this.vars.opened) {
            var t = this;
            this._openSetup(), setTimeout(function() {
                t._openFinish()
            }, this.conf.openingInterval), this.trigger("open")
        }
    }, t[e].prototype._openSetup = function() {
        var e = this;
        this.closeAllOthers(), a.$page.each(function() {
            t(this).data(n.style, t(this).attr("style") || "")
        }), a.$wndw.trigger(i.resize + "-offcanvas", [!0]);
        var r = [s.opened];
        this.opts[o].modal && r.push(s.modal), this.opts[o].moveBackground && r.push(s.background), "left" != this.opts[o].position && r.push(s.mm(this.opts[o].position)), "back" != this.opts[o].zposition && r.push(s.mm(this.opts[o].zposition)), this.opts.extensions && r.push(this.opts.extensions), a.$html.addClass(r.join(" ")), setTimeout(function() {
            e.vars.opened = !0
        }, this.conf.openingInterval), this.$menu.addClass(s.current + " " + s.opened)
    }, t[e].prototype._openFinish = function() {
        var t = this;
        this.__transitionend(a.$page.first(), function() {
            t.trigger("opened")
        }, this.conf.transitionDuration), a.$html.addClass(s.opening), this.trigger("opening")
    }, t[e].prototype.close = function() {
        if (this.vars.opened) {
            var e = this;
            this.__transitionend(a.$page.first(), function() {
                e.$menu.removeClass(s.current).removeClass(s.opened), a.$html.removeClass(s.opened).removeClass(s.modal).removeClass(s.background).removeClass(s.mm(e.opts[o].position)).removeClass(s.mm(e.opts[o].zposition)), e.opts.extensions && a.$html.removeClass(e.opts.extensions), a.$page.each(function() {
                    t(this).attr("style", t(this).data(n.style))
                }), e.vars.opened = !1, e.trigger("closed")
            }, this.conf.transitionDuration), a.$html.removeClass(s.opening), this.trigger("close"), this.trigger("closing")
        }
    }, t[e].prototype.closeAllOthers = function() {
        a.$allMenus.not(this.$menu).each(function() {
            var o = t(this).data(e);
            o && o.close && o.close()
        })
    }, t[e].prototype.setPage = function(e) {
        var n = this,
            i = this.conf[o];
        e && e.length || (e = a.$body.find(i.pageSelector), e.length > 1 && i.wrapPageIfNeeded && (e = e.wrapAll("<" + this.conf[o].pageNodetype + " />").parent())), e.each(function() {
            t(this).attr("id", t(this).attr("id") || n.__getUniqueId())
        }), e.addClass(s.page + " " + s.slideout), a.$page = e, this.trigger("setPage", e)
    }, t[e].prototype["_initWindow_" + o] = function() {
        a.$wndw.off(i.keydown + "-offcanvas").on(i.keydown + "-offcanvas", function(t) {
            return a.$html.hasClass(s.opened) && 9 == t.keyCode ? (t.preventDefault(), !1) : void 0
        });
        var t = 0;
        a.$wndw.off(i.resize + "-offcanvas").on(i.resize + "-offcanvas", function(e, o) {
            if (1 == a.$page.length && (o || a.$html.hasClass(s.opened))) {
                var n = a.$wndw.height();
                (o || n != t) && (t = n, a.$page.css("minHeight", n))
            }
        })
    }, t[e].prototype._initBlocker = function() {
        var e = this;
        a.$blck || (a.$blck = t('<div id="' + s.blocker + '" class="' + s.slideout + '" />')), a.$blck.appendTo(a.$body).off(i.touchstart + "-offcanvas " + i.touchmove + "-offcanvas").on(i.touchstart + "-offcanvas " + i.touchmove + "-offcanvas", function(t) {
            t.preventDefault(), t.stopPropagation(), a.$blck.trigger(i.mousedown + "-offcanvas")
        }).off(i.mousedown + "-offcanvas").on(i.mousedown + "-offcanvas", function(t) {
            t.preventDefault(), a.$html.hasClass(s.modal) || (e.closeAllOthers(), e.close())
        })
    };
    var s, n, i, a
}(jQuery);
/*
 * jQuery mmenu autoHeight addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(t) {
    var e = "mmenu",
        i = "autoHeight";
    t[e].addons[i] = {
        setup: function() {
            if (this.opts.offCanvas) {
                switch (this.opts.offCanvas.position) {
                    case "left":
                    case "right":
                        return
                }
                var n = this,
                    o = this.opts[i];
                if (this.conf[i], h = t[e].glbl, "boolean" == typeof o && o && (o = {
                        height: "auto"
                    }), "object" != typeof o && (o = {}), o = this.opts[i] = t.extend(!0, {}, t[e].defaults[i], o), "auto" == o.height) {
                    this.$menu.addClass(s.autoheight);
                    var u = function(t) {
                        var e = this.$menu.children("." + s.current);
                        _top = parseInt(e.css("top"), 10) || 0, _bot = parseInt(e.css("bottom"), 10) || 0, this.$menu.addClass(s.measureheight), t = t || this.$menu.children("." + s.current), t.is("." + s.vertical) && (t = t.parents("." + s.panel).not("." + s.vertical).first()), this.$menu.height(t.outerHeight() + _top + _bot).removeClass(s.measureheight)
                    };
                    this.bind("update", u), this.bind("openPanel", u), this.bind("closePanel", u), this.bind("open", u), h.$wndw.off(a.resize + "-autoheight").on(a.resize + "-autoheight", function() {
                        u.call(n)
                    })
                }
            }
        },
        add: function() {
            s = t[e]._c, n = t[e]._d, a = t[e]._e, s.add("autoheight measureheight"), a.add("resize")
        },
        clickAnchor: function() {}
    }, t[e].defaults[i] = {
        height: "default"
    };
    var s, n, a, h
}(jQuery);
/*
 * jQuery mmenu backButton addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(o) {
    var t = "mmenu",
        n = "backButton";
    o[t].addons[n] = {
        setup: function() {
            if (this.opts.offCanvas) {
                var i = this,
                    e = this.opts[n];
                if (this.conf[n], a = o[t].glbl, "boolean" == typeof e && (e = {
                        close: e
                    }), "object" != typeof e && (e = {}), e = o.extend(!0, {}, o[t].defaults[n], e), e.close) {
                    var c = "#" + i.$menu.attr("id");
                    this.bind("opened", function() {
                        location.hash != c && history.pushState(null, document.title, c)
                    }), o(window).on("popstate", function(o) {
                        a.$html.hasClass(s.opened) ? (o.stopPropagation(), i.close()) : location.hash == c && (o.stopPropagation(), i.open())
                    })
                }
            }
        },
        add: function() {
            return window.history && window.history.pushState ? (s = o[t]._c, i = o[t]._d, e = o[t]._e, void 0) : (o[t].addons[n].setup = function() {}, void 0)
        },
        clickAnchor: function() {}
    }, o[t].defaults[n] = {
        close: !1
    };
    var s, i, e, a
}(jQuery);
/*
 * jQuery mmenu counters addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(t) {
    var n = "mmenu",
        e = "counters";
    t[n].addons[e] = {
        setup: function() {
            var c = this,
                o = this.opts[e];
            this.conf[e], s = t[n].glbl, "boolean" == typeof o && (o = {
                add: o,
                update: o
            }), "object" != typeof o && (o = {}), o = this.opts[e] = t.extend(!0, {}, t[n].defaults[e], o), this.bind("init", function(n) {
                this.__refactorClass(t("em", n), this.conf.classNames[e].counter, "counter")
            }), o.add && this.bind("init", function(n) {
                n.each(function() {
                    var n = t(this).data(a.parent);
                    n && (n.children("em." + i.counter).length || n.prepend(t('<em class="' + i.counter + '" />')))
                })
            }), o.update && this.bind("update", function() {
                this.$menu.find("." + i.panel).each(function() {
                    var n = t(this),
                        e = n.data(a.parent);
                    if (e) {
                        var s = e.children("em." + i.counter);
                        s.length && (n = n.children("." + i.listview), n.length && s.html(c.__filterListItems(n.children()).length))
                    }
                })
            })
        },
        add: function() {
            i = t[n]._c, a = t[n]._d, c = t[n]._e, i.add("counter search noresultsmsg")
        },
        clickAnchor: function() {}
    }, t[n].defaults[e] = {
        add: !1,
        update: !1
    }, t[n].configuration.classNames[e] = {
        counter: "Counter"
    };
    var i, a, c, s
}(jQuery);
/*
 * jQuery mmenu dividers addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(i) {
    var e = "mmenu",
        s = "dividers";
    i[e].addons[s] = {
        setup: function() {
            var n = this,
                a = this.opts[s];
            if (this.conf[s], l = i[e].glbl, "boolean" == typeof a && (a = {
                    add: a,
                    fixed: a
                }), "object" != typeof a && (a = {}), a = this.opts[s] = i.extend(!0, {}, i[e].defaults[s], a), this.bind("init", function() {
                    this.__refactorClass(i("li", this.$menu), this.conf.classNames[s].collapsed, "collapsed")
                }), a.add && this.bind("init", function(e) {
                    switch (a.addTo) {
                        case "panels":
                            var s = e;
                            break;
                        default:
                            var s = i(a.addTo, this.$menu).filter("." + d.panel)
                    }
                    i("." + d.divider, s).remove(), s.find("." + d.listview).not("." + d.vertical).each(function() {
                        var e = "";
                        n.__filterListItems(i(this).children()).each(function() {
                            var s = i.trim(i(this).children("a, span").text()).slice(0, 1).toLowerCase();
                            s != e && s.length && (e = s, i('<li class="' + d.divider + '">' + s + "</li>").insertBefore(this))
                        })
                    })
                }), a.collapse && this.bind("init", function(e) {
                    i("." + d.divider, e).each(function() {
                        var e = i(this),
                            s = e.nextUntil("." + d.divider, "." + d.collapsed);
                        s.length && (e.children("." + d.subopen).length || (e.wrapInner("<span />"), e.prepend('<a href="#" class="' + d.subopen + " " + d.fullsubopen + '" />')))
                    })
                }), a.fixed) {
                var o = function(e) {
                    e = e || this.$menu.children("." + d.current);
                    var s = e.find("." + d.divider).not("." + d.hidden);
                    if (s.length) {
                        this.$menu.addClass(d.hasdividers);
                        var n = e.scrollTop() || 0,
                            t = "";
                        e.is(":visible") && e.find("." + d.divider).not("." + d.hidden).each(function() {
                            i(this).position().top + n < n + 1 && (t = i(this).text())
                        }), this.$fixeddivider.text(t)
                    } else this.$menu.removeClass(d.hasdividers)
                };
                this.$fixeddivider = i('<ul class="' + d.listview + " " + d.fixeddivider + '"><li class="' + d.divider + '"></li></ul>').prependTo(this.$menu).children(), this.bind("openPanel", o), this.bind("init", function(e) {
                    e.off(t.scroll + "-dividers " + t.touchmove + "-dividers").on(t.scroll + "-dividers " + t.touchmove + "-dividers", function() {
                        o.call(n, i(this))
                    })
                })
            }
        },
        add: function() {
            d = i[e]._c, n = i[e]._d, t = i[e]._e, d.add("collapsed uncollapsed fixeddivider hasdividers"), t.add("scroll")
        },
        clickAnchor: function(i, e) {
            if (this.opts[s].collapse && e) {
                var n = i.parent();
                if (n.is("." + d.divider)) {
                    var t = n.nextUntil("." + d.divider, "." + d.collapsed);
                    return n.toggleClass(d.opened), t[n.hasClass(d.opened) ? "addClass" : "removeClass"](d.uncollapsed), !0
                }
            }
            return !1
        }
    }, i[e].defaults[s] = {
        add: !1,
        addTo: "panels",
        fixed: !1,
        collapse: !1
    }, i[e].configuration.classNames[s] = {
        collapsed: "Collapsed"
    };
    var d, n, t, l
}(jQuery);
/*
 * jQuery mmenu dragOpen addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(e) {
    function t(e, t, n) {
        return t > e && (e = t), e > n && (e = n), e
    }
    var n = "mmenu",
        o = "dragOpen";
    e[n].addons[o] = {
        setup: function() {
            if (this.opts.offCanvas) {
                var i = this,
                    a = this.opts[o],
                    p = this.conf[o];
                if (r = e[n].glbl, "boolean" == typeof a && (a = {
                        open: a
                    }), "object" != typeof a && (a = {}), a = this.opts[o] = e.extend(!0, {}, e[n].defaults[o], a), a.open) {
                    var d, f, c, u, h, l = {},
                        m = 0,
                        g = !1,
                        v = !1,
                        w = 0,
                        _ = 0;
                    switch (this.opts.offCanvas.position) {
                        case "left":
                        case "right":
                            l.events = "panleft panright", l.typeLower = "x", l.typeUpper = "X", v = "width";
                            break;
                        case "top":
                        case "bottom":
                            l.events = "panup pandown", l.typeLower = "y", l.typeUpper = "Y", v = "height"
                    }
                    switch (this.opts.offCanvas.position) {
                        case "right":
                        case "bottom":
                            l.negative = !0, u = function(e) {
                                e >= r.$wndw[v]() - a.maxStartPos && (m = 1)
                            };
                            break;
                        default:
                            l.negative = !1, u = function(e) {
                                e <= a.maxStartPos && (m = 1)
                            }
                    }
                    switch (this.opts.offCanvas.position) {
                        case "left":
                            l.open_dir = "right", l.close_dir = "left";
                            break;
                        case "right":
                            l.open_dir = "left", l.close_dir = "right";
                            break;
                        case "top":
                            l.open_dir = "down", l.close_dir = "up";
                            break;
                        case "bottom":
                            l.open_dir = "up", l.close_dir = "down"
                    }
                    switch (this.opts.offCanvas.zposition) {
                        case "front":
                            h = function() {
                                return this.$menu
                            };
                            break;
                        default:
                            h = function() {
                                return e("." + s.slideout)
                            }
                    }
                    var b = this.__valueOrFn(a.pageNode, this.$menu, r.$page);
                    "string" == typeof b && (b = e(b));
                    var y = new Hammer(b[0], a.vendors.hammer);
                    y.on("panstart", function(e) {
                        u(e.center[l.typeLower]), r.$slideOutNodes = h(), g = l.open_dir
                    }).on(l.events + " panend", function(e) {
                        m > 0 && e.preventDefault()
                    }).on(l.events, function(e) {
                        if (d = e["delta" + l.typeUpper], l.negative && (d = -d), d != w && (g = d >= w ? l.open_dir : l.close_dir), w = d, w > a.threshold && 1 == m) {
                            if (r.$html.hasClass(s.opened)) return;
                            m = 2, i._openSetup(), i.trigger("opening"), r.$html.addClass(s.dragging), _ = t(r.$wndw[v]() * p[v].perc, p[v].min, p[v].max)
                        }
                        2 == m && (f = t(w, 10, _) - ("front" == i.opts.offCanvas.zposition ? _ : 0), l.negative && (f = -f), c = "translate" + l.typeUpper + "(" + f + "px )", r.$slideOutNodes.css({
                            "-webkit-transform": "-webkit-" + c,
                            transform: c
                        }))
                    }).on("panend", function() {
                        2 == m && (r.$html.removeClass(s.dragging), r.$slideOutNodes.css("transform", ""), i[g == l.open_dir ? "_openFinish" : "close"]()), m = 0
                    })
                }
            }
        },
        add: function() {
            return "function" != typeof Hammer || Hammer.VERSION < 2 ? (e[n].addons[o].setup = function() {}, void 0) : (s = e[n]._c, i = e[n]._d, a = e[n]._e, s.add("dragging"), void 0)
        },
        clickAnchor: function() {}
    }, e[n].defaults[o] = {
        open: !1,
        maxStartPos: 100,
        threshold: 50,
        vendors: {
            hammer: {}
        }
    }, e[n].configuration[o] = {
        width: {
            perc: .8,
            min: 140,
            max: 440
        },
        height: {
            perc: .8,
            min: 140,
            max: 880
        }
    };
    var s, i, a, r
}(jQuery);
/*
 * jQuery mmenu fixedElements addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(i) {
    var s = "mmenu",
        n = "fixedElements";
    i[s].addons[n] = {
        setup: function() {
            if (this.opts.offCanvas) {
                this.opts[n], this.conf[n], o = i[s].glbl;
                var a = function(i) {
                    var s = this.conf.classNames[n].fixed;
                    this.__refactorClass(i.find("." + s), s, "slideout").appendTo(o.$body)
                };
                a.call(this, o.$page), this.bind("setPage", a)
            }
        },
        add: function() {
            a = i[s]._c, t = i[s]._d, e = i[s]._e, a.add("fixed")
        },
        clickAnchor: function() {}
    }, i[s].configuration.classNames[n] = {
        fixed: "Fixed"
    };
    var a, t, e, o
}(jQuery);
/*
 * jQuery mmenu iconPanels addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(e) {
    var n = "mmenu",
        i = "iconPanels";
    e[n].addons[i] = {
        setup: function() {
            var a = this,
                l = this.opts[i];
            if (this.conf[i], d = e[n].glbl, "boolean" == typeof l && (l = {
                    add: l
                }), "number" == typeof l && (l = {
                    add: !0,
                    visible: l
                }), "object" != typeof l && (l = {}), l = this.opts[i] = e.extend(!0, {}, e[n].defaults[i], l), l.visible++, l.add) {
                this.$menu.addClass(s.iconpanel);
                for (var t = [], o = 0; o <= l.visible; o++) t.push(s.iconpanel + "-" + o);
                t = t.join(" ");
                var c = function(n) {
                    var i = a.$menu.children("." + s.panel).removeClass(t),
                        d = i.filter("." + s.subopened);
                    d.removeClass(s.hidden).add(n).slice(-l.visible).each(function(n) {
                        e(this).addClass(s.iconpanel + "-" + n)
                    })
                };
                this.bind("openPanel", c), this.bind("init", function(n) {
                    c.call(a, a.$menu.children("." + s.current)), l.hideNavbars && n.removeClass(s.hasnavbar), n.each(function() {
                        e(this).children("." + s.subblocker).length || e(this).prepend('<a href="#' + e(this).closest("." + s.panel).attr("id") + '" class="' + s.subblocker + '" />')
                    })
                })
            }
        },
        add: function() {
            s = e[n]._c, a = e[n]._d, l = e[n]._e, s.add("iconpanel subblocker")
        },
        clickAnchor: function() {}
    }, e[n].defaults[i] = {
        add: !1,
        visible: 3,
        hideNavbars: !1
    };
    var s, a, l, d
}(jQuery);
/*
 * jQuery mmenu navbar addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(n) {
    var a = "mmenu",
        e = "navbars";
    n[a].addons[e] = {
        setup: function() {
            var r = this,
                i = this.opts[e],
                c = this.conf[e];
            if (s = n[a].glbl, "undefined" != typeof i) {
                i instanceof Array || (i = [i]);
                var d = {};
                n.each(i, function(s) {
                    var o = i[s];
                    "boolean" == typeof o && o && (o = {}), "object" != typeof o && (o = {}), "undefined" == typeof o.content && (o.content = ["prev", "title"]), o.content instanceof Array || (o.content = [o.content]), o = n.extend(!0, {}, r.opts.navbar, o);
                    var l = o.position,
                        h = o.height;
                    "number" != typeof h && (h = 1), h = Math.min(4, Math.max(1, h)), "bottom" != l && (l = "top"), d[l] || (d[l] = 0), d[l]++;
                    var f = n("<div />").addClass(t.navbar + " " + t.navbar + "-" + l + " " + t.navbar + "-" + l + "-" + d[l] + " " + t.navbar + "-size-" + h);
                    d[l] += h - 1;
                    for (var v = 0, u = o.content.length; u > v; v++) {
                        var p = n[a].addons[e][o.content[v]] || !1;
                        p ? p.call(r, f, o, c) : (p = o.content[v], p instanceof n || (p = n(o.content[v])), p.each(function() {
                            f.append(n(this))
                        }))
                    }
                    var b = Math.ceil(f.children().not("." + t.btn).length / h);
                    b > 1 && f.addClass(t.navbar + "-content-" + b), f.children("." + t.btn).length && f.addClass(t.hasbtns), f.prependTo(r.$menu)
                });
                for (var o in d) r.$menu.addClass(t.hasnavbar + "-" + o + "-" + d[o])
            }
        },
        add: function() {
            t = n[a]._c, r = n[a]._d, i = n[a]._e, t.add("close hasbtns")
        },
        clickAnchor: function() {}
    }, n[a].configuration[e] = {
        breadcrumbSeparator: "/"
    }, n[a].configuration.classNames[e] = {
        panelTitle: "Title",
        panelNext: "Next",
        panelPrev: "Prev"
    };
    var t, r, i, s
}(jQuery),
/*
 * jQuery mmenu navbar addon breadcrumbs content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "breadcrumbs";
    n[a].addons[e][t] = function(e, t, r) {
        var i = n[a]._c,
            s = n[a]._d;
        i.add("breadcrumbs separator"), e.append('<span class="' + i.breadcrumbs + '"></span>'), this.bind("init", function(a) {
            a.removeClass(i.hasnavbar).each(function() {
                for (var a = [], e = n(this), t = n('<span class="' + i.breadcrumbs + '"></span>'), c = n(this).children().first(), d = !0; c && c.length;) {
                    c.is("." + i.panel) || (c = c.closest("." + i.panel));
                    var o = c.children("." + i.navbar).children("." + i.title).text();
                    a.unshift(d ? "<span>" + o + "</span>" : '<a href="#' + c.attr("id") + '">' + o + "</a>"), d = !1, c = c.data(s.parent)
                }
                t.append(a.join('<span class="' + i.separator + '">' + r.breadcrumbSeparator + "</span>")).appendTo(e.children("." + i.navbar))
            })
        });
        var c = function() {
            var n = this.$menu.children("." + i.current),
                a = e.find("." + i.breadcrumbs),
                t = n.children("." + i.navbar).children("." + i.breadcrumbs);
            a.html(t.html())
        };
        this.bind("openPanel", c), this.bind("init", c)
    }
}(jQuery),
/*
 * jQuery mmenu navbar addon close content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "close";
    n[a].addons[e][t] = function(e) {
        var t = n[a]._c,
            r = n[a].glbl;
        e.append('<a class="' + t.close + " " + t.btn + '" href="#"></a>');
        var i = function(n) {
            e.find("." + t.close).attr("href", "#" + n.attr("id"))
        };
        i.call(this, r.$page), this.bind("setPage", i)
    }
}(jQuery),
/*
 * jQuery mmenu navbar addon next content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "next";
    n[a].addons[e][t] = function(t) {
        var r = n[a]._c;
        t.append('<a class="' + r.next + " " + r.btn + '" href="#"></a>');
        var i = function(n) {
            n = n || this.$menu.children("." + r.current);
            var a = t.find("." + r.next),
                i = n.find("." + this.conf.classNames[e].panelNext),
                s = i.attr("href"),
                c = i.html();
            a[s ? "attr" : "removeAttr"]("href", s), a[s || c ? "removeClass" : "addClass"](r.hidden), a.html(c)
        };
        this.bind("openPanel", i), this.bind("init", function() {
            i.call(this)
        })
    }
}(jQuery),
/*
 * jQuery mmenu navbar addon prev content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "prev";
    n[a].addons[e][t] = function(t) {
        var r = n[a]._c;
        t.append('<a class="' + r.prev + " " + r.btn + '" href="#"></a>'), this.bind("init", function(n) {
            n.removeClass(r.hasnavbar)
        });
        var i = function() {
            var n = this.$menu.children("." + r.current),
                a = t.find("." + r.prev),
                i = n.find("." + this.conf.classNames[e].panelPrev);
            i.length || (i = n.children("." + r.navbar).children("." + r.prev));
            var s = i.attr("href"),
                c = i.html();
            a[s ? "attr" : "removeAttr"]("href", s), a[s || c ? "removeClass" : "addClass"](r.hidden), a.html(c)
        };
        this.bind("openPanel", i), this.bind("init", i)
    }
}(jQuery),
/*
 * jQuery mmenu navbar addon searchfield content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "searchfield";
    n[a].addons[e][t] = function(e) {
        var t = n[a]._c,
            r = n('<div class="' + t.search + '" />').appendTo(e);
        "object" != typeof this.opts.searchfield && (this.opts.searchfield = {}), this.opts.searchfield.add = !0, this.opts.searchfield.addTo = r
    }
}(jQuery),
/*
 * jQuery mmenu navbar addon title content
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
function(n) {
    var a = "mmenu",
        e = "navbars",
        t = "title";
    n[a].addons[e][t] = function(t, r) {
        var i = n[a]._c;
        t.append('<a class="' + i.title + '"></a>');
        var s = function(n) {
            n = n || this.$menu.children("." + i.current);
            var a = t.find("." + i.title),
                s = n.find("." + this.conf.classNames[e].panelTitle);
            s.length || (s = n.children("." + i.navbar).children("." + i.title));
            var c = s.attr("href"),
                d = s.html() || r.title;
            a[c ? "attr" : "removeAttr"]("href", c), a[c || d ? "removeClass" : "addClass"](i.hidden), a.html(d)
        };
        this.bind("openPanel", s), this.bind("init", function() {
            s.call(this)
        })
    }
}(jQuery);
/*
 * jQuery mmenu searchfield addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(e) {
    function s(e) {
        switch (e) {
            case 9:
            case 16:
            case 17:
            case 18:
            case 37:
            case 38:
            case 39:
            case 40:
                return !0
        }
        return !1
    }
    var n = "mmenu",
        a = "searchfield";
    e[n].addons[a] = {
        setup: function() {
            var o = this,
                d = this.opts[a],
                c = this.conf[a];
            r = e[n].glbl, "boolean" == typeof d && (d = {
                add: d
            }), "object" != typeof d && (d = {}), d = this.opts[a] = e.extend(!0, {}, e[n].defaults[a], d), this.bind("close", function() {
                this.$menu.find("." + t.search).find("input").blur()
            }), this.bind("init", function(n) {
                if (d.add) {
                    switch (d.addTo) {
                        case "panels":
                            var a = n;
                            break;
                        default:
                            var a = e(d.addTo, this.$menu)
                    }
                    a.each(function() {
                        var s = e(this);
                        if (!s.is("." + t.panel) || !s.is("." + t.vertical)) {
                            if (!s.children("." + t.search).length) {
                                var n = c.form ? "form" : "div",
                                    a = e("<" + n + ' class="' + t.search + '" />');
                                if (c.form && "object" == typeof c.form)
                                    for (var l in c.form) a.attr(l, c.form[l]);
                                a.append('<input placeholder="' + d.placeholder + '" type="text" autocomplete="off" />'), s.hasClass(t.search) ? s.replaceWith(a) : s.prepend(a).addClass(t.hassearch)
                            }
                            if (d.noResults) {
                                var i = s.closest("." + t.panel).length;
                                if (i || (s = o.$menu.children("." + t.panel).first()), !s.children("." + t.noresultsmsg).length) {
                                    var r = s.children("." + t.listview).first();
                                    e('<div class="' + t.noresultsmsg + '" />').append(d.noResults)[r.length ? "insertAfter" : "prependTo"](r.length ? r : s)
                                }
                            }
                        }
                    }), d.search && e("." + t.search, this.$menu).each(function() {
                        var n = e(this),
                            a = n.closest("." + t.panel).length;
                        if (a) var r = n.closest("." + t.panel),
                            c = r;
                        else var r = e("." + t.panel, o.$menu),
                            c = o.$menu;
                        var h = n.children("input"),
                            u = o.__findAddBack(r, "." + t.listview).children("li"),
                            f = u.filter("." + t.divider),
                            p = o.__filterListItems(u),
                            v = "> a",
                            m = v + ", > span",
                            b = function() {
                                var s = h.val().toLowerCase();
                                r.scrollTop(0), p.add(f).addClass(t.hidden).find("." + t.fullsubopensearch).removeClass(t.fullsubopen).removeClass(t.fullsubopensearch), p.each(function() {
                                    var n = e(this),
                                        a = v;
                                    (d.showTextItems || d.showSubPanels && n.find("." + t.next)) && (a = m), e(a, n).text().toLowerCase().indexOf(s) > -1 && n.add(n.prevAll("." + t.divider).first()).removeClass(t.hidden)
                                }), d.showSubPanels && r.each(function() {
                                    var s = e(this);
                                    o.__filterListItems(s.find("." + t.listview).children()).each(function() {
                                        var s = e(this),
                                            n = s.data(l.sub);
                                        s.removeClass(t.nosubresults), n && n.find("." + t.listview).children().removeClass(t.hidden)
                                    })
                                }), e(r.get().reverse()).each(function(s) {
                                    var n = e(this),
                                        i = n.data(l.parent);
                                    i && (o.__filterListItems(n.find("." + t.listview).children()).length ? (i.hasClass(t.hidden) && i.children("." + t.next).not("." + t.fullsubopen).addClass(t.fullsubopen).addClass(t.fullsubopensearch), i.removeClass(t.hidden).removeClass(t.nosubresults).prevAll("." + t.divider).first().removeClass(t.hidden)) : a || (n.hasClass(t.opened) && setTimeout(function() {
                                        o.openPanel(i.closest("." + t.panel))
                                    }, 1.5 * (s + 1) * o.conf.openingInterval), i.addClass(t.nosubresults)))
                                }), c[p.not("." + t.hidden).length ? "removeClass" : "addClass"](t.noresults), this.update()
                            };
                        h.off(i.keyup + "-searchfield " + i.change + "-searchfield").on(i.keyup + "-searchfield", function(e) {
                            s(e.keyCode) || b.call(o)
                        }).on(i.change + "-searchfield", function() {
                            b.call(o)
                        })
                    })
                }
            })
        },
        add: function() {
            t = e[n]._c, l = e[n]._d, i = e[n]._e, t.add("search hassearch noresultsmsg noresults nosubresults fullsubopensearch"), i.add("change keyup")
        },
        clickAnchor: function() {}
    }, e[n].defaults[a] = {
        add: !1,
        addTo: "panels",
        search: !0,
        placeholder: "Search",
        noResults: "No results found.",
        showTextItems: !1,
        showSubPanels: !0
    }, e[n].configuration[a] = {
        form: !1
    };
    var t, l, i, r
}(jQuery);
/*
 * jQuery mmenu sectionIndexer addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(e) {
    var a = "mmenu",
        r = "sectionIndexer";
    e[a].addons[r] = {
        setup: function() {
            var i = this,
                d = this.opts[r];
            this.conf[r], s = e[a].glbl, "boolean" == typeof d && (d = {
                add: d
            }), "object" != typeof d && (d = {}), d = this.opts[r] = e.extend(!0, {}, e[a].defaults[r], d), this.bind("init", function(a) {
                if (d.add) {
                    switch (d.addTo) {
                        case "panels":
                            var r = a;
                            break;
                        default:
                            var r = e(d.addTo, this.$menu).filter("." + n.panel)
                    }
                    r.find("." + n.divider).closest("." + n.panel).addClass(n.hasindexer)
                }
                if (!this.$indexer && this.$menu.children("." + n.hasindexer).length) {
                    this.$indexer = e('<div class="' + n.indexer + '" />').prependTo(this.$menu).append('<a href="#a">a</a><a href="#b">b</a><a href="#c">c</a><a href="#d">d</a><a href="#e">e</a><a href="#f">f</a><a href="#g">g</a><a href="#h">h</a><a href="#i">i</a><a href="#j">j</a><a href="#k">k</a><a href="#l">l</a><a href="#m">m</a><a href="#n">n</a><a href="#o">o</a><a href="#p">p</a><a href="#q">q</a><a href="#r">r</a><a href="#s">s</a><a href="#t">t</a><a href="#u">u</a><a href="#v">v</a><a href="#w">w</a><a href="#x">x</a><a href="#y">y</a><a href="#z">z</a>'), this.$indexer.children().on(t.mouseover + "-sectionindexer " + n.touchstart + "-sectionindexer", function() {
                        var a = e(this).attr("href").slice(1),
                            r = i.$menu.children("." + n.current),
                            t = r.find("." + n.listview),
                            s = !1,
                            d = r.scrollTop(),
                            h = t.position().top + parseInt(t.css("margin-top"), 10) + parseInt(t.css("padding-top"), 10) + d;
                        r.scrollTop(0), t.children("." + n.divider).not("." + n.hidden).each(function() {
                            s === !1 && a == e(this).text().slice(0, 1).toLowerCase() && (s = e(this).position().top + h)
                        }), r.scrollTop(s !== !1 ? s : d)
                    });
                    var s = function(e) {
                        i.$menu[(e.hasClass(n.hasindexer) ? "add" : "remove") + "Class"](n.hasindexer)
                    };
                    this.bind("openPanel", s), s.call(this, this.$menu.children("." + n.current))
                }
            })
        },
        add: function() {
            n = e[a]._c, i = e[a]._d, t = e[a]._e, n.add("indexer hasindexer"), t.add("mouseover touchstart")
        },
        clickAnchor: function(e) {
            return e.parent().is("." + n.indexer) ? !0 : void 0
        }
    }, e[a].defaults[r] = {
        add: !1,
        addTo: "panels"
    };
    var n, i, t, s
}(jQuery);
/*
 * jQuery mmenu toggles addon
 * mmenu.frebsite.nl
 *
 * Copyright (c) Fred Heusschen
 */
! function(t) {
    var e = "mmenu",
        c = "toggles";
    t[e].addons[c] = {
        setup: function() {
            var n = this;
            this.opts[c], this.conf[c], l = t[e].glbl, this.bind("init", function(e) {
                this.__refactorClass(t("input", e), this.conf.classNames[c].toggle, "toggle"), this.__refactorClass(t("input", e), this.conf.classNames[c].check, "check"), t("input." + s.toggle + ", input." + s.check, e).each(function() {
                    var e = t(this),
                        c = e.closest("li"),
                        i = e.hasClass(s.toggle) ? "toggle" : "check",
                        l = e.attr("id") || n.__getUniqueId();
                    c.children('label[for="' + l + '"]').length || (e.attr("id", l), c.prepend(e), t('<label for="' + l + '" class="' + s[i] + '"></label>').insertBefore(c.children("a, span").last()))
                })
            })
        },
        add: function() {
            s = t[e]._c, n = t[e]._d, i = t[e]._e, s.add("toggle check")
        },
        clickAnchor: function() {}
    }, t[e].configuration.classNames[c] = {
        toggle: "Toggle",
        check: "Check"
    };
    var s, n, i, l
}(jQuery);
