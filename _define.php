<?php

/**
 * @brief memo, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul
 *
 * @copyright Franck Paul, contact@open-time.net
 * @copyright AGPL-3.0 https://www.gnu.org/licenses/agpl-3.0.html
 */
$this->registerModule(
    'memo',
    'User personal memo',
    'Franck Paul',
    '1.2',
    [
        'date'        => '2026-04-04T17:18:48+0200',
        'requires'    => [['core', '2.36']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'priority'    => 900,   // Might be the first of the 3rd party
        'settings'    => [
            'pref' => '#user-options.memo',
        ],

        'details'    => 'https://github.com/franck-paul/memo',
        'support'    => 'https://github.com/franck-paul/memo',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/memo/main/dcstore.xml',
        'license'    => 'gpl2',
    ]
);
