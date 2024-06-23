<?php
/**
 * @brief memo, a plugin for Dotclear 2
 *
 * @package Dotclear
 * @subpackage Plugins
 *
 * @author Franck Paul
 *
 * @copyright Franck Paul, carnet.franck.paul@gmail.com
 * @copyright AGPL-3.0 https://www.gnu.org/licenses/agpl-3.0.html
 */
$this->registerModule(
    'memo',
    'User personal memo',
    'Franck Paul',
    '0.4',
    [
        'requires'    => [['core', '2.30']],
        'permissions' => 'My',
        'type'        => 'plugin',
        'priority'    => 900,   // Might be the first of the 3rd party
        'settings'    => [
            'pref' => '#user-options.memo',
        ],

        'details'    => 'https://github.com/franck-paul/memo',
        'support'    => 'https://github.com/franck-paul/memo',
        'repository' => 'https://raw.githubusercontent.com/franck-paul/memo/main/dcstore.xml',
    ]
);
