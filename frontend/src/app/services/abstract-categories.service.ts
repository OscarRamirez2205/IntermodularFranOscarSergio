import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Category, Service } from '../types';

@Injectable()
export abstract class AbstractCategoriesService {
  abstract getCategories(): Observable<Category[]>;
  abstract getServices(categoryId: string): Observable<Service[]>;
}