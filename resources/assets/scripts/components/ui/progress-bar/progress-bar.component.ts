import { Component, Input } from '@angular/core';

@Component({
    'selector': 'progress-bar',
    'template': './progress-bar.template.html'
})
export class ProgressBar {
    /**
     * @type {number}
     */
    @Input()
    private progress: number = 0;
}
