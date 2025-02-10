import { Component } from '@angular/core';
import { AbstractAuthService } from '../services/abstarct-auth.service';

@Component({
  selector: 'app-teacher-profile',
  standalone: true,
  template: `
    <div class="container mt-4">
      <h2>Perfil de profesor</h2>
      <p>Usuario: {{authService.username()}}</p>
    </div>
  `
})
export class TeacherProfileComponent {
  constructor(public authService: AbstractAuthService) {}
}