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

class Backend extends Process
{
    public static function init(): bool
    {
        // dead but useful code, in order to have translations
        __('memo') . __('User personal memo');

        return self::status(My::checkContext(My::BACKEND));
    }

    public static function process(): bool
    {
        if (!self::status()) {
            return false;
        }

        App::behavior()->addBehaviors([
            // User preferences
            'adminPreferencesHeaders'      => BackendBehaviors::adminPreferencesHeaders(...),
            'adminBeforeUserOptionsUpdate' => BackendBehaviors::adminBeforeUserOptionsUpdate(...),
            'adminPreferencesFormV2'       => BackendBehaviors::adminPreferencesForm(...),

            // Add behaviour callback for post
            'adminPostForm'        => BackendBehaviors::adminPostForm(...),
            'adminPostHeaders'     => BackendBehaviors::adminPostHeaders(...),
            'adminAfterPostCreate' => BackendBehaviors::adminAfterPostCreate(...),
            'adminAfterPostUpdate' => BackendBehaviors::adminAfterPostUpdate(...),
            'adminAfterPageCreate' => BackendBehaviors::adminAfterPageCreate(...),
            'adminAfterPageUpdate' => BackendBehaviors::adminAfterPageUpdate(...),
            // Add behaviour callback for page
            'adminPageForm'    => BackendBehaviors::adminPageForm(...),
            'adminPageHeaders' => BackendBehaviors::adminPageHeaders(...),
        ]);

        return true;
    }
}
