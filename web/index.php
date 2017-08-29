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

    require_once __DIR__ . '/../vendor/autoload.php';

    // Create instance of Application
    $app = new Silex\Application();

    require_once __DIR__ . '/../app/app.php';
    require_once __DIR__ . '/../app/routes.php';
    require_once __DIR__ . '/../app/config/dev.php';

    // Run the application.
    $app->run();
