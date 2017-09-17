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

    // Ticket page..
    $app->match('/ticket/{id}', 'Notepad\Controller\TicketController::ticketAction')
        ->bind('ticket');

    // Archives pages.
    $app->get('/archives', 'Notepad\Controller\HomeController::archivesAction')
        ->bind('archives');

    // Starred pages.
    $app->get('/stars', 'Notepad\Controller\HomeController::starsAction')
        ->bind('stars');

    // Login
    $app->match('/login', 'Notepad\Controller\UserController::loginAction')
        ->bind('login');

    // Sign in
    $app->match('/sign-up', 'Notepad\Controller\UserController::signUpAction')
        ->bind('sign-up');

    // Add ticket
    $app->match('/admin/add-ticket', 'Notepad\Controller\TicketController::addTicketAction')
        ->bind('add-ticket');

    // Update ticket
    $app->match('/admin/edit-ticket/{id}', 'Notepad\Controller\TicketController::editTicketAction')
        ->bind('edit-ticket');

    // Delete ticket
    $app->match('/admin/delete-ticket/{id}', 'Notepad\Controller\TicketController::deleteTicketAction')
        ->bind('delete-ticket');

    // Toggle star.
    $app->match('/admin/toggle-stars/{id}', 'Notepad\Controller\TicketController::toggleStarAction')
        ->bind('toggle-star');
