import { Component, Inject, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { Product, Products } from '../../../class/product';
import { ProductService } from '../../../services/product.service';

@Component({
    'selector': 'state-template',
    'template': require('./products.template.html')
})
export class ProductsComponent implements OnInit {

	title = 'Produits';

	/**
     * @type {Router}
     */
    private router: Router;

	/**
     * @type {Product}
     */
    products: Products;

	constructor (
        @Inject(Router) router: Router,
		private productService: ProductService
    ) {
        this.router = router;
	}

	getProducts() {
		this.productService
			.getProducts()
	  		.then(products => this.products = products);
	}

	ngOnInit(): void {
		this.getProducts();
	}

	public run (): void {}



}
