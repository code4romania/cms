@if (config('analytics.tracking_id'))
    <script>
        var dnt = (navigator.doNotTrack || window.doNotTrack || navigator.msDoNotTrack);
        var doNotTrack = (dnt == "1" || dnt == "yes");

        if (!doNotTrack) {
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            if (window.sessionStorage) {
                var GA_SESSION_STORAGE_KEY = 'ga:clientId';

                ga('create', '{{ config('analytics.tracking_id') }}', {
                    'storage': 'none',
                    'clientId': sessionStorage.getItem(GA_SESSION_STORAGE_KEY)
                });

                ga(function(tracker) {
                    sessionStorage.setItem(GA_SESSION_STORAGE_KEY, tracker.get('clientId'));
                });
            }

            ga('set', 'anonymizeIp', true);
            ga('send', 'pageview');
        }
    </script>
@endif
