import { Component, Input } from '@angular/core';
import {
  trigger,
  state,
  style,
  animate,
  transition
} from '@angular/animations';

@Component({
    'selector': 'menubar',
    'template': require('./menubar.template.html'),
	animations: [
		trigger('menulinkState', [
			state('inactive', style({
				backgroundColor: '#eee',
				transform: 'scale(1)'
			})),
			state('active',   style({
				backgroundColor: '#cfd8dc',
				transform: 'scale(1.1)'
			})),
			transition('inactive => active', animate('100ms ease-in')),
			transition('active => inactive', animate('100ms ease-out'))
		])
	]
})
export class MenuBar { }
