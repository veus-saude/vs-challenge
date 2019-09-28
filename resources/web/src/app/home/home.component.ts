import { Component, OnInit } from '@angular/core';
import { first } from 'rxjs/operators';

import { User } from '@/_models';
import {ProductService, AuthenticationService, AlertService} from '@/_services';
import {LazyLoadEvent} from "primeng/api";
import {HttpParams} from "@angular/common/http";

@Component({ templateUrl: 'home.component.html' })
export class HomeComponent implements OnInit {
    currentUser: User;
    products = [];
    totalRecords: number = 0;
    params: HttpParams = new HttpParams();

    constructor(
        private authenticationService: AuthenticationService,
        private productService: ProductService,
        private alertService: AlertService
    ) {
        this.currentUser = this.authenticationService.currentUserValue;
    }

    ngOnInit() {
        this.loadAllProducts(this.params);
    }

    deleteProduct(id: number) {
        if (window.confirm('Tem certeza que deseja excluir este registro?')) {

            // reset alerts on submit
            this.alertService.clear();

            this.productService.deleteProduct(id)
                .pipe(first())
                .subscribe(() => {

                this.alertService.success('Produto excluído com sucesso!');
                this.loadAllProducts(this.params);

            });
        }
    }

    loadAllProducts(params) {
        this.productService.searchProducts(params)
            .toPromise()
            .then(r => {
                this.products = r.data.data;
                this.totalRecords = r.data.total;
            })
            .catch(err=>console.log(err));
    }

    loadData(event: LazyLoadEvent) {

        let page = (event.first/event.rows)+1;
        let perPage = event.rows;
        if(page===undefined){
            page = 1;
        }
        if(perPage===undefined){
            perPage = 10;
        }
        let sortFields = event.multiSortMeta;
        let filterFields = event.filters;

        let params = this.params;
        params = params.append('page',page.toString());
        params = params.append('per_page',perPage.toString());

        if(sortFields){
            sortFields.forEach((sortField) => {
                let order = (sortField.order===1)? 'asc' : 'desc';
                params = params.append('sort',`${sortField.field}:${order}`)
            });
        }
        if(filterFields){
            for (let [field, fAtrr] of Object.entries(filterFields)) {
                if(field==='global'){
                    params = params.append('q',fAtrr.value);
                } else {
                    params = params.append('filter',`${field}:${fAtrr.value}`);
                }
            }
        }

        this.loadAllProducts(params)

    }


}