<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Add HTTP security headers to every response to protect against
     * clickjacking, MIME-type sniffing, and other common web attacks.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent the site from being embedded in iframes (clickjacking)
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // Stop browsers from guessing the content type
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Control how much referrer info is sent
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Disable browser features we don't use
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Force HTTPS for 1 year (only effective once SSL is active on Hostinger)
        $response->headers->set(
            'Strict-Transport-Security',
            'max-age=31536000; includeSubDomains'
        );

        // Content Security Policy — allows inline styles/scripts needed by Alpine.js
        // and the admin WYSIWYG editor, plus Google Fonts
        $response->headers->set(
            'Content-Security-Policy',
            implode('; ', [
                "default-src 'self'",
                "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com",
                "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com",
                "font-src 'self' https://fonts.gstatic.com data:",
                "img-src 'self' data: https:",
                "connect-src 'self'",
                "frame-ancestors 'self'",
            ])
        );

        return $response;
    }
}
