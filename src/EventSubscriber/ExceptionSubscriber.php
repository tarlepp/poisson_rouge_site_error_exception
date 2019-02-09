<?php

namespace App\EventSubscriber;

use App\Exception\SiteErrorException;
use App\Repository\SiteErrorRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $siteErrorRepository;

    public static function getSubscribedEvents(): array
    {
        return [
           'kernel.exception' => 'onKernelException',
        ];
    }

    public function __construct(SiteErrorRepository $siteErrorRepository)
    {
        $this->siteErrorRepository = $siteErrorRepository;
    }

    public function onKernelException(GetResponseForExceptionEvent $event): void
    {
        if ($event->getException() instanceof SiteErrorException) {
            // Your custom logic here
            $this->siteErrorRepository->fooBar();

            $event->setResponse(new Response('custom content', 418));
            $event->allowCustomResponseCode();
        }
    }
}
