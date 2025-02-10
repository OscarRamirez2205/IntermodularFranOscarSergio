import { Injectable } from '@angular/core';
import { Empresa } from '../../../interfaces/Empresa';
import { GenerarEmpresas } from "./empresa.service";
import empresasData from '../../../data.json';

@Injectable({ providedIn: 'root' })
export class JsonGenerarEmpresas extends GenerarEmpresas {
  constructor() { super() }
  getEmpresas(): Promise<Empresa[]> {
    return Promise.resolve(empresasData.companies as Empresa[]);
  }
}
