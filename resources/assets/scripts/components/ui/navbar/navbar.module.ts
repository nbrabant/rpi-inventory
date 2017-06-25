import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { RouterModule } from '@angular/router';
import { NavbarComponent } from './navbar.component';
import { TreeView } from './tree-view';
import { TreeViewDirective } from './tree-view.directive';

@NgModule({
	imports: [
		RouterModule,
		CommonModule
	],
	declarations: [
		NavbarComponent,
		TreeView,
		TreeViewDirective
	],
	exports: [
		NavbarComponent,
		TreeViewDirective
	]
})
export class NavbarModule {}
