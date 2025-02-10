import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { FiltrosFormElements } from '../types';
import { EmpresaFiltrarOrdenarService } from '../services/empresa-orden.service';

@Component({
  selector: 'app-filters',
  imports: [FormsModule],
  templateUrl: './filters.component.html',
  styleUrls: ['./filters.component.scss'],
  standalone: true,
})
export class FiltersComponent {
  vacantesA: number[] = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

  constructor(public empresaService: EmpresaFiltrarOrdenarService) {}

  onProvinciaSelected(event: Event) {
    const target = event.target as HTMLSelectElement;
    const regiones = this.empresaService.getRegiones();
    const region = regiones.find(r => r.name === target.value);
    if (region) {
      this.empresaService.actualizarRegionSeleccionada(region.id);
    }
  }

  onCategoriaChange(event: Event) {
    const target = event.target as HTMLSelectElement;
    const categorias = this.empresaService.getCategorias();
    const categoria = categorias.find(c => c.name === target.value);
    if (categoria) {
      this.empresaService.actualizarCategoriaSeleccionada(categoria.id);
    }
  }

  onInputChange(event: Event) {
    const form = (event.target as HTMLElement).closest('form') as HTMLFormElement;
    if (!form) return;

    const { nombre, provincia, localidad, vacante, categoria, servicio } = form.elements as FiltrosFormElements;

    this.empresaService.actualizarFiltros({
      nombre: nombre?.value?.trim() || '',
      provincia: provincia?.value || '',
      localidad: localidad?.value || '',
      vacantes: vacante?.value || '',
      categoria: categoria?.value || '',
      servicio: servicio?.value || ''
    });
  }

  onReset(e: Event) {
    const form = e.target as HTMLFormElement;
    form.reset();
    
    const regiones = this.empresaService.getRegiones();
    const categorias = this.empresaService.getCategorias();

    if (regiones.length > 0) {
      this.empresaService.actualizarRegionSeleccionada(regiones[0].id);
    }
    
    if (categorias.length > 0) {
      this.empresaService.actualizarCategoriaSeleccionada(categorias[0].id);
    }

    this.empresaService.actualizarFiltros({
      nombre: '',
      provincia: '',
      localidad: '',
      vacantes: '',
      categoria: '',
      servicio: ''
    });
  }
}