/**
 * code-highlight.ts
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

import {bindable, customAttribute, ILogger, INode, IPlatform, resolve} from 'aurelia';
import {ITransitionService} from '../services/transition-service';
import Prism from 'prismjs';
import 'prismjs/components/prism-bash';
import 'prismjs/components/prism-css';
import 'prismjs/components/prism-graphql';
import 'prismjs/components/prism-javascript';
import 'prismjs/components/prism-json';
import 'prismjs/components/prism-markdown';
import 'prismjs/components/prism-markup-templating';
import 'prismjs/components/prism-php';
import 'prismjs/components/prism-scss';
import 'prismjs/components/prism-sql';
import 'prismjs/components/prism-typescript';
import 'prismjs/components/prism-yaml';

@customAttribute({name: 'code-highlight', defaultProperty: 'language'})
export class CodeHighlight {
    @bindable() public language: string = '';

    private rawCode: string = '';
    private copyButton: HTMLButtonElement | null = null;
    private clickHandler: (() => void) | null = null;

    public constructor(
        private readonly logger: ILogger = resolve(ILogger).scopeTo('code-highlight'),
        private readonly p: IPlatform = resolve(IPlatform),
        private readonly element: HTMLElement = resolve(INode) as HTMLElement,
        private readonly transitionService: ITransitionService = resolve(ITransitionService),
    ) {
        this.logger.trace('constructor');
    }

    public attaching() {
        this.logger.trace('attaching');
        const codeElement = this.element.querySelector('code');
        const codeData = codeElement?.textContent ?? '';
        if (codeElement === null || codeData === '') {
            return;
        }
        this.rawCode = codeData.trim();
        if (this.language !== '' && Prism.languages[this.language] !== undefined) {
            this.logger.trace('Language found', this.language);
            const highlighted = Prism.highlight(this.rawCode, Prism.languages[this.language], this.language);
            codeElement.innerHTML = highlighted;
        }
    }

    public attached() {
        this.logger.trace('attached');
        const group = this.element.closest('.group');
        if (group === null) {
            return;
        }
        this.copyButton = group.querySelector('[data-code-highlight="copy"]') as HTMLButtonElement | null;
        if (this.copyButton === null) {
            return;
        }
        this.clickHandler = () => {
            this.p.window.navigator.clipboard.writeText(this.rawCode).then(() => {
                this.logger.trace('Code copied');
                const iconCopy = group.querySelector('[data-code-highlight="icon-copy"]');
                const iconCopied = group.querySelector('[data-code-highlight="icon-copied"]');
                if (iconCopy === null || iconCopied === null) {
                    return;
                }
                this.p.requestAnimationFrame(() => {
                    this.transitionService.run(
                        iconCopied as HTMLElement,
                        (el) => el.classList.remove('scale-150'),
                        (el) => {
                            el.classList.add('hidden');
                            iconCopy.classList.remove('hidden');
                        },
                    );
                });
                iconCopy.classList.add('hidden');
                iconCopied.classList.add('scale-150');
                iconCopied.classList.remove('hidden');
            });
        };
        this.copyButton.addEventListener('click', this.clickHandler);
    }

    public detaching() {
        this.logger.trace('detaching');
        if (this.copyButton !== null && this.clickHandler !== null) {
            this.copyButton.removeEventListener('click', this.clickHandler);
            this.copyButton = null;
            this.clickHandler = null;
        }
    }
}
