/* PrismJS 1.28.0
https://prismjs.com/download.html#themes=prism&languages=markup+css+clike+javascript+css-extras&plugins=line-numbers+inline-color+command-line */
var _self = "undefined" != typeof window ? window : "undefined" != typeof WorkerGlobalScope && self instanceof WorkerGlobalScope ? self : {},
    Prism = function(e) {
        var n = /(?:^|\s)lang(?:uage)?-([\w-]+)(?=\s|$)/i,
            t = 0,
            r = {},
            a = {
                manual: e.Prism && e.Prism.manual,
                disableWorkerMessageHandler: e.Prism && e.Prism.disableWorkerMessageHandler,
                util: {
                    encode: function e(n) {
                        return n instanceof i ? new i(n.type, e(n.content), n.alias) : Array.isArray(n) ? n.map(e) : n.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/\u00a0/g, " ")
                    },
                    type: function(e) {
                        return Object.prototype.toString.call(e).slice(8, -1)
                    },
                    objId: function(e) {
                        return e.__id || Object.defineProperty(e, "__id", {
                            value: ++t
                        }), e.__id
                    },
                    clone: function e(n, t) {
                        var r, i;
                        switch (t = t || {}, a.util.type(n)) {
                            case "Object":
                                if (i = a.util.objId(n), t[i]) return t[i];
                                for (var l in r = {}, t[i] = r, n) n.hasOwnProperty(l) && (r[l] = e(n[l], t));
                                return r;
                            case "Array":
                                return i = a.util.objId(n), t[i] ? t[i] : (r = [], t[i] = r, n.forEach((function(n, a) {
                                    r[a] = e(n, t)
                                })), r);
                            default:
                                return n
                        }
                    },
                    getLanguage: function(e) {
                        for (; e;) {
                            var t = n.exec(e.className);
                            if (t) return t[1].toLowerCase();
                            e = e.parentElement
                        }
                        return "none"
                    },
                    setLanguage: function(e, t) {
                        e.className = e.className.replace(RegExp(n, "gi"), ""), e.classList.add("language-" + t)
                    },
                    currentScript: function() {
                        if ("undefined" == typeof document) return null;
                        if ("currentScript" in document) return document.currentScript;
                        try {
                            throw new Error
                        } catch (r) {
                            var e = (/at [^(\r\n]*\((.*):[^:]+:[^:]+\)$/i.exec(r.stack) || [])[1];
                            if (e) {
                                var n = document.getElementsByTagName("script");
                                for (var t in n)
                                    if (n[t].src == e) return n[t]
                            }
                            return null
                        }
                    },
                    isActive: function(e, n, t) {
                        for (var r = "no-" + n; e;) {
                            var a = e.classList;
                            if (a.contains(n)) return !0;
                            if (a.contains(r)) return !1;
                            e = e.parentElement
                        }
                        return !!t
                    }
                },
                languages: {
                    plain: r,
                    plaintext: r,
                    text: r,
                    txt: r,
                    extend: function(e, n) {
                        var t = a.util.clone(a.languages[e]);
                        for (var r in n) t[r] = n[r];
                        return t
                    },
                    insertBefore: function(e, n, t, r) {
                        var i = (r = r || a.languages)[e],
                            l = {};
                        for (var o in i)
                            if (i.hasOwnProperty(o)) {
                                if (o == n)
                                    for (var s in t) t.hasOwnProperty(s) && (l[s] = t[s]);
                                t.hasOwnProperty(o) || (l[o] = i[o])
                            }
                        var u = r[e];
                        return r[e] = l, a.languages.DFS(a.languages, (function(n, t) {
                            t === u && n != e && (this[n] = l)
                        })), l
                    },
                    DFS: function e(n, t, r, i) {
                        i = i || {};
                        var l = a.util.objId;
                        for (var o in n)
                            if (n.hasOwnProperty(o)) {
                                t.call(n, o, n[o], r || o);
                                var s = n[o],
                                    u = a.util.type(s);
                                "Object" !== u || i[l(s)] ? "Array" !== u || i[l(s)] || (i[l(s)] = !0, e(s, t, o, i)) : (i[l(s)] = !0, e(s, t, null, i))
                            }
                    }
                },
                plugins: {},
                highlightAll: function(e, n) {
                    a.highlightAllUnder(document, e, n)
                },
                highlightAllUnder: function(e, n, t) {
                    var r = {
                        callback: t,
                        container: e,
                        selector: 'code[class*="language-"], [class*="language-"] code, code[class*="lang-"], [class*="lang-"] code'
                    };
                    a.hooks.run("before-highlightall", r), r.elements = Array.prototype.slice.apply(r.container.querySelectorAll(r.selector)), a.hooks.run("before-all-elements-highlight", r);
                    for (var i, l = 0; i = r.elements[l++];) a.highlightElement(i, !0 === n, r.callback)
                },
                highlightElement: function(n, t, r) {
                    var i = a.util.getLanguage(n),
                        l = a.languages[i];
                    a.util.setLanguage(n, i);
                    var o = n.parentElement;
                    o && "pre" === o.nodeName.toLowerCase() && a.util.setLanguage(o, i);
                    var s = {
                        element: n,
                        language: i,
                        grammar: l,
                        code: n.textContent
                    };

                    function u(e) {
                        s.highlightedCode = e, a.hooks.run("before-insert", s), s.element.innerHTML = s.highlightedCode, a.hooks.run("after-highlight", s), a.hooks.run("complete", s), r && r.call(s.element)
                    }
                    if (a.hooks.run("before-sanity-check", s), (o = s.element.parentElement) && "pre" === o.nodeName.toLowerCase() && !o.hasAttribute("tabindex") && o.setAttribute("tabindex", "0"), !s.code) return a.hooks.run("complete", s), void(r && r.call(s.element));
                    if (a.hooks.run("before-highlight", s), s.grammar)
                        if (t && e.Worker) {
                            var c = new Worker(a.filename);
                            c.onmessage = function(e) {
                                u(e.data)
                            }, c.postMessage(JSON.stringify({
                                language: s.language,
                                code: s.code,
                                immediateClose: !0
                            }))
                        } else u(a.highlight(s.code, s.grammar, s.language));
                    else u(a.util.encode(s.code))
                },
                highlight: function(e, n, t) {
                    var r = {
                        code: e,
                        grammar: n,
                        language: t
                    };
                    if (a.hooks.run("before-tokenize", r), !r.grammar) throw new Error('The language "' + r.language + '" has no grammar.');
                    return r.tokens = a.tokenize(r.code, r.grammar), a.hooks.run("after-tokenize", r), i.stringify(a.util.encode(r.tokens), r.language)
                },
                tokenize: function(e, n) {
                    var t = n.rest;
                    if (t) {
                        for (var r in t) n[r] = t[r];
                        delete n.rest
                    }
                    var a = new s;
                    return u(a, a.head, e), o(e, a, n, a.head, 0),
                        function(e) {
                            for (var n = [], t = e.head.next; t !== e.tail;) n.push(t.value), t = t.next;
                            return n
                        }(a)
                },
                hooks: {
                    all: {},
                    add: function(e, n) {
                        var t = a.hooks.all;
                        t[e] = t[e] || [], t[e].push(n)
                    },
                    run: function(e, n) {
                        var t = a.hooks.all[e];
                        if (t && t.length)
                            for (var r, i = 0; r = t[i++];) r(n)
                    }
                },
                Token: i
            };

        function i(e, n, t, r) {
            this.type = e, this.content = n, this.alias = t, this.length = 0 | (r || "").length
        }

        function l(e, n, t, r) {
            e.lastIndex = n;
            var a = e.exec(t);
            if (a && r && a[1]) {
                var i = a[1].length;
                a.index += i, a[0] = a[0].slice(i)
            }
            return a
        }

        function o(e, n, t, r, s, g) {
            for (var f in t)
                if (t.hasOwnProperty(f) && t[f]) {
                    var h = t[f];
                    h = Array.isArray(h) ? h : [h];
                    for (var d = 0; d < h.length; ++d) {
                        if (g && g.cause == f + "," + d) return;
                        var v = h[d],
                            p = v.inside,
                            m = !!v.lookbehind,
                            y = !!v.greedy,
                            k = v.alias;
                        if (y && !v.pattern.global) {
                            var x = v.pattern.toString().match(/[imsuy]*$/)[0];
                            v.pattern = RegExp(v.pattern.source, x + "g")
                        }
                        for (var b = v.pattern || v, w = r.next, A = s; w !== n.tail && !(g && A >= g.reach); A += w.value.length, w = w.next) {
                            var E = w.value;
                            if (n.length > e.length) return;
                            if (!(E instanceof i)) {
                                var P, L = 1;
                                if (y) {
                                    if (!(P = l(b, A, e, m)) || P.index >= e.length) break;
                                    var S = P.index,
                                        O = P.index + P[0].length,
                                        j = A;
                                    for (j += w.value.length; S >= j;) j += (w = w.next).value.length;
                                    if (A = j -= w.value.length, w.value instanceof i) continue;
                                    for (var C = w; C !== n.tail && (j < O || "string" == typeof C.value); C = C.next) L++, j += C.value.length;
                                    L--, E = e.slice(A, j), P.index -= A
                                } else if (!(P = l(b, 0, E, m))) continue;
                                S = P.index;
                                var N = P[0],
                                    _ = E.slice(0, S),
                                    M = E.slice(S + N.length),
                                    W = A + E.length;
                                g && W > g.reach && (g.reach = W);
                                var z = w.prev;
                                if (_ && (z = u(n, z, _), A += _.length), c(n, z, L), w = u(n, z, new i(f, p ? a.tokenize(N, p) : N, k, N)), M && u(n, w, M), L > 1) {
                                    var I = {
                                        cause: f + "," + d,
                                        reach: W
                                    };
                                    o(e, n, t, w.prev, A, I), g && I.reach > g.reach && (g.reach = I.reach)
                                }
                            }
                        }
                    }
                }
        }

        function s() {
            var e = {
                    value: null,
                    prev: null,
                    next: null
                },
                n = {
                    value: null,
                    prev: e,
                    next: null
                };
            e.next = n, this.head = e, this.tail = n, this.length = 0
        }

        function u(e, n, t) {
            var r = n.next,
                a = {
                    value: t,
                    prev: n,
                    next: r
                };
            return n.next = a, r.prev = a, e.length++, a
        }

        function c(e, n, t) {
            for (var r = n.next, a = 0; a < t && r !== e.tail; a++) r = r.next;
            n.next = r, r.prev = n, e.length -= a
        }
        if (e.Prism = a, i.stringify = function e(n, t) {
                if ("string" == typeof n) return n;
                if (Array.isArray(n)) {
                    var r = "";
                    return n.forEach((function(n) {
                        r += e(n, t)
                    })), r
                }
                var i = {
                        type: n.type,
                        content: e(n.content, t),
                        tag: "span",
                        classes: ["token", n.type],
                        attributes: {},
                        language: t
                    },
                    l = n.alias;
                l && (Array.isArray(l) ? Array.prototype.push.apply(i.classes, l) : i.classes.push(l)), a.hooks.run("wrap", i);
                var o = "";
                for (var s in i.attributes) o += " " + s + '="' + (i.attributes[s] || "").replace(/"/g, "&quot;") + '"';
                return "<" + i.tag + ' class="' + i.classes.join(" ") + '"' + o + ">" + i.content + "</" + i.tag + ">"
            }, !e.document) return e.addEventListener ? (a.disableWorkerMessageHandler || e.addEventListener("message", (function(n) {
            var t = JSON.parse(n.data),
                r = t.language,
                i = t.code,
                l = t.immediateClose;
            e.postMessage(a.highlight(i, a.languages[r], r)), l && e.close()
        }), !1), a) : a;
        var g = a.util.currentScript();

        function f() {
            a.manual || a.highlightAll()
        }
        if (g && (a.filename = g.src, g.hasAttribute("data-manual") && (a.manual = !0)), !a.manual) {
            var h = document.readyState;
            "loading" === h || "interactive" === h && g && g.defer ? document.addEventListener("DOMContentLoaded", f) : window.requestAnimationFrame ? window.requestAnimationFrame(f) : window.setTimeout(f, 16)
        }
        return a
    }(_self);
"undefined" != typeof module && module.exports && (module.exports = Prism), "undefined" != typeof global && (global.Prism = Prism);
Prism.languages.markup = {
    comment: {
        pattern: /<!--(?:(?!<!--)[\s\S])*?-->/,
        greedy: !0
    },
    prolog: {
        pattern: /<\?[\s\S]+?\?>/,
        greedy: !0
    },
    doctype: {
        pattern: /<!DOCTYPE(?:[^>"'[\]]|"[^"]*"|'[^']*')+(?:\[(?:[^<"'\]]|"[^"]*"|'[^']*'|<(?!!--)|<!--(?:[^-]|-(?!->))*-->)*\]\s*)?>/i,
        greedy: !0,
        inside: {
            "internal-subset": {
                pattern: /(^[^\[]*\[)[\s\S]+(?=\]>$)/,
                lookbehind: !0,
                greedy: !0,
                inside: null
            },
            string: {
                pattern: /"[^"]*"|'[^']*'/,
                greedy: !0
            },
            punctuation: /^<!|>$|[[\]]/,
            "doctype-tag": /^DOCTYPE/i,
            name: /[^\s<>'"]+/
        }
    },
    cdata: {
        pattern: /<!\[CDATA\[[\s\S]*?\]\]>/i,
        greedy: !0
    },
    tag: {
        pattern: /<\/?(?!\d)[^\s>\/=$<%]+(?:\s(?:\s*[^\s>\/=]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+(?=[\s>]))|(?=[\s/>])))+)?\s*\/?>/,
        greedy: !0,
        inside: {
            tag: {
                pattern: /^<\/?[^\s>\/]+/,
                inside: {
                    punctuation: /^<\/?/,
                    namespace: /^[^\s>\/:]+:/
                }
            },
            "special-attr": [],
            "attr-value": {
                pattern: /=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+)/,
                inside: {
                    punctuation: [{
                        pattern: /^=/,
                        alias: "attr-equals"
                    }, {
                        pattern: /^(\s*)["']|["']$/,
                        lookbehind: !0
                    }]
                }
            },
            punctuation: /\/?>/,
            "attr-name": {
                pattern: /[^\s>\/]+/,
                inside: {
                    namespace: /^[^\s>\/:]+:/
                }
            }
        }
    },
    entity: [{
        pattern: /&[\da-z]{1,8};/i,
        alias: "named-entity"
    }, /&#x?[\da-f]{1,8};/i]
}, Prism.languages.markup.tag.inside["attr-value"].inside.entity = Prism.languages.markup.entity, Prism.languages.markup.doctype.inside["internal-subset"].inside = Prism.languages.markup, Prism.hooks.add("wrap", (function(a) {
    "entity" === a.type && (a.attributes.title = a.content.replace(/&amp;/, "&"))
})), Object.defineProperty(Prism.languages.markup.tag, "addInlined", {
    value: function(a, e) {
        var s = {};
        s["language-" + e] = {
            pattern: /(^<!\[CDATA\[)[\s\S]+?(?=\]\]>$)/i,
            lookbehind: !0,
            inside: Prism.languages[e]
        }, s.cdata = /^<!\[CDATA\[|\]\]>$/i;
        var t = {
            "included-cdata": {
                pattern: /<!\[CDATA\[[\s\S]*?\]\]>/i,
                inside: s
            }
        };
        t["language-" + e] = {
            pattern: /[\s\S]+/,
            inside: Prism.languages[e]
        };
        var n = {};
        n[a] = {
            pattern: RegExp("(<__[^>]*>)(?:<!\\[CDATA\\[(?:[^\\]]|\\](?!\\]>))*\\]\\]>|(?!<!\\[CDATA\\[)[^])*?(?=</__>)".replace(/__/g, (function() {
                return a
            })), "i"),
            lookbehind: !0,
            greedy: !0,
            inside: t
        }, Prism.languages.insertBefore("markup", "cdata", n)
    }
}), Object.defineProperty(Prism.languages.markup.tag, "addAttribute", {
    value: function(a, e) {
        Prism.languages.markup.tag.inside["special-attr"].push({
            pattern: RegExp("(^|[\"'\\s])(?:" + a + ")\\s*=\\s*(?:\"[^\"]*\"|'[^']*'|[^\\s'\">=]+(?=[\\s>]))", "i"),
            lookbehind: !0,
            inside: {
                "attr-name": /^[^\s=]+/,
                "attr-value": {
                    pattern: /=[\s\S]+/,
                    inside: {
                        value: {
                            pattern: /(^=\s*(["']|(?!["'])))\S[\s\S]*(?=\2$)/,
                            lookbehind: !0,
                            alias: [e, "language-" + e],
                            inside: Prism.languages[e]
                        },
                        punctuation: [{
                            pattern: /^=/,
                            alias: "attr-equals"
                        }, /"|'/]
                    }
                }
            }
        })
    }
}), Prism.languages.html = Prism.languages.markup, Prism.languages.mathml = Prism.languages.markup, Prism.languages.svg = Prism.languages.markup, Prism.languages.xml = Prism.languages.extend("markup", {}), Prism.languages.ssml = Prism.languages.xml, Prism.languages.atom = Prism.languages.xml, Prism.languages.rss = Prism.languages.xml;
! function(s) {
    var e = /(?:"(?:\\(?:\r\n|[\s\S])|[^"\\\r\n])*"|'(?:\\(?:\r\n|[\s\S])|[^'\\\r\n])*')/;
    s.languages.css = {
        comment: /\/\*[\s\S]*?\*\//,
        atrule: {
            pattern: RegExp("@[\\w-](?:[^;{\\s\"']|\\s+(?!\\s)|" + e.source + ")*?(?:;|(?=\\s*\\{))"),
            inside: {
                rule: /^@[\w-]+/,
                "selector-function-argument": {
                    pattern: /(\bselector\s*\(\s*(?![\s)]))(?:[^()\s]|\s+(?![\s)])|\((?:[^()]|\([^()]*\))*\))+(?=\s*\))/,
                    lookbehind: !0,
                    alias: "selector"
                },
                keyword: {
                    pattern: /(^|[^\w-])(?:and|not|only|or)(?![\w-])/,
                    lookbehind: !0
                }
            }
        },
        url: {
            pattern: RegExp("\\burl\\((?:" + e.source + "|(?:[^\\\\\r\n()\"']|\\\\[^])*)\\)", "i"),
            greedy: !0,
            inside: {
                function: /^url/i,
                punctuation: /^\(|\)$/,
                string: {
                    pattern: RegExp("^" + e.source + "$"),
                    alias: "url"
                }
            }
        },
        selector: {
            pattern: RegExp("(^|[{}\\s])[^{}\\s](?:[^{};\"'\\s]|\\s+(?![\\s{])|" + e.source + ")*(?=\\s*\\{)"),
            lookbehind: !0
        },
        string: {
            pattern: e,
            greedy: !0
        },
        property: {
            pattern: /(^|[^-\w\xA0-\uFFFF])(?!\s)[-_a-z\xA0-\uFFFF](?:(?!\s)[-\w\xA0-\uFFFF])*(?=\s*:)/i,
            lookbehind: !0
        },
        important: /!important\b/i,
        function: {
            pattern: /(^|[^-a-z0-9])[-a-z0-9]+(?=\()/i,
            lookbehind: !0
        },
        punctuation: /[(){};:,]/
    }, s.languages.css.atrule.inside.rest = s.languages.css;
    var t = s.languages.markup;
    t && (t.tag.addInlined("style", "css"), t.tag.addAttribute("style", "css"))
}(Prism);
Prism.languages.clike = {
    comment: [{
        pattern: /(^|[^\\])\/\*[\s\S]*?(?:\*\/|$)/,
        lookbehind: !0,
        greedy: !0
    }, {
        pattern: /(^|[^\\:])\/\/.*/,
        lookbehind: !0,
        greedy: !0
    }],
    string: {
        pattern: /(["'])(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/,
        greedy: !0
    },
    "class-name": {
        pattern: /(\b(?:class|extends|implements|instanceof|interface|new|trait)\s+|\bcatch\s+\()[\w.\\]+/i,
        lookbehind: !0,
        inside: {
            punctuation: /[.\\]/
        }
    },
    keyword: /\b(?:break|catch|continue|do|else|finally|for|function|if|in|instanceof|new|null|return|throw|try|while)\b/,
    boolean: /\b(?:false|true)\b/,
    function: /\b\w+(?=\()/,
    number: /\b0x[\da-f]+\b|(?:\b\d+(?:\.\d*)?|\B\.\d+)(?:e[+-]?\d+)?/i,
    operator: /[<>]=?|[!=]=?=?|--?|\+\+?|&&?|\|\|?|[?*/~^%]/,
    punctuation: /[{}[\];(),.:]/
};
Prism.languages.javascript = Prism.languages.extend("clike", {
    "class-name": [Prism.languages.clike["class-name"], {
        pattern: /(^|[^$\w\xA0-\uFFFF])(?!\s)[_$A-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\.(?:constructor|prototype))/,
        lookbehind: !0
    }],
    keyword: [{
        pattern: /((?:^|\})\s*)catch\b/,
        lookbehind: !0
    }, {
        pattern: /(^|[^.]|\.\.\.\s*)\b(?:as|assert(?=\s*\{)|async(?=\s*(?:function\b|\(|[$\w\xA0-\uFFFF]|$))|await|break|case|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally(?=\s*(?:\{|$))|for|from(?=\s*(?:['"]|$))|function|(?:get|set)(?=\s*(?:[#\[$\w\xA0-\uFFFF]|$))|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)\b/,
        lookbehind: !0
    }],
    function: /#?(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*(?:\.\s*(?:apply|bind|call)\s*)?\()/,
    number: {
        pattern: RegExp("(^|[^\\w$])(?:NaN|Infinity|0[bB][01]+(?:_[01]+)*n?|0[oO][0-7]+(?:_[0-7]+)*n?|0[xX][\\dA-Fa-f]+(?:_[\\dA-Fa-f]+)*n?|\\d+(?:_\\d+)*n|(?:\\d+(?:_\\d+)*(?:\\.(?:\\d+(?:_\\d+)*)?)?|\\.\\d+(?:_\\d+)*)(?:[Ee][+-]?\\d+(?:_\\d+)*)?)(?![\\w$])"),
        lookbehind: !0
    },
    operator: /--|\+\+|\*\*=?|=>|&&=?|\|\|=?|[!=]==|<<=?|>>>?=?|[-+*/%&|^!=<>]=?|\.{3}|\?\?=?|\?\.?|[~:]/
}), Prism.languages.javascript["class-name"][0].pattern = /(\b(?:class|extends|implements|instanceof|interface|new)\s+)[\w.\\]+/, Prism.languages.insertBefore("javascript", "keyword", {
    regex: {
        pattern: RegExp("((?:^|[^$\\w\\xA0-\\uFFFF.\"'\\])\\s]|\\b(?:return|yield))\\s*)/(?:(?:\\[(?:[^\\]\\\\\r\n]|\\\\.)*\\]|\\\\.|[^/\\\\\\[\r\n])+/[dgimyus]{0,7}|(?:\\[(?:[^[\\]\\\\\r\n]|\\\\.|\\[(?:[^[\\]\\\\\r\n]|\\\\.|\\[(?:[^[\\]\\\\\r\n]|\\\\.)*\\])*\\])*\\]|\\\\.|[^/\\\\\\[\r\n])+/[dgimyus]{0,7}v[dgimyus]{0,7})(?=(?:\\s|/\\*(?:[^*]|\\*(?!/))*\\*/)*(?:$|[\r\n,.;:})\\]]|//))"),
        lookbehind: !0,
        greedy: !0,
        inside: {
            "regex-source": {
                pattern: /^(\/)[\s\S]+(?=\/[a-z]*$)/,
                lookbehind: !0,
                alias: "language-regex",
                inside: Prism.languages.regex
            },
            "regex-delimiter": /^\/|\/$/,
            "regex-flags": /^[a-z]+$/
        }
    },
    "function-variable": {
        pattern: /#?(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*[=:]\s*(?:async\s*)?(?:\bfunction\b|(?:\((?:[^()]|\([^()]*\))*\)|(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*)\s*=>))/,
        alias: "function"
    },
    parameter: [{
        pattern: /(function(?:\s+(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*)?\s*\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\))/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }, {
        pattern: /(^|[^$\w\xA0-\uFFFF])(?!\s)[_$a-z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*=>)/i,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }, {
        pattern: /(\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\)\s*=>)/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }, {
        pattern: /((?:\b|\s|^)(?!(?:as|async|await|break|case|catch|class|const|continue|debugger|default|delete|do|else|enum|export|extends|finally|for|from|function|get|if|implements|import|in|instanceof|interface|let|new|null|of|package|private|protected|public|return|set|static|super|switch|this|throw|try|typeof|undefined|var|void|while|with|yield)(?![$\w\xA0-\uFFFF]))(?:(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*\s*)\(\s*|\]\s*\(\s*)(?!\s)(?:[^()\s]|\s+(?![\s)])|\([^()]*\))+(?=\s*\)\s*\{)/,
        lookbehind: !0,
        inside: Prism.languages.javascript
    }],
    constant: /\b[A-Z](?:[A-Z_]|\dx?)*\b/
}), Prism.languages.insertBefore("javascript", "string", {
    hashbang: {
        pattern: /^#!.*/,
        greedy: !0,
        alias: "comment"
    },
    "template-string": {
        pattern: /`(?:\\[\s\S]|\$\{(?:[^{}]|\{(?:[^{}]|\{[^}]*\})*\})+\}|(?!\$\{)[^\\`])*`/,
        greedy: !0,
        inside: {
            "template-punctuation": {
                pattern: /^`|`$/,
                alias: "string"
            },
            interpolation: {
                pattern: /((?:^|[^\\])(?:\\{2})*)\$\{(?:[^{}]|\{(?:[^{}]|\{[^}]*\})*\})+\}/,
                lookbehind: !0,
                inside: {
                    "interpolation-punctuation": {
                        pattern: /^\$\{|\}$/,
                        alias: "punctuation"
                    },
                    rest: Prism.languages.javascript
                }
            },
            string: /[\s\S]+/
        }
    },
    "string-property": {
        pattern: /((?:^|[,{])[ \t]*)(["'])(?:\\(?:\r\n|[\s\S])|(?!\2)[^\\\r\n])*\2(?=\s*:)/m,
        lookbehind: !0,
        greedy: !0,
        alias: "property"
    }
}), Prism.languages.insertBefore("javascript", "operator", {
    "literal-property": {
        pattern: /((?:^|[,{])[ \t]*)(?!\s)[_$a-zA-Z\xA0-\uFFFF](?:(?!\s)[$\w\xA0-\uFFFF])*(?=\s*:)/m,
        lookbehind: !0,
        alias: "property"
    }
}), Prism.languages.markup && (Prism.languages.markup.tag.addInlined("script", "javascript"), Prism.languages.markup.tag.addAttribute("on(?:abort|blur|change|click|composition(?:end|start|update)|dblclick|error|focus(?:in|out)?|key(?:down|up)|load|mouse(?:down|enter|leave|move|out|over|up)|reset|resize|scroll|select|slotchange|submit|unload|wheel)", "javascript")), Prism.languages.js = Prism.languages.javascript;
! function(e) {
    var a, n = /("|')(?:\\(?:\r\n|[\s\S])|(?!\1)[^\\\r\n])*\1/;
    e.languages.css.selector = {
        pattern: e.languages.css.selector.pattern,
        lookbehind: !0,
        inside: a = {
            "pseudo-element": /:(?:after|before|first-letter|first-line|selection)|::[-\w]+/,
            "pseudo-class": /:[-\w]+/,
            class: /\.[-\w]+/,
            id: /#[-\w]+/,
            attribute: {
                pattern: RegExp("\\[(?:[^[\\]\"']|" + n.source + ")*\\]"),
                greedy: !0,
                inside: {
                    punctuation: /^\[|\]$/,
                    "case-sensitivity": {
                        pattern: /(\s)[si]$/i,
                        lookbehind: !0,
                        alias: "keyword"
                    },
                    namespace: {
                        pattern: /^(\s*)(?:(?!\s)[-*\w\xA0-\uFFFF])*\|(?!=)/,
                        lookbehind: !0,
                        inside: {
                            punctuation: /\|$/
                        }
                    },
                    "attr-name": {
                        pattern: /^(\s*)(?:(?!\s)[-\w\xA0-\uFFFF])+/,
                        lookbehind: !0
                    },
                    "attr-value": [n, {
                        pattern: /(=\s*)(?:(?!\s)[-\w\xA0-\uFFFF])+(?=\s*$)/,
                        lookbehind: !0
                    }],
                    operator: /[|~*^$]?=/
                }
            },
            "n-th": [{
                pattern: /(\(\s*)[+-]?\d*[\dn](?:\s*[+-]\s*\d+)?(?=\s*\))/,
                lookbehind: !0,
                inside: {
                    number: /[\dn]+/,
                    operator: /[+-]/
                }
            }, {
                pattern: /(\(\s*)(?:even|odd)(?=\s*\))/i,
                lookbehind: !0
            }],
            combinator: />|\+|~|\|\|/,
            punctuation: /[(),]/
        }
    }, e.languages.css.atrule.inside["selector-function-argument"].inside = a, e.languages.insertBefore("css", "property", {
        variable: {
            pattern: /(^|[^-\w\xA0-\uFFFF])--(?!\s)[-_a-z\xA0-\uFFFF](?:(?!\s)[-\w\xA0-\uFFFF])*/i,
            lookbehind: !0
        }
    });
    var r = {
            pattern: /(\b\d+)(?:%|[a-z]+(?![\w-]))/,
            lookbehind: !0
        },
        i = {
            pattern: /(^|[^\w.-])-?(?:\d+(?:\.\d+)?|\.\d+)/,
            lookbehind: !0
        };
    e.languages.insertBefore("css", "function", {
        operator: {
            pattern: /(\s)[+\-*\/](?=\s)/,
            lookbehind: !0
        },
        hexcode: {
            pattern: /\B#[\da-f]{3,8}\b/i,
            alias: "color"
        },
        color: [{
            pattern: /(^|[^\w-])(?:AliceBlue|AntiqueWhite|Aqua|Aquamarine|Azure|Beige|Bisque|Black|BlanchedAlmond|Blue|BlueViolet|Brown|BurlyWood|CadetBlue|Chartreuse|Chocolate|Coral|CornflowerBlue|Cornsilk|Crimson|Cyan|DarkBlue|DarkCyan|DarkGoldenRod|DarkGr[ae]y|DarkGreen|DarkKhaki|DarkMagenta|DarkOliveGreen|DarkOrange|DarkOrchid|DarkRed|DarkSalmon|DarkSeaGreen|DarkSlateBlue|DarkSlateGr[ae]y|DarkTurquoise|DarkViolet|DeepPink|DeepSkyBlue|DimGr[ae]y|DodgerBlue|FireBrick|FloralWhite|ForestGreen|Fuchsia|Gainsboro|GhostWhite|Gold|GoldenRod|Gr[ae]y|Green|GreenYellow|HoneyDew|HotPink|IndianRed|Indigo|Ivory|Khaki|Lavender|LavenderBlush|LawnGreen|LemonChiffon|LightBlue|LightCoral|LightCyan|LightGoldenRodYellow|LightGr[ae]y|LightGreen|LightPink|LightSalmon|LightSeaGreen|LightSkyBlue|LightSlateGr[ae]y|LightSteelBlue|LightYellow|Lime|LimeGreen|Linen|Magenta|Maroon|MediumAquaMarine|MediumBlue|MediumOrchid|MediumPurple|MediumSeaGreen|MediumSlateBlue|MediumSpringGreen|MediumTurquoise|MediumVioletRed|MidnightBlue|MintCream|MistyRose|Moccasin|NavajoWhite|Navy|OldLace|Olive|OliveDrab|Orange|OrangeRed|Orchid|PaleGoldenRod|PaleGreen|PaleTurquoise|PaleVioletRed|PapayaWhip|PeachPuff|Peru|Pink|Plum|PowderBlue|Purple|RebeccaPurple|Red|RosyBrown|RoyalBlue|SaddleBrown|Salmon|SandyBrown|SeaGreen|SeaShell|Sienna|Silver|SkyBlue|SlateBlue|SlateGr[ae]y|Snow|SpringGreen|SteelBlue|Tan|Teal|Thistle|Tomato|Transparent|Turquoise|Violet|Wheat|White|WhiteSmoke|Yellow|YellowGreen)(?![\w-])/i,
            lookbehind: !0
        }, {
            pattern: /\b(?:hsl|rgb)\(\s*\d{1,3}\s*,\s*\d{1,3}%?\s*,\s*\d{1,3}%?\s*\)\B|\b(?:hsl|rgb)a\(\s*\d{1,3}\s*,\s*\d{1,3}%?\s*,\s*\d{1,3}%?\s*,\s*(?:0|0?\.\d+|1)\s*\)\B/i,
            inside: {
                unit: r,
                number: i,
                function: /[\w-]+(?=\()/,
                punctuation: /[(),]/
            }
        }],
        entity: /\\[\da-f]{1,8}/i,
        unit: r,
        number: i
    })
}(Prism);
! function() {
    if ("undefined" != typeof Prism && "undefined" != typeof document) {
        var e = "line-numbers",
            n = /\n(?!$)/g,
            t = Prism.plugins.lineNumbers = {
                getLine: function(n, t) {
                    if ("PRE" === n.tagName && n.classList.contains(e)) {
                        var i = n.querySelector(".line-numbers-rows");
                        if (i) {
                            var r = parseInt(n.getAttribute("data-start"), 10) || 1,
                                s = r + (i.children.length - 1);
                            t < r && (t = r), t > s && (t = s);
                            var l = t - r;
                            return i.children[l]
                        }
                    }
                },
                resize: function(e) {
                    r([e])
                },
                assumeViewportIndependence: !0
            },
            i = void 0;
        window.addEventListener("resize", (function() {
            t.assumeViewportIndependence && i === window.innerWidth || (i = window.innerWidth, r(Array.prototype.slice.call(document.querySelectorAll("pre.line-numbers"))))
        })), Prism.hooks.add("complete", (function(t) {
            if (t.code) {
                var i = t.element,
                    s = i.parentNode;
                if (s && /pre/i.test(s.nodeName) && !i.querySelector(".line-numbers-rows") && Prism.util.isActive(i, e)) {
                    i.classList.remove(e), s.classList.add(e);
                    var l, o = t.code.match(n),
                        a = o ? o.length + 1 : 1,
                        u = new Array(a + 1).join("<span></span>");
                    (l = document.createElement("span")).setAttribute("aria-hidden", "true"), l.className = "line-numbers-rows", l.innerHTML = u, s.hasAttribute("data-start") && (s.style.counterReset = "linenumber " + (parseInt(s.getAttribute("data-start"), 10) - 1)), t.element.appendChild(l), r([s]), Prism.hooks.run("line-numbers", t)
                }
            }
        })), Prism.hooks.add("line-numbers", (function(e) {
            e.plugins = e.plugins || {}, e.plugins.lineNumbers = !0
        }))
    }

    function r(e) {
        if (0 != (e = e.filter((function(e) {
                var n, t = (n = e, n ? window.getComputedStyle ? getComputedStyle(n) : n.currentStyle || null : null)["white-space"];
                return "pre-wrap" === t || "pre-line" === t
            }))).length) {
            var t = e.map((function(e) {
                var t = e.querySelector("code"),
                    i = e.querySelector(".line-numbers-rows");
                if (t && i) {
                    var r = e.querySelector(".line-numbers-sizer"),
                        s = t.textContent.split(n);
                    r || ((r = document.createElement("span")).className = "line-numbers-sizer", t.appendChild(r)), r.innerHTML = "0", r.style.display = "block";
                    var l = r.getBoundingClientRect().height;
                    return r.innerHTML = "", {
                        element: e,
                        lines: s,
                        lineHeights: [],
                        oneLinerHeight: l,
                        sizer: r
                    }
                }
            })).filter(Boolean);
            t.forEach((function(e) {
                var n = e.sizer,
                    t = e.lines,
                    i = e.lineHeights,
                    r = e.oneLinerHeight;
                i[t.length - 1] = void 0, t.forEach((function(e, t) {
                    if (e && e.length > 1) {
                        var s = n.appendChild(document.createElement("span"));
                        s.style.display = "block", s.textContent = e
                    } else i[t] = r
                }))
            })), t.forEach((function(e) {
                for (var n = e.sizer, t = e.lineHeights, i = 0, r = 0; r < t.length; r++) void 0 === t[r] && (t[r] = n.children[i++].getBoundingClientRect().height)
            })), t.forEach((function(e) {
                var n = e.sizer,
                    t = e.element.querySelector(".line-numbers-rows");
                n.style.display = "none", n.innerHTML = "", e.lineHeights.forEach((function(e, n) {
                    t.children[n].style.height = e + "px"
                }))
            }))
        }
    }
}();
! function() {
    if ("undefined" != typeof Prism && "undefined" != typeof document) {
        var n = /<\/?(?!\d)[^\s>\/=$<%]+(?:\s(?:\s*[^\s>\/=]+(?:\s*=\s*(?:"[^"]*"|'[^']*'|[^\s'">=]+(?=[\s>]))|(?=[\s/>])))+)?\s*\/?>/g,
            r = /^#?((?:[\da-f]){3,4}|(?:[\da-f]{2}){3,4})$/i,
            o = [function(n) {
                var o = r.exec(n);
                if (o) {
                    for (var s = (n = o[1]).length >= 6 ? 2 : 1, e = n.length / s, t = 1 == s ? 1 / 15 : 1 / 255, i = [], a = 0; a < e; a++) {
                        var c = parseInt(n.substr(a * s, s), 16);
                        i.push(c * t)
                    }
                    return 3 == e && i.push(1), "rgba(" + i.slice(0, 3).map((function(n) {
                        return String(Math.round(255 * n))
                    })).join(",") + "," + String(Number(i[3].toFixed(3))) + ")"
                }
            }, function(n) {
                var r = (new Option).style;
                return r.color = n, r.color ? n : void 0
            }];
        Prism.hooks.add("wrap", (function(r) {
            if ("color" === r.type || r.classes.indexOf("color") >= 0) {
                for (var s, e = r.content, t = e.split(n).join(""), i = 0, a = o.length; i < a && !s; i++) s = o[i](t);
                if (!s) return;
                var c = '<span class="inline-color-wrapper"><span class="inline-color" style="background-color:' + s + ';"></span></span>';
                r.content = c + e
            }
        }))
    }
}();
! function() {
    if ("undefined" != typeof Prism && "undefined" != typeof document) {
        var e = /(?:^|\s)command-line(?:\s|$)/,
            t = "command-line-prompt",
            n = "".startsWith ? function(e, t) {
                return e.startsWith(t)
            } : function(e, t) {
                return 0 === e.indexOf(t)
            },
            a = "".endsWith ? function(e, t) {
                return e.endsWith(t)
            } : function(e, t) {
                var n = e.length;
                return e.substring(n - t.length, n) === t
            };
        Prism.hooks.add("before-highlight", (function(i) {
            var o = r(i);
            if (!o.complete && i.code) {
                var s = i.element.parentElement;
                if (s && /pre/i.test(s.nodeName) && (e.test(s.className) || e.test(i.element.className))) {
                    var l = i.element.querySelector("." + t);
                    l && l.remove();
                    var m = i.code.split("\n");
                    o.numberOfLines = m.length;
                    var u = o.outputLines = [],
                        c = s.getAttribute("data-output"),
                        d = s.getAttribute("data-filter-output");
                    if (null !== c) c.split(",").forEach((function(e) {
                        var t = e.split("-"),
                            n = parseInt(t[0], 10),
                            a = 2 === t.length ? parseInt(t[1], 10) : n;
                        if (!isNaN(n) && !isNaN(a)) {
                            n < 1 && (n = 1), a > m.length && (a = m.length), a--;
                            for (var r = --n; r <= a; r++) u[r] = m[r], m[r] = ""
                        }
                    }));
                    else if (d)
                        for (var p = 0; p < m.length; p++) n(m[p], d) && (u[p] = m[p].slice(d.length), m[p] = "");
                    for (var f = o.continuationLineIndicies = new Set, h = s.getAttribute("data-continuation-str"), v = s.getAttribute("data-filter-continuation"), g = 0; g < m.length; g++) {
                        var b = m[g];
                        b && (h && a(b, h) && f.add(g + 1), g > 0 && v && n(b, v) && (m[g] = b.slice(v.length), f.add(g)))
                    }
                    i.code = m.join("\n")
                } else o.complete = !0
            } else o.complete = !0
        })), Prism.hooks.add("before-insert", (function(e) {
            var t = r(e);
            if (!t.complete) {
                for (var n = e.highlightedCode.split("\n"), a = t.outputLines || [], i = 0, o = n.length; i < o; i++) a.hasOwnProperty(i) ? n[i] = '<span class="token output">' + Prism.util.encode(a[i]) + "</span>" : n[i] = '<span class="token command">' + n[i] + "</span>";
                e.highlightedCode = n.join("\n")
            }
        })), Prism.hooks.add("complete", (function(n) {
            if (function(e) {
                    return "command-line" in (e.vars = e.vars || {})
                }(n)) {
                var a = r(n);
                if (!a.complete) {
                    var i = n.element.parentElement;
                    e.test(n.element.className) && (n.element.className = n.element.className.replace(e, " ")), e.test(i.className) || (i.className += " command-line");
                    var o, s = "",
                        l = a.numberOfLines || 0,
                        m = b("data-prompt", "");
                    o = "" !== m ? '<span data-prompt="' + m + '"></span>' : '<span data-user="' + b("data-user", "user") + '" data-host="' + b("data-host", "localhost") + '"></span>';
                    for (var u = a.continuationLineIndicies || new Set, c = '<span data-continuation-prompt="' + b("data-continuation-prompt", ">") + '"></span>', d = 0; d < l; d++) u.has(d) ? s += c : s += o;
                    var p = document.createElement("span");
                    p.className = t, p.innerHTML = s;
                    for (var f = a.outputLines || [], h = 0, v = f.length; h < v; h++)
                        if (f.hasOwnProperty(h)) {
                            var g = p.children[h];
                            g.removeAttribute("data-user"), g.removeAttribute("data-host"), g.removeAttribute("data-prompt")
                        }
                    n.element.insertBefore(p, n.element.firstChild), a.complete = !0
                }
            }

            function b(e, t) {
                return (i.getAttribute(e) || t).replace(/"/g, "&quot")
            }
        }))
    }

    function r(e) {
        var t = e.vars = e.vars || {};
        return t["command-line"] = t["command-line"] || {}
    }
}();