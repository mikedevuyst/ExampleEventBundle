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
use Sulu\Bundle\ExampleEventBundle\Model\Event;
use Sulu\Bundle\ExampleEventBundle\Model\Query\FindEventQuery;
use Sulu\Component\Rest\ListBuilder\Doctrine\DoctrineListBuilder;
use Sulu\Component\Rest\ListBuilder\Doctrine\DoctrineListBuilderFactoryInterface;
use Sulu\Component\Rest\ListBuilder\FieldDescriptor;
use Sulu\Component\Rest\ListBuilder\ListRepresentation;
use Sulu\Component\Rest\ListBuilder\Metadata\FieldDescriptorFactoryInterface;
use Sulu\Component\Rest\RequestParametersTrait;
use Sulu\Component\Rest\RestHelperInterface;
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
     * @var FieldDescriptorFactoryInterface
     */
    private $fieldDescriptorsFactory;

    /**
     * @var DoctrineListBuilderFactoryInterface
     */
    private $listBuilderFactory;

    /**
     * @var RestHelperInterface
     */
    private $restHelper;

    /**
     * @var ViewHandlerInterface
     */
    private $viewHandler;

    public function __construct(
        CommandBus $commandBus,
        FieldDescriptorFactoryInterface $fieldDescriptorsFactory,
        DoctrineListBuilderFactoryInterface $listBuilderFactory,
        RestHelperInterface $restHelper,
        ViewHandlerInterface $viewHandler
    ) {
        $this->commandBus = $commandBus;
        $this->fieldDescriptorsFactory = $fieldDescriptorsFactory;
        $this->listBuilderFactory = $listBuilderFactory;
        $this->restHelper = $restHelper;
        $this->viewHandler = $viewHandler;
    }

    public function cgetAction(Request $request): Response
    {
        $fieldDescriptors = $this->getFieldDescriptors();

        /** @var DoctrineListBuilder $listBuilder */
        $listBuilder = $this->listBuilderFactory->create(Event::class);
        $this->restHelper->initializeListBuilder($listBuilder, $fieldDescriptors);
        $listBuilder->setIdField($fieldDescriptors['id']);

        $listResponse = $listBuilder->execute();

        return $this->handleView(
            View::create(
                new ListRepresentation(
                    $listResponse,
                    'events',
                    $request->get('_route'),
                    $request->query->all(),
                    $listBuilder->getCurrentPage(),
                    $listBuilder->getLimit(),
                    $listBuilder->count()
                )
            )
        );
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

    /**
     * @return FieldDescriptor[]
     */
    protected function getFieldDescriptors(): array
    {
        /** @var FieldDescriptor[] $fieldDescriptors */
        $fieldDescriptors = $this->fieldDescriptorsFactory->getFieldDescriptorForClass(Event::class);

        return $fieldDescriptors;
    }
}
