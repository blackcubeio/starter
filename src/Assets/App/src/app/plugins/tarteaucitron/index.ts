/**
 * index.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {IContainer, ILogger, IPlatform, resolve} from 'aurelia';
import {Configure, ITarteaucitronConfiguration, type TarteaucitronOptions} from './configure';

declare global {
    interface Window {
        tarteaucitron?: {
            init: (options: TarteaucitronOptions) => void;
            user?: Record<string, unknown>;
            job?: string[];
            [key: string]: unknown;
        };
    }
}

export interface TarteaucitronCustomize {
    services?: string[];
    options?: Record<string, unknown>;
    init?: Partial<TarteaucitronOptions>;
}

export class TarteaucitronService {
    public constructor(
        private readonly config: ITarteaucitronConfiguration = resolve(ITarteaucitronConfiguration),
        private readonly logger: ILogger = resolve(ILogger).scopeTo('tarteaucitron'),
        private readonly p: IPlatform = resolve(IPlatform),
    ) {
        this.logger.trace('constructor');
        if (this.p.window.tarteaucitron === undefined) {
            this.logger.error('tarteaucitron not loaded — register TarteAuCitronAsset before AppAsset');
            return;
        }
        const tac = this.p.window.tarteaucitron;

        if (tac.user === undefined) {
            tac.user = {};
        }
        const userOptions = this.config.getUserOptions();
        for (const key of Object.keys(userOptions)) {
            tac.user[key] = userOptions[key];
        }

        tac.init(this.config.getConfig());

        if (tac.job === undefined) {
            tac.job = [];
        }
        const services = this.config.getServices();
        for (const service of services) {
            tac.job.push(service);
        }
    }
}

function createTarteaucitronConfiguration(input?: TarteaucitronCustomize) {
    return {
        register(container: IContainer) {
            const configClass = container.get(ITarteaucitronConfiguration);
            configClass.setContainer(container);

            if (input !== undefined) {
                if (input.services !== undefined) {
                    configClass.setServices(input.services);
                }
                if (input.options !== undefined) {
                    configClass.setUserOptions(input.options);
                }
                if (input.init !== undefined) {
                    Object.assign(configClass.getConfig(), input.init);
                }
            }

            container.register(TarteaucitronService);
            container.get(TarteaucitronService);

            return container;
        },
        customize(input: TarteaucitronCustomize) {
            return createTarteaucitronConfiguration(input);
        }
    };
}

export const TarteaucitronConfiguration = createTarteaucitronConfiguration();

export {Configure, ITarteaucitronConfiguration};
export type {TarteaucitronOptions};
