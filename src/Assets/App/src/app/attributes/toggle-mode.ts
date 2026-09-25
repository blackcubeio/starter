/**
 * toggle-mode.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {customAttribute, IDisposable, IEventAggregator, ILogger, INode, IPlatform, resolve} from 'aurelia';
import {IStorageService} from '../services/storage-service';
import {Channels, ModeAction} from '../enums/event-aggregator';
import {IMode} from '../interfaces/event-aggregator';

const STORAGE_KEY = 'bc-mode';

@customAttribute({name: 'blackcube-toggle-mode'})
export class BlackcubeToggleModeCustomAttribute {
    private subscription: IDisposable | null = null;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('blackcube-toggle-mode'),
        private readonly element: HTMLElement = resolve(INode) as HTMLElement,
        private readonly ea: IEventAggregator = resolve(IEventAggregator),
        private readonly p: IPlatform = resolve(IPlatform),
        private readonly storage: IStorageService = resolve(IStorageService),
    ) {
        this.logger.trace('constructor');
    }

    public attaching() {
        this.logger.trace('attaching');
        this.element.addEventListener('click', this.onClick);
        this.subscription = this.ea.subscribe(Channels.Mode, this.onMode);
    }

    public detaching() {
        this.logger.trace('detaching');
        this.element.removeEventListener('click', this.onClick);
        this.subscription?.dispose();
    }

    public dispose() {
        this.logger.trace('dispose');
        this.subscription?.dispose();
    }

    private onClick = (event: Event) => {
        event.preventDefault();
        this.ea.publish(Channels.Mode, <IMode>{action: ModeAction.Toggle});
    };

    private onMode = (payload: IMode) => {
        this.logger.trace('onMode', payload.action);
        const root = this.p.document.documentElement;
        switch (payload.action) {
            case ModeAction.Toggle:
                root.classList.toggle('dark');
                break;
            case ModeAction.SetDark:
                root.classList.add('dark');
                break;
            case ModeAction.SetLight:
                root.classList.remove('dark');
                break;
        }
        const isDark = root.classList.contains('dark');
        this.storage.save(STORAGE_KEY, isDark === true ? 'dark' : 'light');
    };
}
