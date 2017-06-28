import { Component, Inject, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Operation, Operations } from '../../../class/operation';
import { OperationService } from '../../../services/operation.service';

@Component({
    'selector': 'state-template',
    'template': require('./operations.template.html')
})
export class OperationsComponent implements OnInit {

	title = 'Stocks';

	/**
     * @type {Router}
     */
    private router: Router;

	/**
     * @type {Product}
     */
    operations: Operations;

	constructor (
        @Inject(Router) router: Router,
		private operationService: OperationService
    ) {
        this.router = router;
	}

	getOperations() {
		this.operationService
			.getOperations()
	  		.then(operations => this.operations = operations);
	}

	ngOnInit(): void {
		this.getOperations();
	}

	public run (): void {}



}
