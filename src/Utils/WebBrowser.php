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

    namespace Notepad\Utils;

    /**
     * Class WebBrowser
     *
     * @author Nicolas GILLE
     * @package Notepad\Utils
     * @since 1.0
     * @version 1.0
     */
    class WebBrowser {

        /**
         * Get the web browser language for get right translation.
         *
         * @return string
         *  Active language on web browser.
         * @since 1.0
         * @version 1.0
         */
        public static function getClientLanguage() {
            $langs = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);

            return substr($langs[0], 0, 2);
        }
    }
