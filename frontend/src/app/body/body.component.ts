import { Component } from '@angular/core';
import { CompanyComponent } from '../company/company.component';
import { EmpresaFiltrarOrdenarService } from '../services/empresa-orden.service';

@Component({
  selector: 'app-body',
  standalone: true,
  imports: [CompanyComponent],
  templateUrl: './body.component.html',
  styleUrl: './body.component.scss'
})
export class BodyComponent {
  constructor(public empresaService: EmpresaFiltrarOrdenarService) {}
}