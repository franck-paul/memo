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
use Dotclear\Helper\Html\Form\Div;
use Dotclear\Helper\Html\Form\Fieldset;
use Dotclear\Helper\Html\Form\Label;
use Dotclear\Helper\Html\Form\Legend;
use Dotclear\Helper\Html\Form\Note;
use Dotclear\Helper\Html\Form\Number;
use Dotclear\Helper\Html\Form\Para;
use Dotclear\Helper\Html\Form\Textarea;
use Dotclear\Helper\Html\Html;
use Exception;

class BackendBehaviors
{
    /**
     * adminAfterEntrySaved  behavior callback helper
     *
     * @return     string
     */
    protected static function adminAfterEntrySaved(): string
    {
        // Get and store user's prefs for plugin options
        try {
            $preferences = My::prefs();

            if ($preferences) {
                if (isset($_POST['memo_memo']) && !empty($_POST['memo_memo'])) {
                    $preferences->put('memo', Html::escapeHTML($_POST['memo_memo']), App::userWorkspace()::WS_STRING);
                }
            }
        } catch (Exception $exception) {
            App::error()->add($exception->getMessage());
        }

        return '';
    }

    /**
     * adminAfterPostCreate  behavior callback
     *
     * @return     string
     */
    public static function adminAfterPostCreate(): string
    {
        return self::adminAfterEntrySaved();
    }

    /**
     * adminAfterPostUpdate  behavior callback
     *
     * @return     string
     */
    public static function adminAfterPostUpdate(): string
    {
        return self::adminAfterEntrySaved();
    }

    /**
     * adminAfterPageCreate  behavior callback
     *
     * @return     string
     */
    public static function adminAfterPageCreate(): string
    {
        return self::adminAfterEntrySaved();
    }

    /**
     * adminAfterPageUpdate  behavior callback
     *
     * @return     string
     */
    public static function adminAfterPageUpdate(): string
    {
        return self::adminAfterEntrySaved();
    }

    public static function adminBeforeUserOptionsUpdate(): string
    {
        // Get and store user's prefs for plugin options
        try {
            $preferences = My::prefs();

            if ($preferences) {
                $preferences->put('memo', Html::escapeHTML($_POST['memo_memo']), App::userWorkspace()::WS_STRING);
                $preferences->put('size', abs((int) $_POST['memo_size']), App::userWorkspace()::WS_INT);
            }
        } catch (Exception $exception) {
            App::error()->add($exception->getMessage());
        }

        return '';
    }

    public static function adminPreferencesForm(): string
    {
        // Get user's prefs for plugin options
        $preferences = My::prefs();

        $memo = (string) $preferences?->memo;
        $size = (int) $preferences?->size;

        echo
        (new Fieldset('memo'))
        ->legend((new Legend(__('Memo'))))
        ->fields([
            (new Para())
                ->class('area')
                ->items([
                    (new Textarea('memo_memo', $memo))
                        ->cols(50)
                        ->rows($size)
                        ->label((new Label(__('Content:'), Label::IL_TF))),
                ]),
            (new Para())->items([
                (new Number('memo_size', 3, 999, $size))
                    ->label((new Label(__('Number of rows:'), Label::IL_TF))),
            ]),
        ])
        ->render();

        return '';
    }

    /**
     * adminEntryHeaders behavior callback helper
     *
     * @return     string
     */
    protected static function adminEntryHeaders(): string
    {
        return My::cssLoad('style.css') . My::jsLoad('memo.js');
    }

    /**
     * adminPostHeaders behavior callback
     *
     * @return     string
     */
    public static function adminPostHeaders(): string
    {
        return self::adminEntryHeaders();
    }

    /**
     * adminPageHeaders behavior callback
     *
     * @return     string
     */
    public static function adminPageHeaders(): string
    {
        return self::adminEntryHeaders();
    }

    /**
     * adminEntryForm behavior callback helper
     *
     * @return     string
     */
    protected static function adminEntryForm(): string
    {
        $settings = My::prefs();

        $content = $settings?->memo ?? '';
        $rows    = $settings?->size ?? 5;

        echo (new Div())
            ->class(['memo', 'lockable'])
            ->items([
                (new Fieldset('memo', 'details'))
                    ->legend(new Legend(__('Memo'), null, 'summary'))
                    ->items([
                        (new Para())
                            ->class('area')
                            ->items([
                                (new Textarea(['memo_memo'], $content))
                                    ->cols(50)
                                    ->rows($rows),
                            ]),
                        (new Note())
                            ->class('form-note')
                            ->text(__('The contents of your memo will be saved at the same time as the entry.')),
                    ]),
            ])
        ->render();

        return '';
    }

    /**
     * adminPostForm  behavior callback
     *
     * @return     string
     */
    public static function adminPostForm(): string
    {
        return self::adminEntryForm();
    }

    /**
     * adminPageForm  behavior callback
     *
     * @return     string
     */
    public static function adminPageForm(): string
    {
        return self::adminEntryForm();
    }
}
