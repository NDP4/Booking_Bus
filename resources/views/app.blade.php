<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, maximum-scale=1.0, maximum-scale=1.0" />
    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
    @inertiaHead
    {{-- <script async type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRYyqyiLqo4ms7f-DktJKqcv0VWa7rOWI&libraries=places&callback=Function.prototype" defer></script> --}}
  </head>
  <body class="font-sans antialiased">
    @inertia
  </body>
</html>
