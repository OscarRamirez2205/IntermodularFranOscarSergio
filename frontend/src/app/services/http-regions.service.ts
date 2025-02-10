import { HttpClient } from '@angular/common/http';
import { Injectable, Inject } from '@angular/core';
import { Observable } from 'rxjs';
import { Region, Town } from '../types';
import { AbstractRegionsService } from './abstract-regions.service';
import { API_URL } from '../tokens/api-url.token';

@Injectable({
  providedIn: 'root'
})
export class HttpRegionsService extends AbstractRegionsService {
  constructor(
    private http: HttpClient,
    @Inject(API_URL) private apiUrl: string
  ) {
    super();
  }

  getRegions(): Observable<Region[]> {
    return this.http.get<Region[]>(`${this.apiUrl}/regions?area=10`);
  }

  getTowns(regionId: string): Observable<Town[]> {
    return this.http.get<Town[]>(`${this.apiUrl}/towns?region=${regionId}`);
  }
}