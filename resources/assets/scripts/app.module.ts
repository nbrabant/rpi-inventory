import { BrowserModule } from '@angular/platform-browser';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';

import { routes } from './app.routing';

// components
import { AppComponent } from './app.component';

@NgModule({
	imports: [
        BrowserModule,
        FormsModule,
        HttpModule,
        RouterModule.forRoot(routes, {
            useHash: true
        })
	],
	declarations: [],
	providers: [],
	bootstrap:[
        AppComponent
	]
})
export class AppModule {}
