/**
 * event-aggregator.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

export enum Channels {
    Mode = 'blackcube:mode',
}

export enum ModeAction {
    Toggle = 'toggle',
    SetDark = 'set-dark',
    SetLight = 'set-light',
}
