<?php

namespace App\Support;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\Table\TableExtension;
use League\CommonMark\MarkdownConverter;

/**
 * Markdown → safe HTML renderer for blog content and other CMS text.
 * Extensions: GFM (tables, strikethrough, task lists, autolinks),
 * heading permalinks, autolinks (defensive).
 */
class MarkdownRenderer
{
    protected MarkdownConverter $converter;

    public function __construct()
    {
        $config = [
            'html_input' => 'strip',         // strip raw <script>/<iframe>
            'allow_unsafe_links' => false,
            'heading_permalink' => [
                'html_class' => 'heading-permalink',
                'symbol' => '#',
                // "after" so heading text sits immediately after <h2>:
                // grep-friendly, cleaner screen-reader output.
                'insert' => 'after',
                'min_heading_level' => 2,
                'max_heading_level' => 4,
            ],
        ];

        $env = new Environment($config);
        $env->addExtension(new CommonMarkCoreExtension());
        $env->addExtension(new GithubFlavoredMarkdownExtension());
        $env->addExtension(new HeadingPermalinkExtension());
        $env->addExtension(new TableExtension());
        $env->addExtension(new AutolinkExtension());

        $this->converter = new MarkdownConverter($env);
    }

    public function render(?string $markdown): string
    {
        if ($markdown === null || $markdown === '') return '';
        return (string) $this->converter->convert($markdown)->getContent();
    }

    /** Strip markdown to plain text for excerpts/meta description. */
    public function excerpt(?string $markdown, int $maxLen = 280): string
    {
        if (!$markdown) return '';
        $html = $this->render($markdown);
        $text = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        if (mb_strlen($text) <= $maxLen) return $text;
        return rtrim(mb_substr($text, 0, $maxLen - 1), ' .,;:') . '…';
    }
}
