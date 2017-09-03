<?php
    /**
     * Notepad.
     * Copyright (C) 2017 Nicolas GILLE
     *
     * This program is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * This program is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    declare(strict_types=1);

    // Homepage.
    $app->match('/', 'Notepad\Controller\HomeController::homeAction')
        ->bind('home');

    // Archives pages.
    $app->get('/archives/', 'Notepad\Controller\HomeController::archivesAction')
        ->bind('archives');

    // Login
    $app->match('/login', 'Notepad\Controller\HomeController::loginAction')
        ->bind('login');

    // Sign in
    $app->match('/sign_up', 'Notepad\Controller\HomeController::signUpAction')
        ->bind('sign_up');

    // Add ticket
    $app->match('/admin/add-ticket', 'Notepad\Controller\AdminController::addTicketAction')
        ->bind('add-ticket');

    // Update ticket
    $app->match('/admin/edit-ticket/{id}', 'Notepad\Controller\AdminController::editTicketAction')
        ->bind('edit-ticket');

    // Delete ticket
    $app->match('/admin/delete-ticket/{id}', 'Notepad\Controller\AdminController::deleteTicketAction')
        ->bind('delete-ticket');
