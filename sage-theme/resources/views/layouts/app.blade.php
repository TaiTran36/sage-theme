<!doctype html>
<html {!! get_language_attributes() !!}>
<head>
  <meta charset="{{ bloginfo('charset') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @php wp_head() @endphp
</head>
<body @php body_class() @endphp>
  @yield('content')
  @php wp_footer() @endphp
</body>
</html>
