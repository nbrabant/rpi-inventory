import { MenuItemConfig } from './navbar.metadata';

export const MenuList: MenuItemConfig = [
	{
		path: '',
		name: 'Accueil',
		mainNav: true,
		icon: 'fa-home'
	}, {
		path: 'liste-courses',
		name: 'Liste de courses',
		mainNav: true,
		icon: 'fa-shopping-cart'
	}, {
		path: 'stocks',
		name: 'Etat des stocks',
		mainNav: true,
		icon: 'fa-dropbox',
		children: [
			{ path: 'categories', name: 'Catégories', mainNav: false },
			{ path: 'products', name: 'Produits', mainNav: false },
			{ path: 'consomation', name: 'Consomation', mainNav: false }
		]
	}, {
		path: 'recettes',
		name: 'Recettes',
		mainNav: true,
		icon: 'fa-cutlery',
		children: [
			{ path: '', name: 'Liste des recettes', mainNav: false },
			{ path: 'recettes/recherche', name: 'Rechercher une recette à partir d\'ingrédients', mainNav: false }
		]
	}, {
		path: 'agendas',
		name: 'Agenda',
		mainNav: true,
		icon: 'fa-calendar',
		children: [
			{ path: '', name: 'Gérer les recettes de la semaine' }
		]
 	}
];
