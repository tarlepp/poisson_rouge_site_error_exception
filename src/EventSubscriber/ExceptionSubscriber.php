<?php

namespace App\EventSubscriber;

use App\Exception\SiteErrorException;
use App\Repository\SiteErrorRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;

class ExceptionSubscriber implements EventSubscriberInterface
{
    private $siteErrorRepository;

    public function __construct(SiteErrorRepository $siteErrorRepository)
    {
        $this->siteErrorRepository = $siteErrorRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
           'kernel.exception' => 'onKernelException',
        ];
    }

    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        if ($event->getException() instanceof SiteErrorException) {
            // Your custom logic here
            $this->siteErrorRepository->fooBar();
        }
    }
}
