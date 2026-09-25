/**
 * configure.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {DI, IContainer} from 'aurelia';

export interface TarteaucitronOptions {
    privacyUrl?: string;
    bodyPosition?: 'top' | 'bottom';
    hashtag?: string;
    cookieName?: string;
    orientation?: 'top' | 'bottom' | 'middle' | 'popup';
    groupServices?: boolean;
    showDetailsOnClick?: boolean;
    serviceDefaultState?: 'true' | 'false' | 'wait';
    showAlertSmall?: boolean;
    cookieslist?: boolean;
    cookieslistEmbed?: boolean;
    showIcon?: boolean;
    iconSrc?: string;
    iconPosition?: 'BottomRight' | 'BottomLeft' | 'TopRight' | 'TopLeft';
    adblocker?: boolean;
    DenyAllCta?: boolean;
    AcceptAllCta?: boolean;
    highPrivacy?: boolean;
    alwaysNeedConsent?: boolean;
    handleBrowserDNTRequest?: boolean;
    removeCredit?: boolean;
    moreInfoLink?: boolean;
    useExternalCss?: boolean;
    useExternalJs?: boolean;
    cookieDomain?: string;
    readmoreLink?: string;
    mandatory?: boolean;
    mandatoryCta?: boolean;
    customCloserId?: string;
    googleConsentMode?: boolean;
    bingConsentMode?: boolean;
    pianoConsentMode?: boolean;
    pianoConsentModeEssential?: boolean;
    softConsentMode?: boolean;
    dataLayer?: boolean;
    serverSide?: boolean;
    partnersList?: boolean;
    [key: string]: unknown;
}

export interface ITarteaucitronConfiguration extends Configure {}
export const ITarteaucitronConfiguration = DI.createInterface<ITarteaucitronConfiguration>(
    'ITarteaucitronConfiguration',
    x => x.singleton(Configure)
);

export class Configure {
    protected _config: TarteaucitronOptions = {
        privacyUrl: '',
        bodyPosition: 'bottom',
        hashtag: '#tarteaucitron',
        cookieName: 'tarteaucitron',
        orientation: 'middle',
        groupServices: false,
        showDetailsOnClick: true,
        serviceDefaultState: 'wait',
        showAlertSmall: false,
        cookieslist: false,
        cookieslistEmbed: false,
        showIcon: true,
        iconPosition: 'BottomRight',
        adblocker: false,
        DenyAllCta: true,
        AcceptAllCta: true,
        highPrivacy: true,
        alwaysNeedConsent: false,
        handleBrowserDNTRequest: false,
        removeCredit: false,
        moreInfoLink: true,
        useExternalCss: true,
        useExternalJs: false,
        readmoreLink: '',
        mandatory: true,
        mandatoryCta: true,
        googleConsentMode: true,
        bingConsentMode: true,
        pianoConsentMode: true,
        pianoConsentModeEssential: false,
        softConsentMode: false,
        dataLayer: false,
        serverSide: false,
        partnersList: false,
    };

    protected _services: string[] = [];
    protected _userOptions: Record<string, unknown> = {};

    private _container: IContainer | null = null;

    public setContainer(container: IContainer): void {
        this._container = container;
    }

    public getContainer(): IContainer | null {
        return this._container;
    }

    public getConfig(): TarteaucitronOptions {
        return this._config;
    }

    public get<T = unknown>(key: keyof TarteaucitronOptions): T {
        return this._config[key] as T;
    }

    public set<T>(key: keyof TarteaucitronOptions, val: T): T {
        this._config[key] = val;
        return val;
    }

    public getServices(): string[] {
        return this._services;
    }

    public setServices(services: string[]): void {
        this._services = services;
    }

    public getUserOptions(): Record<string, unknown> {
        return this._userOptions;
    }

    public setUserOptions(options: Record<string, unknown>): void {
        this._userOptions = options;
    }
}
