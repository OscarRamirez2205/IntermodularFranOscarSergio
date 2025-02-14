import { Injectable, computed, signal } from '@angular/core';
import { Company, Filtros, Region, Category, Service, Preguntas } from '../types';
import { HttpCompaniesService } from './http-companies.service';
import { HttpCategoriesService } from './http-categories.service';
import { HttpRegionsService } from './http-regions.service';
import { HttpPreguntasService } from './http-preguntas.service';

@Injectable({
  providedIn: 'root'
})
export class EmpresaFiltrarOrdenarService {
  private empresasSignal = signal<Company[]>([]);
  private regionesSignal = signal<Region[]>([]);
  private categoriasSignal = signal<Category[]>([]);
  private serviciosSignal = signal<Service[]>([]);
  private ciudadesSignal = signal<string[]>([]);
  private preguntasSignal = signal<Preguntas[]>([]);

  private filtrosSignal = signal<Filtros>({
    nombre: '',
    provincia: '',
    localidad: '',
    vacantes: '',
    categoria: '',
    servicio: ''
  });
  
  private ordenDireccionSignal = signal<'ascendente' | 'descendente'>('ascendente');
  private ordenCampoSignal = signal<'nombre' | 'score' | 'vacantes'>('nombre');

  constructor(
    private companiesService: HttpCompaniesService,
    private categoriesService: HttpCategoriesService,
    private regionsService: HttpRegionsService,
    private preguntasService: HttpPreguntasService
  ) {
    this.cargarDatos();
  }

  private cargarDatos() {
    this.companiesService.getCompanies().subscribe({
      next: (empresas) => this.empresasSignal.set(empresas),
      error: (error) => console.error('Error cargando empresas:', error)
    });

    this.regionsService.getRegions().subscribe({
      next: (regiones) => {
        this.regionesSignal.set(regiones);
        if (regiones.length > 0) {
          this.cargarCiudades(regiones[0].id);
        }
      },
      error: (error) => console.error('Error cargando regiones:', error)
    });

    this.categoriesService.getCategories().subscribe({
      next: (categorias) => {
        this.categoriasSignal.set(categorias);
        if (categorias.length > 0) {
          this.cargarServicios(categorias[0].id);
        }
      },
      error: (error) => console.error('Error cargando categorías:', error)
    });

    this.preguntasService.getPreguntas().subscribe({
      next: (preguntas) => this.preguntasSignal.set(preguntas),
      error: (error) => console.error('Error cargando preguntas: ', error)
    })
  }

  cargarCiudades(regionId: string) {
    this.regionsService.getTowns(regionId).subscribe({
      next: (ciudades) => this.ciudadesSignal.set(ciudades.map(ciudad => ciudad.name)),
      error: (error) => console.error('Error cargando ciudades:', error)
    });
  }

  cargarServicios(categoryId: string) {
    this.categoriesService.getServices(categoryId).subscribe({
      next: (servicios) => this.serviciosSignal.set(servicios),
      error: (error) => console.error('Error cargando servicios:', error)
    });
  }

  

  // Getters para los datos
  getRegiones = computed(() => this.regionesSignal());
  getCategorias = computed(() => this.categoriasSignal());
  getServicios = computed(() => this.serviciosSignal());
  getCiudades = computed(() => this.ciudadesSignal());

  empresasFiltradasOrdenadas = computed(() => {
    let empresasFiltradas = this.empresasSignal();
    const filtros = this.filtrosSignal();
    const ordenDireccion = this.ordenDireccionSignal();
    const ordenCampo = this.ordenCampoSignal();

    if (filtros.nombre && filtros.nombre.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.name.toLowerCase().includes(filtros.nombre.toLowerCase())
      );
    }

    if (filtros.provincia && filtros.provincia.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.address.region.toLowerCase() === filtros.provincia.toLowerCase()
      );
    }

    if (filtros.localidad && filtros.localidad.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.address.town.toLowerCase() === filtros.localidad.toLowerCase()
      );
    }

    if (filtros.vacantes && filtros.vacantes.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.openings.some(opening => opening.count === parseInt(filtros.vacantes))
      );
    }

    if (filtros.categoria && filtros.categoria.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.categories.includes(filtros.categoria)
      );
    }

    if (filtros.servicio && filtros.servicio.trim() !== '') {
      empresasFiltradas = empresasFiltradas.filter(empresa => 
        empresa.services.includes(filtros.servicio)
      );
    }

    return empresasFiltradas.sort((a, b) => {
      let comparacion: number = 0;
      
      switch (ordenCampo) {
        case 'nombre':
          comparacion = a.name.localeCompare(b.name);
          break;
        case 'score':
          comparacion = (b.score.teacher + b.score.student) - (a.score.teacher + a.score.student);
          break;
        case 'vacantes':
          const vacantesA = a.openings.reduce((sum, opening) => sum + opening.count, 0);
          const vacantesB = b.openings.reduce((sum, opening) => sum + opening.count, 0);
          comparacion = vacantesB - vacantesA;
          break;
      }

      return ordenDireccion === 'ascendente' ? comparacion : -comparacion;
    });
  });

  actualizarFiltros(filtros: Filtros) {
    this.filtrosSignal.set(filtros);
  }

  actualizarOrdenDireccion(direccion: 'ascendente' | 'descendente') {
    this.ordenDireccionSignal.set(direccion);
  }

  actualizarOrdenCampo(campo: 'nombre' | 'score' | 'vacantes') {
    this.ordenCampoSignal.set(campo);
  }

  actualizarRegionSeleccionada(regionId: string) {
    this.cargarCiudades(regionId);
  }

  actualizarCategoriaSeleccionada(categoryId: string) {
    this.cargarServicios(categoryId);
  }
}