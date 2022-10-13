@if (config('app.env') === 'production')
<script>
    (function(w, d, s, l, i) {
        w[l] = w[l] || [];
        w[l].push({
            'gtm.start': new Date().getTime()
            , event: 'gtm.js'
        });
        var f = d.getElementsByTagName(s)[0]
            , j = d.createElement(s)
            , dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-T4SJPW7');

</script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XB7PG0P5TG"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'G-XB7PG0P5TG');

</script>
<script src="https://www.googleoptimize.com/optimize.js?id=OPT-5F792S9"></script>

<!-- Clarity tracking code for https://rumahpekerjahebat.com/ -->
<script>
    (function(c, l, a, r, i, t, y) {
        c[a] =
            c[a] ||
            function() {
                (c[a].q = c[a].q || []).push(arguments);
            };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i + "?ref=bwt";
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "e299utxn9x");

</script>

<script type="text/javascript">
    (function(c, l, a, r, i, t, y) {
        c[a] = c[a] || function() {
            (c[a].q = c[a].q || []).push(arguments)
        };
        t = l.createElement(r);
        t.async = 1;
        t.src = "https://www.clarity.ms/tag/" + i;
        y = l.getElementsByTagName(r)[0];
        y.parentNode.insertBefore(t, y);
    })(window, document, "clarity", "script", "e29pxggw2e");

</script>
@endif
