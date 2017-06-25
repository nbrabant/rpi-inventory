export interface MenuItem {
	path?: string;
	name: string;
	mainNav?: boolean;
	icon?: string;
	children?: MenuItem[];
}

export declare type MenuItemConfig = MenuItem[];
