import { Component, Inject } from '@angular/core';
import { Router } from '@angular/router';

@Component({
    'selector': 'state-template',
    'template': require('./categories.template.html')
})
export class CategoriesComponent {
	/**
     * @type {Router}
     */
    private router: Router;

	constructor (
        @Inject(Router) router: Router
    ) {
        this.router = router;
	}

	public run (): void {}


}
