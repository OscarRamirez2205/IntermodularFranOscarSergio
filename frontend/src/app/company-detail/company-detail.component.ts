import { Component, OnInit } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ActivatedRoute, Router } from '@angular/router';
import { HttpCompaniesService } from '../services/http-companies.service';
import { Company } from '../types';

@Component({
  selector: 'app-company-detail',
  standalone: true,
  imports: [CommonModule],
  template: `
    @if (loading) {
      <div class="container mt-4">
        <div class="text-center">
          <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Cargando...</span>
          </div>
          <p class="mt-2">Cargando información de la empresa...</p>
        </div>
      </div>
    } @else if (error) {
      <div class="container mt-4">
        <div class="alert alert-danger">
          {{ error }}
        </div>
      </div>
    } @else if (company) {
      <div class="container mt-4">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            <h2 class="mb-0">{{company.name}}</h2>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h4 class="mb-3">Información de Contacto</h4>
                <ul class="list-unstyled">
                  <li class="mb-2">
                    <i class="bi bi-envelope-fill me-2"></i>
                    <strong>Email:</strong> {{company.email}}
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-telephone-fill me-2"></i>
                    <strong>Teléfono:</strong> {{company.phone}}
                  </li>
                  <li class="mb-2">
                    <i class="bi bi-geo-alt-fill me-2"></i>
                    <strong>Dirección:</strong><br>
                    {{company.address.street}}<br>
                    {{company.address.town}}<br>
                    {{company.address.region}}
                  </li>
                </ul>
              </div>
              <div class="col-md-6">
                <h4 class="mb-3">Horario y Valoraciones</h4>
                <p>
                  <i class="bi bi-clock-fill me-2"></i>
                  <strong>Horario:</strong> {{company.workingHours.start}} - {{company.workingHours.end}}
                </p>
                <div class="mt-4">
                  <h5>Valoraciones</h5>
                  <div class="mb-3">
                    <label class="mb-1">Profesor: {{company.score.teacher}}%</label>
                    <div class="progress">
                      <div class="progress-bar" 
                           role="progressbar" 
                           [style.width.%]="company.score.teacher"
                           [attr.aria-valuenow]="company.score.teacher" 
                           aria-valuemin="0" 
                           aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                  <div>
                    <label class="mb-1">Alumno: {{company.score.student}}%</label>
                    <div class="progress">
                      <div class="progress-bar bg-success" 
                           role="progressbar" 
                           [style.width.%]="company.score.student"
                           [attr.aria-valuenow]="company.score.student" 
                           aria-valuemin="0" 
                           aria-valuemax="100">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="mt-4">
              <h4 class="mb-3">Vacantes Disponibles</h4>
              <div class="row">
                @for (opening of company.openings; track opening.year) {
                  <div class="col-md-3 mb-3">
                    <div class="card">
                      <div class="card-body text-center">
                        <h5 class="card-title">{{opening.year}}</h5>
                        <p class="card-text">{{opening.count}} plazas</p>
                      </div>
                    </div>
                  </div>
                }
              </div>
            </div>
          </div>
        </div>
      </div>
    }
  `,
  styles: [`
    .progress {
      height: 10px;
      margin-bottom: 1rem;
    }
    .card {
      border: none;
    }
    .list-unstyled i {
      color: #0d6efd;
    }
  `]
})
export class CompanyDetailComponent implements OnInit {
  company?: Company;
  loading = true;
  error?: string;

  constructor(
    private route: ActivatedRoute,
    private router: Router,
    private companiesService: HttpCompaniesService
  ) {}

  ngOnInit() {
    const id = this.route.snapshot.paramMap.get('id');
    if (!id) {
      this.error = 'ID de empresa no válido';
      this.loading = false;
      return;
    }

    this.companiesService.getCompany(id).subscribe({
      next: (company) => {
        this.company = company;
        this.loading = false;
      },
      error: (error) => {
        console.error('Error cargando empresa:', error);
        this.error = 'Error al cargar la información de la empresa';
        this.loading = false;
      }
    });
  }
}