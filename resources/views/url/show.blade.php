<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Laravel') }}</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      
      <!-- Styles -->
      <link href="{{ mix('css/app.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  </head>
  <body class="flex flex-col h-screen font-sans antialiased leading-none bg-gray-100">
    <div class="py-8 bg-blue-900">
      <div class="flex items-center justify-between px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="font-bold text-white">Redirecting you to the url in <span data-url="{{ $url->destination }}" id="time-to-redirect"></span> seconds...</div>
        <a href="{{ $url->destination }}" class="inline-flex items-center px-4 py-2 text-base font-medium text-white bg-yellow-600 border border-transparent rounded-md shadow-sm hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">Skip</a>
      </div>
    </div>
    <div class="flex items-center justify-center flex-1">
      Advertising placeholder here
    </div>
    <script>
      let timeToRedirectContainer = document.getElementById('time-to-redirect');
      let timer = 5;

      timeToRedirectContainer.innerText = timer;

      let interval = setInterval(() => {
        timer--;
        timeToRedirectContainer.innerText = timer;
      
        if (timer < 0) {
          clearInterval(interval);
          timeToRedirectContainer.innerText = 'Redirecting...';
          window.location.href = timeToRedirectContainer.dataset.url;
        }
      }, 1000);
    </script>
  </body>
</html>