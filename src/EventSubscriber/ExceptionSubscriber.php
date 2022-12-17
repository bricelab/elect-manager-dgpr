<?php

namespace App\EventSubscriber;

use App\Exception\BadInputException;
use App\Exception\PosteVoteNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly LoggerInterface $logger)
    {
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($exception instanceof BadInputException) {
            $this->logger->critical($exception->getMessage());
            $responseCode = Response::HTTP_BAD_REQUEST;

            $event->setResponse(
                new JsonResponse($exception->getMessage(), $responseCode)
            );
        } elseif ($exception instanceof PosteVoteNotFoundException) {
            $this->logger->critical($exception->getMessage());
            $responseCode = Response::HTTP_NOT_FOUND;

            $event->setResponse(
                new JsonResponse($exception->getMessage(), $responseCode)
            );
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }
}
