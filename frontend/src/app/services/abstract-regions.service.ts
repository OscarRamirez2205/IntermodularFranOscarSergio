import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { Region, Town } from '../types';

@Injectable()
export abstract class AbstractRegionsService {
  abstract getRegions(): Observable<Region[]>;
  abstract getTowns(regionId: string): Observable<Town[]>;
}