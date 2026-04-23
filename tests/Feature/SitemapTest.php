<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SitemapTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_returns_xml_without_cookies(): void
    {
        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=UTF-8');
        $response->assertHeader('Cache-Control', 'max-age=3600, public');

        // No session / XSRF cookies should leak into a stateless sitemap response.
        $this->assertEmpty(
            $response->headers->getCookies(),
            'Sitemap response must not set any cookies.'
        );
        $this->assertNull(
            $response->headers->get('Set-Cookie'),
            'Sitemap response must not emit a Set-Cookie header.'
        );

        $body = $response->getContent();
        $this->assertStringContainsString('<?xml', substr($body, 0, 10));
        $this->assertStringContainsString('<urlset', $body);
        $this->assertMatchesRegularExpression('/<loc>https?:\/\/[^<]+<\/loc>/', $body);
    }
}
