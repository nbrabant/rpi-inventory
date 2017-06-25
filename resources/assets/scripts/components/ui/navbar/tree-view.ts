import { Component, Input } from '@angular/core';
import { MenuItem } from './navbar.metadata';

@Component({
    selector: 'tree-view',
    templateUrl: './tree-view.html'
})

export class TreeView {
    @Input() root: false;

    @Input() menuItems: Array<MenuItem>;

}
