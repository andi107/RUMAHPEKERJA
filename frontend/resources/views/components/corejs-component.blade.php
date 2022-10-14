<script src="{{asset('src/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('src/plugins/jquery/jquery.lazyload.min.js')}}"></script>
<script src="{{asset('src/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('src/plugins/slick-carousel/slick.min.js')}}"></script>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
<script src="{{asset('src/plugins/google-map/gmap.js')}}"></script> --}}
<script src="{{asset('anim/js/animsition.min.js')}}"></script>
<script src="{{asset('src/js/custom.js')}}"></script>
<script src="{{asset('src/plugins/font-awesome/js/all.min.js')}}"></script>
<script>
    let setContentImgSize = $("p img"), setContentImgFigureSize = $("figure img");
    setContentImgSize.css('max-width','100%');
    setContentImgSize.css('height','100%');
    setContentImgFigureSize.css('max-width','100%');
    setContentImgFigureSize.css('height','100%');

    $("img.lazy").lazyload({
        effect : "fadeIn"
    });
    $(document).ready(function() {
        $(".animsition").animsition({
            inClass: 'fade-in-down-sm'
            , outClass: 'fade-out-up-sm'
            , inDuration: 500
            , outDuration: 50
            , linkElement: 'a',
            loading: true
            , loadingParentElement: 'body',
            loadingClass: 'animsition-loading'
            , loadingInner: '',
            timeout: false
            , timeoutCountdown: 5000
            , onLoadEvent: true
            , browser: ['animation-duration', '-webkit-animation-duration'],
            overlay: false
            , overlayClass: 'animsition-overlay-slide'
            , overlayParentElement: 'body'
            , transition: function(url) {
                window.location.href = url;
            }
        });
    });

</script>
