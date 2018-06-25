<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Controller;

use FOS\RestBundle\Controller\Annotations\NamePrefix;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use FOS\RestBundle\View\ViewHandlerInterface;
use League\Tactician\CommandBus;
use Sulu\Bundle\ExampleEventBundle\Model\Command\CreateEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Command\ModifyEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Command\RemoveEventCommand;
use Sulu\Bundle\ExampleEventBundle\Model\Query\FindEventQuery;
use Sulu\Component\Rest\RequestParametersTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @NamePrefix("sulu_example_event.")
 */
class EventController implements ClassResourceInterface
{
    const RESOURCE_KEY = 'events';

    use RequestParametersTrait;

    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var ViewHandlerInterface
     */
    private $viewHandler;

    public function __construct(CommandBus $commandBus, ViewHandlerInterface $viewHandler)
    {
        $this->commandBus = $commandBus;
        $this->viewHandler = $viewHandler;
    }

    public function getAction(string $id): Response
    {
        $command = new FindEventQuery($id);

        return $this->handleView(View::create($this->commandBus->handle($command)));
    }

    public function postAction(Request $request): Response
    {
        $command = new CreateEventCommand($request->request->all());

        return $this->handleView(View::create($this->commandBus->handle($command)));
    }

    public function putAction(Request $request, string $id): Response
    {
        $command = new ModifyEventCommand($id, $request->request->all());

        return $this->handleView(View::create($this->commandBus->handle($command)));
    }

    public function deleteAction(string $id): Response
    {
        $command = new RemoveEventCommand($id);
        $this->commandBus->handle($command);

        return $this->handleView(View::create(null));
    }

    protected function handleView(View $view): Response
    {
        return $this->viewHandler->handle($view);
    }
}
