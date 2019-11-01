<?php
namespace App\EventListener;
use FOS\RestBundle\View\ConfigurableViewHandlerInterface;
use FOS\RestBundle\View\ViewHandlerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class VersionListener
{
    /**
     * @var ViewHandlerInterface
     */
    private $viewHandler;
    /**
     * @param ViewHandlerInterface $viewHandler
     */
    public function __construct(ViewHandlerInterface $viewHandler)
    {
        $this->viewHandler = $viewHandler;
    }
    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $version = str_replace('v', '', $this->resolveVersion($request));
        $request->attributes->set('version', $version);
        if ($this->viewHandler instanceof ConfigurableViewHandlerInterface) {
            $this->viewHandler->setExclusionStrategyVersion($version);
        }
    }
    /**
     * @param Request $request
     *
     * @return float|int|string
     */
    private function resolveVersion(Request $request)
    {
        $version = $request->attributes->get('version');
        return is_scalar($version) ? $version : floatval($version);
    }
}