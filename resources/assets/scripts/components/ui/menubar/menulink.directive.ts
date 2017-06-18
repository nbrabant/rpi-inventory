import { Directive, ElementRef, HostListener, Input } from '@angular/core';

@Directive({
	selector: '[menulink]'
})
export class MenulinkDirective {
    constructor(private el: ElementRef) { }

	@HostListener('click') onMouseEnter() {
		this.toggle();
	}

	private toggle() {
		if (this.el.nativeElement.className == 'active') {
			this.el.nativeElement.className = 'inactive'
		} else {
			this.el.nativeElement.className = 'active'
		}
	}
}
