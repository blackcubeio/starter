/**
 * event-aggregator.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {ModeAction} from '../enums/event-aggregator';

export interface IMode {
    action: ModeAction;
}
