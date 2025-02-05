import { Component } from '@angular/core';
import { EmpresaFiltrarOrdenarService } from '../services/empresa-orden.service';
import { FiltersComponent } from '../filters/filters.component';
import { BodyComponent } from '../body/body.component';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css'],
  imports: [FiltersComponent, BodyComponent],
  standalone: true
})
export class DashboardComponent {
  empresasFiltradasOrdenadas;

  constructor(private empresaService: EmpresaFiltrarOrdenarService) {
    this.empresasFiltradasOrdenadas = this.empresaService.empresasFiltradasOrdenadas;
  }

  cambiarOrden(direccion: 'ascendente' | 'descendente') {
    this.empresaService.actualizarOrdenDireccion(direccion);
  }

  cambiarFactorOrden(campo: 'nombre' | 'score' | 'vacantes') {
    this.empresaService.actualizarOrdenCampo(campo);
  }
}