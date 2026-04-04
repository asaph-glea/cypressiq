<?php

$map = [
    '..\mainwebsite\index.html' => 'resources\views\home.blade.php',
    '..\mainwebsite\pages\services.html' => 'resources\views\services.blade.php',
    '..\mainwebsite\pages\cypressiq.html' => 'resources\views\opero.blade.php',
    '..\mainwebsite\pages\portfolio.html' => 'resources\views\portfolio.blade.php',
    '..\mainwebsite\pages\tools.html' => 'resources\views\tools.blade.php',
    '..\mainwebsite\pages\about.html' => 'resources\views\about.blade.php',
    '..\mainwebsite\pages\contact.html' => 'resources\views\contact.blade.php',
    '..\mainwebsite\pages\blog.html' => 'resources\views\blog\index.blade.php',
    '..\mainwebsite\pages\article.html' => 'resources\views\blog\show.blade.php',
    '..\mainwebsite\pages\admin.html' => 'resources\views\admin\dashboard.blade.php',
];

foreach ($map as $source => $dest) {
    if (!file_exists($source)) {
        echo "Missing source: $source\n";
        continue;
    }

    $html = file_get_contents($source);

    // Title
    preg_match('/<title>(.*?)<\/title>/is', $html, $titleMatch);
    $title = $titleMatch[1] ?? 'Cypressiq';
    $title = str_replace(['Cypressiq — ', ' | Cypressiq'], '', $title);

    // CSS
    $css = '';
    if (preg_match('/<style>(.*?)<\/style>/is', $html, $styleMatch)) {
        $css .= "<style>\n" . trim($styleMatch[1]) . "\n</style>";
    }
    if (strpos($html, 'home.css') !== false) {
        $css .= "\n" . '<link rel="stylesheet" href="{{ asset(\'css/home.css\') }}" />';
    }
    if (strpos($html, 'blog.css') !== false) {
        $css .= "\n" . '<link rel="stylesheet" href="{{ asset(\'css/blog.css\') }}" />';
    }

    // Content body
    $parts = explode('</nav>', $html);
    if (count($parts) < 2)
        continue;
    $afterNav = $parts[count($parts) - 1];

    $parts2 = explode('<footer class="footer">', $afterNav);
    if (count($parts2) < 2) {
        // Some pages might not have a footer, or different footer class. Fallback.
        $parts3 = explode('<script', $afterNav);
        if (count($parts3) > 1) {
            $content = $parts3[0];
            // Remove chatbot & exit intent modals
            $content = preg_replace('/<button class="chatbot-trigger".*?<\/div>/is', '', $content);
            $content = preg_replace('/<div id="exit-intent-modal".*?<\/div>\s*<\/div>/is', '', $content);
        }
        else {
            $content = $afterNav;
        }
    }
    else {
        $content = $parts2[0];
    }

    // Routing replacements
    $content = str_replace('pages/services.html', '{{ route(\'services\') }}', $content);
    $content = str_replace('pages/cypressiq.html', '{{ route(\'opero\') }}', $content);
    $content = str_replace('pages/portfolio.html', '{{ route(\'portfolio\') }}', $content);
    $content = str_replace('pages/tools.html', '{{ route(\'tools\') }}', $content);
    $content = str_replace('pages/blog.html', '{{ route(\'blog.index\') }}', $content);
    $content = str_replace('pages/about.html', '{{ route(\'about\') }}', $content);
    $content = str_replace('pages/contact.html', '{{ route(\'contact\') }}', $content);
    $content = str_replace('index.html', '{{ route(\'home\') }}', $content);
    $content = str_replace('../index.html', '{{ route(\'home\') }}', $content);

    $content = str_replace('services.html', '{{ route(\'services\') }}', $content);
    $content = str_replace('cypressiq.html', '{{ route(\'opero\') }}', $content);
    $content = str_replace('portfolio.html', '{{ route(\'portfolio\') }}', $content);
    $content = str_replace('tools.html', '{{ route(\'tools\') }}', $content);
    $content = str_replace('blog.html', '{{ route(\'blog.index\') }}', $content);
    $content = str_replace('about.html', '{{ route(\'about\') }}', $content);
    $content = str_replace('contact.html', '{{ route(\'contact\') }}', $content);

    // Asset replacements
    $content = str_replace('assets/', '{{ asset(\'assets/\') }}', $content);
    $content = str_replace('../assets/', '{{ asset(\'assets/\') }}', $content);

    $blade = "@extends('layouts.app')\n";
    $blade .= "@section('title', '" . addslashes(trim($title)) . "')\n\n";

    if (!empty(trim($css))) {
        $blade .= "@section('css')\n" . trim($css) . "\n@endsection\n\n";
    }

    $blade .= "@section('content')\n" . trim($content) . "\n@endsection\n";

    $dir = dirname($dest);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }

    file_put_contents($dest, $blade);
    echo "Generated $dest\n";
}
