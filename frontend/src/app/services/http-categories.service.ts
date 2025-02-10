import { HttpClient } from '@angular/common/http';
import { Injectable, Inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Category, Service } from '../types';
import { AbstractCategoriesService } from './abstract-categories.service';
import { API_URL } from '../tokens/api-url.token';

@Injectable({
  providedIn: 'root'
})
export class HttpCategoriesService extends AbstractCategoriesService {
  constructor(
    private http: HttpClient,
    @Inject(API_URL) private apiUrl: string
  ) {
    super();
  }

  getCategories(): Observable<Category[]> {
    return this.http.get<Category[]>(`${this.apiUrl}/categories`);
  }

  getServices(categoryId: string): Observable<Service[]> {
    return this.http.get<Service[]>(`${this.apiUrl}/services?category=${categoryId}`);
  }
}