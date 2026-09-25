/**
 * drawer-trigger.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {bindable, customAttribute, IEventAggregator, ILogger, INode, resolve} from 'aurelia';
import {Channels, DrawerAction} from '../enums/event-aggregator';
import {IDrawer} from '../interfaces/event-aggregator';

@customAttribute({name: 'blackcube-drawer-trigger', defaultProperty: 'action'})
export class BlackcubeDrawerTriggerCustomAttribute {
    @bindable action: string = DrawerAction.Toggle;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('blackcube-drawer-trigger'),
        private readonly element: HTMLElement = resolve(INode) as HTMLElement,
        private readonly ea: IEventAggregator = resolve(IEventAggregator),
    ) {
        this.logger.trace('constructor');
    }

    public attaching() {
        this.logger.trace('attaching');
        this.element.addEventListener('click', this.onClick);
    }

    public detaching() {
        this.logger.trace('detaching');
        this.element.removeEventListener('click', this.onClick);
    }

    private onClick = (event: Event) => {
        event.preventDefault();
        const action = this.resolveAction(this.action);
        this.ea.publish(Channels.Drawer, <IDrawer>{action: action});
    };

    private resolveAction(value: string): DrawerAction {
        switch (value) {
            case DrawerAction.Open:
                return DrawerAction.Open;
            case DrawerAction.Close:
                return DrawerAction.Close;
            default:
                return DrawerAction.Toggle;
        }
    }
}
