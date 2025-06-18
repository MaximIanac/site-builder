<?php

namespace Maximianac\SiteBuilder\Services\Utils\Breadcrumb;

/**
 * Class Breadcrumbs
 *
 * Generates and renders breadcrumb navigation based on the current URL path.
 */
class Breadcrumbs
{
    /**
     * Default Blade template path for rendering breadcrumbs.
     *
     * @var string
     */
    protected string $defaultTemplate = "components.sb.common.breadcrumbs";

    /**
     * Array of breadcrumb segments.
     *
     * @var array<int, array{title: string, url: string, active: bool}>
     */
    protected array $segments = [];

    /**
     * URL segments to exclude from the breadcrumbs.
     *
     * @var string[]
     */
    protected array $excludedSegments = ['cp', 'dashboard'];

    /**
     * Create a new instance of Breadcrumbs.
     *
     * @return self
     */
    public static function make(): self
    {
        return new static();
    }

    /**
     * Generate breadcrumb segments from the current request path.
     *
     * @return array<int, array{title: string, url: string, active: bool}>
     */
    public function generate(): array
    {
        $path = request()->path();
        $segments = explode('/', $path);

        $url = '';
        foreach ($segments as $segment) {
            if (empty($segment)) continue;

            $url .= "/{$segment}";

            if (in_array($segment, $this->excludedSegments)) continue;

            $this->addSegment(
                title: $this->makeTitle($segment),
                url: url($url)
            );
        }

        return $this->segments;
    }

    /**
     * Render the breadcrumbs using a Blade template.
     *
     * @param string $template
     * @return string
     */
    public function render(string $template = 'default'): string
    {
        $segments = $this->generate();

//        if (empty($segments)) {
//            return '';
//        }

        return view("{$this->defaultTemplate}.$template", [
            'segments' => $segments,
        ])->render();
    }

    /**
     * Convert a segment string to a readable breadcrumb title.
     *
     * @param string $segment
     * @return string
     */
    protected function makeTitle(string $segment): string
    {
        $segment = str_replace(['-', '_'], ' ', $segment);

        return ucfirst($segment);
    }

    /**
     * Add a new segment to the breadcrumb list.
     *
     * @param string $title
     * @param string $url
     * @return void
     */
    protected function addSegment(string $title, string $url): void
    {
        $this->segments[] = [
            'title' => $title,
            'url' => $url,
            'active' => ($url === request()->url())
        ];
    }
}
