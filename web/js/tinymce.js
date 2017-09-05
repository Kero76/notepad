/*
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

/**
 *
 * @param selector
 * @param height
 * @since 0.4
 * @version 1.0
 */
function init_tinyMCE(selector, height) {
    tinymce.init({
        selector: selector,
        height: height,
        plugins: 'autolink anchor codesample hr link preview searchreplace textcolor visualblocks wordcount',
        toolbar1: 'bold italic underline | cut, copy, paste | link | undo redo',
        style_formats: [
            { title: 'Headers', items: [
                { title: 'h1', block: 'h1' },
                { title: 'h2', block: 'h2' },
                { title: 'h3', block: 'h3' },
                { title: 'h4', block: 'h4' },
                { title: 'h5', block: 'h5' },
                { title: 'h6', block: 'h6' }
            ]},
            { title: 'Blocks', items: [
                { title: 'p',   block: 'p' },
                { title: 'div', block: 'div' },
                { title: 'pre', block: 'pre' }
            ]},
            { title: 'Containers', items: [
                { title: 'section',     block: 'section',    wrapper: true, merge_siblings: false },
                { title: 'article',     block: 'article',    wrapper: true, merge_siblings: false },
                { title: 'blockquote',  block: 'blockquote', wrapper: true },
                { title: 'hgroup',      block: 'hgroup',     wrapper: true },
                { title: 'aside',       block: 'aside',      wrapper: true },
                { title: 'figure',      block: 'figure',     wrapper: true }
            ]}
        ],
        visualblocks_default_state: false,
        end_container_on_empty_block: false,
        content_css: [
            '//www.tinymce.com/css/codepen.min.css'
        ],
    });
}

/**
 * Replace textarea by an instance of TinyMCE editor.
 *
 * @since 0.4
 * @version 1.0
 */
$(document).ready(function(){
    init_tinyMCE('#ticket_content', 250);
});
