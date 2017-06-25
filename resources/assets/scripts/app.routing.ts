import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from "./components/app/dashboard/dashboard.component";
import { CategoriesComponent } from "./components/app/categories/categories.component";
import { ProductsComponent } from "./components/app/products/products.component";


export const routes: Routes = [
	{
        path: '',
        component: DashboardComponent
	}, {
		// @TODO
		path: 'liste-courses',
		component: ProductsComponent
	}, {
        path: 'categories',
        component: CategoriesComponent
	}, {
		path: 'products',
		component: ProductsComponent
	}, {
		// @TODO
        path: 'stocks',
        component: ProductsComponent
	}, {
		// @TODO
		path: 'recettes',
		component: ProductsComponent
	}, {
		// @TODO
		path: 'agendas',
		component: ProductsComponent
	},
];
