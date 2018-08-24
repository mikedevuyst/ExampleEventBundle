<?php

/*
 * This file is part of Sulu.
 *
 * (c) MASSIVE ART WebServices GmbH
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sulu\Bundle\ExampleEventBundle\Admin;

use Sulu\Bundle\AdminBundle\Admin\Admin;
use Sulu\Bundle\AdminBundle\Admin\Routing\Route;
use Sulu\Bundle\AdminBundle\Navigation\Navigation;
use Sulu\Bundle\AdminBundle\Navigation\NavigationItem;

class EventAdmin extends Admin
{
    public function getNavigation(): Navigation
    {
        $rootNavigationItem = $this->getNavigationItemRoot();

        $module = new NavigationItem('example_event.events');
        $module->setPosition(40);
        $module->setIcon('su-calendar');

        $events = new NavigationItem('example_event.events');
        $events->setPosition(10);
        $events->setMainRoute('example_event.event_datagrid');

        $module->addChild($events);
        $rootNavigationItem->addChild($module);

        return new Navigation($rootNavigationItem);
    }

    public function getRoutes(): array
    {
        $formToolbarActions = [
            'sulu_admin.save',
            'sulu_admin.delete',
        ];

        return [
            (new Route('example_event.event_datagrid', '/events', 'sulu_admin.datagrid'))
                ->addOption('title', 'example_event.events')
                ->addOption('adapters', ['table'])
                ->addOption('resourceKey', 'events')
                ->addOption('addRoute', 'example_event.event_add_form.detail')
                ->addOption('editRoute', 'example_event.event_edit_form.detail'),
            (new Route('example_event.event_add_form', '/events/add', 'sulu_admin.resource_tabs'))
                ->addOption('toolbarActions', $formToolbarActions)
                ->addOption('resourceKey', 'events'),
            (new Route('example_event.event_add_form.detail', '/details', 'sulu_admin.form'))
                ->addOption('tabTitle', 'example_event.details')
                ->addOption('backRoute', 'example_event.event_datagrid')
                ->addOption('editRoute', 'example_event.event_edit_form.detail')
                ->setParent('example_event.event_add_form'),
            (new Route('example_event.event_edit_form', '/events/:id', 'sulu_admin.resource_tabs'))
                ->addOption('toolbarActions', $formToolbarActions)
                ->addOption('resourceKey', 'events'),
            (new Route('example_event.event_edit_form.detail', '/details', 'sulu_admin.form'))
                ->addOption('tabTitle', 'example_event.details')
                ->addOption('backRoute', 'example_event.event_datagrid')
                ->setParent('example_event.event_edit_form'),
        ];
    }
}
