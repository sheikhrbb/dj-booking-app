<!DOCTYPE html>
<html lang="en">
<head>
    <!-- You may want to keep the Breeze <head> section for styles/scripts -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    
</head>
<body>
    @include('pages.include.header')

    <main>
        @yield('content')
    </main>

    @include('pages.include.footer')

    <div id="file-size-toast" style="display:none; position:fixed; top:20px; right:20px; z-index:9999;" class="alert alert-danger"></div>
</body>
</html>