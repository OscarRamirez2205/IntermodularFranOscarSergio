import { inject } from '@angular/core';
import { Router } from '@angular/router';
import { AbstractAuthService } from '../services/abstarct-auth.service';

export const authGuard = () => {
  const authService = inject(AbstractAuthService);
  const router = inject(Router);

  if (authService.username()) {
    return true;
  }

  return router.parseUrl('/');
};