import { Component } from '@angular/core';
import { MenuItemConfig, MenuItem } from './navbar.metadata';
import { MenuList } from './navbar-routes.config';

@Component({
    selector: 'navbar',
    template: require('./navbar.template.html')
})
export class NavbarComponent {
	public menuItems: MenuItemConfig;
	isCollapsed = false;

	constructor() {
		this.menuItems = this.findNavRoutes(MenuList);
	}

	private findNavRoutes(menuEntries:MenuItemConfig) {
		let returnArray:MenuItemConfig = [];
		menuEntries.forEach((menuEntry:MenuItem) => {
			if (menuEntry.mainNav) {
				returnArray.push(menuEntry);
			}
		});
		return returnArray;
	}

	// public get menuIcon(): string {
	// 	return this.isCollapsed ? '☰' : '✖';
	// }

	// public getMenuItemClasses(menuItem: any) {
	// 	return {
	// 		'pull-xs-right': this.isCollapsed
	// 	};
	// }
}
