<?php

namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PageViewSubscriber implements EventSubscriberInterface 
{
    public function __construct(
        private LoggerInterface $pageviewsLogger,
        private array $excludedRoutes = []
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        if($event->getRequest()->cookies->get('skip_pv') === '1') {
            return;
        }

        $route = $event->getRequest()->attributes->get('_route');
        if (!$route) {
            return;
        }

        foreach ($this->excludedRoutes as $pattern) {
            if (str_starts_with($route, $pattern)) {
                return;
            }
        }

        $this->pageviewsLogger->info('Page viewed', [
            'route' => $route,
        ]);
    }
}