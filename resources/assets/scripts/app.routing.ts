import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from "./components/app/dashboard/dashboard.component";
import { CategoriesComponent } from "./components/app/categories/categories.component";
import { ProductsComponent } from "./components/app/products/products.component";


export const routes: Routes = [
	{
        path: '',
        component: DashboardComponent
	}, {
        path: 'categories',
        component: CategoriesComponent
	}, {
        path: 'products',
        component: ProductsComponent
	},
];
