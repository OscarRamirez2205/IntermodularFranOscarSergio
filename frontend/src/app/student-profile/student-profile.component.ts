import { Component } from '@angular/core';
import { AbstractAuthService } from '../services/abstarct-auth.service';

@Component({
  selector: 'app-student-profile',
  standalone: true,
  template: `
    <div class="container mt-4">
      <h2>Perfil de estudiante</h2>
      <p>Usuario: {{authService.username()}}</p>
    </div>
  `
})
export class StudentProfileComponent {
  constructor(public authService: AbstractAuthService) {}
}