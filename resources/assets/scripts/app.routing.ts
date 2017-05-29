import { Routes, RouterModule } from '@angular/router';
import { DashboardComponent } from "./components/app/dashboard/dashboard.component";
import { CategoriesComponent } from "./components/app/categories/categories.component";


export const routes: Routes = [
	{
        path: '',
        component: DashboardComponent
	}, {
        path: 'categories',
        component: CategoriesComponent
	},
];
