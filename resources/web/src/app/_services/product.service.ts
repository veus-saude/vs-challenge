import { Injectable } from '@angular/core';
import {HttpClient, HttpErrorResponse} from '@angular/common/http';
import {Observable, throwError} from "rxjs/index";
import {catchError, map} from "rxjs/internal/operators";

@Injectable({ providedIn: 'root' })
export class ProductService {
    constructor(private http: HttpClient) { }

    searchProducts(params) {
        let options = {params: params};
        return this.http.get<any>(`${config.apiUrl}/products`,options);
    }

    deleteProduct(id: number) {
        return this.http.delete(`${config.apiUrl}/products/${id}`);
    }

    getProduct(id: number): Observable<any> {
        let url = `${config.apiUrl}/products/${id}`;
        return this.http.get(url).pipe(
            map((res: Response) => {
                return res || {}
            }),
            catchError(this.errorMgmt)
        )
    }

    createProduct(data): Observable<any> {
        let url = `${config.apiUrl}/products`;
        return this.http.post(url, data)
            .pipe(
                catchError(this.errorMgmt)
            )
    }


    updateProduct(id, data): Observable<any> {
        let url = `${config.apiUrl}/products/${id}`;
        return this.http.put(url, data).pipe(
            catchError(this.errorMgmt)
        )
    }

    errorMgmt(error: HttpErrorResponse) {
        let errorMessage = '';
        if (error.error instanceof ErrorEvent) {
            errorMessage = error.error.message;
        } else {
            errorMessage = `Error Code: ${error.status}\nMessage: ${error.message}`;
        }
        console.log(errorMessage);
        return throwError(errorMessage);
    }
/*
    // Get all turnos
    getTurnos() {
        return this.http.get(`${this.baseUri}/${this.pathUri}`);
    }

    // Get turno
    getTurno(id): Observable<any> {
        let url = `${this.baseUri}/${this.pathUri}/read/${id}`;
        return this.http.get(url, {headers: this.headers}).pipe(
            map((res: Response) => {
                return res || {}
            }),
            catchError(this.errorMgmt)
        )
    }

    // Update turno
    updateTurno(id, data): Observable<any> {
        let url = `${this.baseUri}/${this.pathUri}/update/${id}`;
        return this.http.put(url, data, { headers: this.headers }).pipe(
            catchError(this.errorMgmt)
        )
    }

    // Delete turno
    deleteTurno(id): Observable<any> {
        let url = `${this.baseUri}/${this.pathUri}/delete/${id}`;
        return this.http.delete(url, { headers: this.headers }).pipe(
            catchError(this.errorMgmt)
        )
    }*/
}