import { Directive, ElementRef, HostListener, Input, Renderer } from '@angular/core';

@Directive({
	selector: '[treelist]'
})
export class TreeViewDirective {
    constructor(
		private el: ElementRef,
		private renderer: Renderer
	) {}

	@Input() myHidden: boolean;

	ngOnInit() {
		// console.log(
		// 	this.myHidden,
		// 	this.el
		// )
	}

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

	// @HostListener('click') onMouseEnter() {
	// 	this.toggle();
	// }
	//
	// private toggle() {
	//
	// 	if (this.el.nativeElement.className == 'active') {
	// 		this.el.nativeElement.className = 'inactive'
	// 	} else {
	// 		this.el.nativeElement.className = 'active'
	// 	}
	// }
}
