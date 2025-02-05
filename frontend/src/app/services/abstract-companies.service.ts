import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Company } from '../types';

@Injectable()
export abstract class AbstractCompaniesService {
  abstract getCompanies(): Observable<Company[]>;
  abstract getCompany(id: string): Observable<Company>;
}