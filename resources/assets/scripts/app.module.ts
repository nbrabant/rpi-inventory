import { BrowserModule } from '@angular/platform-browser';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { routes } from './app.routing';

// ui components
import { AppComponent } from './app.component';
import { AppContainer } from './components/ui/app-container/app-container.component';
import { ProgressBar } from "./components/ui/progress-bar/progress-bar.component";
import { MenuBar } from "./components/ui/menubar/menubar.component";

// app directives
import { MenulinkDirective } from "./components/ui/menubar/menulink.directive";

// app components
import { DashboardComponent } from "./components/app/dashboard/dashboard.component";
import { CategoriesComponent } from "./components/app/categories/categories.component";
import { ProductsComponent } from "./components/app/products/products.component";

// app services
import { CategoryService } from "./services/category.service";
import { ProductService } from "./services/product.service";



@NgModule({
	imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        RouterModule.forRoot(routes, {
            useHash: true
        })
	],
	declarations: [
		AppComponent,
		AppContainer,
		ProgressBar,
		MenuBar,
		MenulinkDirective,
		DashboardComponent,
		CategoriesComponent,
		ProductsComponent
	],
	providers: [
		CategoryService,
		ProductService
	],
	bootstrap:[
        AppComponent
	]
})
export class AppModule {}
