<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is social network html5 template available in themeforest......" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title>Friend Finder</title>
        @include('layouts.includes.header-css')
    </head>

    <body>
        @include('layouts.includes.header')

        @yield('content')

        @include('layouts.includes.footer')

        @include('layouts.includes.footer-js')
    </body>

</html>
