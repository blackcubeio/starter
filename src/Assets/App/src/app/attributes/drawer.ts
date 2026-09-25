/**
 * drawer.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {customAttribute, IDisposable, IEventAggregator, ILogger, INode, IPlatform, resolve} from 'aurelia';
import {ITransitionService} from '../services/transition-service';
import {Channels, DrawerAction} from '../enums/event-aggregator';
import {IDrawer} from '../interfaces/event-aggregator';

@customAttribute({name: 'blackcube-drawer'})
export class BlackcubeDrawerCustomAttribute {
    private subscription: IDisposable | null = null;
    private isOpen: boolean = false;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('blackcube-drawer'),
        private readonly element: HTMLDialogElement = resolve(INode) as HTMLDialogElement,
        private readonly ea: IEventAggregator = resolve(IEventAggregator),
        private readonly p: IPlatform = resolve(IPlatform),
        private readonly transitionService: ITransitionService = resolve(ITransitionService),
    ) {
        this.logger.trace('constructor');
    }

    public attaching() {
        this.logger.trace('attaching');
        this.subscription = this.ea.subscribe(Channels.Drawer, this.onDrawer);
        this.element.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', this.onLinkClick);
        });
        this.element.addEventListener('cancel', this.onCancel);
    }

    public detaching() {
        this.logger.trace('detaching');
        this.subscription?.dispose();
        this.element.querySelectorAll('a').forEach((link) => {
            link.removeEventListener('click', this.onLinkClick);
        });
        this.element.removeEventListener('cancel', this.onCancel);
    }

    public dispose() {
        this.logger.trace('dispose');
        this.subscription?.dispose();
    }

    private onDrawer = (payload: IDrawer) => {
        this.logger.trace('onDrawer', payload.action);
        switch (payload.action) {
            case DrawerAction.Open:
                this.open();
                break;
            case DrawerAction.Close:
                this.close();
                break;
            case DrawerAction.Toggle:
                this.isOpen === true ? this.close() : this.open();
                break;
        }
    };

    private onLinkClick = () => {
        this.close();
    };

    private onCancel = (event: Event) => {
        event.preventDefault();
        this.close();
    };

    private open() {
        if (this.isOpen === true) {
            return;
        }
        this.isOpen = true;
        this.element.showModal();
        this.transitionService.run(this.element, (el) => {
            el.classList.add('open');
        }, (el) => {
            const closeButton = el.querySelector('button[data-drawer="close"]') as HTMLButtonElement | null;
            closeButton?.focus();
        });
    }

    private close() {
        if (this.isOpen === false) {
            return;
        }
        this.isOpen = false;
        this.transitionService.run(this.element, (el) => {
            el.classList.remove('open');
        }, (el) => {
            (el as HTMLDialogElement).close();
        });
    }
}
