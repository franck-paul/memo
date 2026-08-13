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
declare(strict_types=1);

if (isset($this) && is_object($this) && method_exists($this, 'registerModule') && isset($this->id) && is_string($this->id)) {
    $this->registerModule(
        'memo',
        'User personal memo',
        'Franck Paul',
        '2.0',
        [
            'date'        => '2026-08-03T10:04:54+0200',
            'requires'    => [['core', '2.39']],
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
}
