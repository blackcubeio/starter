/**
 * event-aggregator.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {ModeAction, DrawerAction} from '../enums/event-aggregator';

export interface IMode {
    action: ModeAction;
}

export interface IDrawer {
    action: DrawerAction;
}
