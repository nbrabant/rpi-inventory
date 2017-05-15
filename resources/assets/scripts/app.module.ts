import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { routes } from './app.routing';

// components
import { AppComponent } from './app.component';
import { ProgressBar } from "./components/ui/progress-bar/progress-bar.component";
import { MenuBar } from "./components/ui/menubar/menubar.component";

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
		ProgressBar
	],
	providers: [],
	bootstrap:[
        AppComponent
	]
})
export class AppModule {}
