import { HttpClient } from '@angular/common/http';
import { Injectable, Inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Company } from '../types';
import { AbstractCompaniesService } from './abstract-companies.service';
import { API_URL } from '../tokens/api-url.token';

@Injectable({
  providedIn: 'root'
})
export class HttpCompaniesService extends AbstractCompaniesService {
  constructor(
    private http: HttpClient,
    @Inject(API_URL) private apiUrl: string
  ) {
    super();
  }

  getCompanies(): Observable<Company[]> {
    return this.http.get<Company[]>(`${this.apiUrl}/companies`);
  }

  getCompany(id: string|number): Observable<Company> {
    return this.http.get<Company>(`${this.apiUrl}/companies/${id}`);
  }
}