<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Мета-теги, заголовки сторінки та інше -->
</head>
<body class="font-sans antialiased">
<div>
    <!-- Header, navigation, etc. -->

    <!-- Content section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <ul>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <li>
                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>
                </li>
            @endforeach
        </ul>
        @yield('content')
    </div>
</div>
</body>
</html>
