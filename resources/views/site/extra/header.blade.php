<meta charset="UTF-8"/>
<meta name="description" content="description"/>
<meta name="csrf-token" content="{{csrf_token()}}"/>
<meta name="keywords" content="keywords"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
<link rel="shortcut icon" href="{{asset('favicon/favicon.ico')}}"/>
<title>@yield('title') | www.borakexpressbd.com</title>
<!-- styles-->
<link rel="stylesheet" href="{{asset('site/css/styles.min.css')}}"/>
<!-- web-font loader-->
<script>
    WebFontConfig = {
        google: {

            families: ['Inter:300,400,500,700', 'Open+Sans:700'],

        }
    }

    function font() {

        var wf = document.createElement('script')

        wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js'
        wf.type = 'text/javascript'
        wf.async = 'true'

        var s = document.getElementsByTagName('script')[0]

        s.parentNode.insertBefore(wf, s)

    }

    font()
</script>