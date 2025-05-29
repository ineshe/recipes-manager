<?php

namespace App\EventSubscriber;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PageViewSubscriber implements EventSubscriberInterface 
{
    private string $file;
    private array $excludedIps;

    public function __construct(array $pageview_excluded_ips)
    {
        $this->file = __DIR__.'/../../var/pageviews.json';
        $this->excludedIps = $pageview_excluded_ips;
    }

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

        $ip = $event->getRequest()->getClientIp();
        if (in_array($ip, $this->excludedIps, true)) {
            return;
        }

        $route = $event->getRequest()->attributes->get('_route');
        if (!$route) {
            return;
        }

        $data = is_file($this->file) 
            ? json_decode(file_get_contents($this->file), true) 
            : [];

        $data[$route] = ($data[$route] ?? 0) + 1;

        file_put_contents($this->file, json_encode($data, JSON_PRETTY_PRINT));
    }
}