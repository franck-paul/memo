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
declare(strict_types=1);

namespace Dotclear\Plugin\memo;

use Dotclear\App;
use Dotclear\Core\Process;
use Exception;

class Install extends Process
{
    public static function init(): bool
    {
        return self::status(My::checkContext(My::INSTALL));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        try {
            // Update
            // Nothing up to now

            // Init
            if ($preferences = My::prefs()) {
                if (!$preferences->prefExists('memo')) {
                    $preferences->put(
                        'memo',
                        '',
                        App::userWorkspace()::WS_STRING,
                        'memo',
                        false
                    );
                }

                if (!$preferences->prefExists('size')) {
                    $preferences->put(
                        'size',
                        5,
                        App::userWorkspace()::WS_INT,
                        'memo size (number of rows)',
                        false
                    );
                }
            }
        } catch (Exception $exception) {
            App::error()->add($exception->getMessage());
        }

        return true;
    }
}
