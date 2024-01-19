<?php

namespace Drupal\dsets_core\Breadcrumb;

use Drupal\Core\Breadcrumb\Breadcrumb;
use Drupal\Core\Breadcrumb\BreadcrumbBuilderInterface;
use Drupal\Core\Controller\TitleResolver;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Link;
use Drupal\Core\Path\CurrentPathStack;
use Drupal\Core\Path\PathMatcher;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Url;

/**
 * Custom breadcrumb builder.
 */
class BreadcrumbBuilder implements BreadcrumbBuilderInterface {
  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\Path\CurrentPathStack
   */
  protected $pathCurrent;

  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\Path\PathMatcher
   */
  protected $pathMatcher;

  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\Controller\TitleResolver
   */
  protected $titleResolver;

  /**
   * For services dependency injection.
   *
   * @var Drupal\Core\Http\RequestStack
   */
  protected $requestStack;

  /**
   * Class constructor.
   *
   * @param Drupal\Core\Path\PathMatcher $path_matcher
   *   For services dependency injection.
   * @param Drupal\Core\Controller\TitleResolver $title_resolver
   *   For services dependency injection.
   * @param Drupal\Core\Path\CurrentPathStack $path_current
   *   For services dependency injection.
   * @param Drupal\Core\Http\RequestStack $request_stack
   *   For services dependency injection.
   */
  public function __construct(
    PathMatcher $path_matcher,
    TitleResolver $title_resolver,
    CurrentPathStack $path_current,
    RequestStack $request_stack) {
    $this->pathMatcher = $path_matcher;
    $this->titleResolver = $title_resolver;
    $this->pathCurrent = $path_current;
    $this->requestStack = $request_stack;
  }

  /**
   * {@inheritdoc}
   */
  public function applies(RouteMatchInterface $attributes) {
    if (preg_match('/^\/admin\//', $this->pathCurrent->getPath())) {
      return FALSE;
    }
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function build(RouteMatchInterface $route_match) {
    $links = [
      new Link('UNB Libraries', Url::fromUri('https://lib.unb.ca')),
    ];

    if ($this->pathMatcher->isFrontPage()) {
      $links[] = Link::createFromRoute('Datasets', '<none>');
    }
    else {
      $links[] = Link::createFromRoute('Datasets', '<front>');
      $node = $route_match->getParameter('node') ?? NULL;

      if ($node) {

        switch ($node->bundle()) {
          case 'dsets_anniversary_event':
            $links[] = Link::createFromRoute('Browse Anniversaries', 'view.dsets_browse_anniversaries.page_1', [
              'arg_0' => date('Y'),
              'arg_1' => 'x5',
            ]);
            break;

          case 'dsets_biography':
            $links[] = Link::createFromRoute('Browse Biographies', 'view.dsets_browse_biographies.page_1');
            break;
        }
      }

      $title = $this->titleResolver->getTitle($this->requestStack->getCurrentRequest(), $route_match->getRouteObject());
      $links[] = Link::createFromRoute($title, '<none>');
    }

    $breadcrumb = new Breadcrumb();
    $breadcrumb->addCacheContexts(['url.path']);
    $breadcrumb->setLinks($links);

    return $breadcrumb;
  }

}
