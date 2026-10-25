/**
 * toc.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {bindable, customAttribute, ILogger, INode, IPlatform, resolve} from 'aurelia';

interface IHeading {
    id: string;
    text: string;
    level: number;
}

@customAttribute({name: 'blackcube-toc'})
export class BlackcubeTocCustomAttribute {
    @bindable() public target: string = 'main';
    @bindable() public title: string = 'On this page';

    private headings: IHeading[] = [];
    private links: HTMLAnchorElement[] = [];
    private observer: IntersectionObserver | null = null;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('blackcube-toc'),
        private readonly element: HTMLElement = resolve(INode) as HTMLElement,
        private readonly p: IPlatform = resolve(IPlatform),
    ) {
        this.logger.trace('constructor');
    }

    public attached() {
        this.logger.trace('attached');
        const targetEl = this.p.document.querySelector(this.target);
        if (targetEl === null) {
            this.element.style.display = 'none';
            return;
        }
        const nodes = targetEl.querySelectorAll('h2, h3');
        if (nodes.length === 0) {
            this.element.style.display = 'none';
            return;
        }
        this.collectHeadings(nodes);
        this.render();
        this.observe(nodes);
    }

    public detaching() {
        this.logger.trace('detaching');
        this.observer?.disconnect();
        this.observer = null;
    }

    public dispose() {
        this.logger.trace('dispose');
        this.observer?.disconnect();
        this.observer = null;
    }

    private collectHeadings(nodes: NodeListOf<Element>) {
        this.headings = [];
        nodes.forEach((node, i) => {
            const heading = node as HTMLElement;
            if (heading.id === '') {
                heading.id = 'heading-' + i;
            }
            this.headings.push({
                id: heading.id,
                text: heading.textContent?.trim() ?? '',
                level: parseInt(heading.tagName.substring(1), 10),
            });
        });
    }

    private render() {
        const titleEl = this.p.document.createElement('p');
        titleEl.className = 'text-xs font-semibold text-secondary-500 dark:text-secondary-400 uppercase tracking-wider mb-3';
        titleEl.textContent = this.title;

        const nav = this.p.document.createElement('div');
        nav.className = 'space-y-1 border-l-2 border-secondary-200 dark:border-secondary-700';

        for (const heading of this.headings) {
            const link = this.p.document.createElement('a');
            link.href = '#'+heading.id;
            link.textContent = heading.text;
            link.className = 'block py-1 text-sm text-secondary-600 dark:text-secondary-400 hover:text-primary-700 dark:hover:text-primary-400 border-l-2 -ml-px border-transparent hover:border-primary-500';
            link.classList.add(heading.level === 2 ? 'pl-4' : 'pl-8');
            this.links.push(link);
            nav.appendChild(link);
        }

        this.element.innerHTML = '';
        this.element.appendChild(titleEl);
        this.element.appendChild(nav);
    }

    private observe(nodes: NodeListOf<Element>) {
        this.observer = new this.p.window.IntersectionObserver(this.onIntersect, {
            rootMargin: '-80px 0px -60% 0px',
            threshold: 0,
        });
        nodes.forEach((node) => this.observer?.observe(node));
    }

    private onIntersect = (entries: IntersectionObserverEntry[]) => {
        for (const entry of entries) {
            if (entry.isIntersecting === true) {
                this.setActive(entry.target.id);
                break;
            }
        }
    };

    private setActive(id: string) {
        const activeClasses = ['border-primary-500', 'text-primary-700', 'dark:text-primary-400', 'font-medium'];
        const inactiveClasses = ['border-transparent', 'text-secondary-600', 'dark:text-secondary-400'];

        for (const link of this.links) {
            const linkId = link.getAttribute('href')?.substring(1) ?? '';
            link.classList.remove(...activeClasses, ...inactiveClasses);
            if (linkId === id) {
                link.classList.add(...activeClasses);
            } else {
                link.classList.add(...inactiveClasses);
            }
        }
    }
}
