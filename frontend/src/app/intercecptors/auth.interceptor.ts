import { HttpInterceptorFn } from '@angular/common/http';
import { inject } from '@angular/core';
import { AbstractAuthService } from '../services/abstarct-auth.service';

export const authInterceptor: HttpInterceptorFn = (req, next) => {
  const authService = inject(AbstractAuthService);
  const token = authService.token();

  if (token) {
    const authReq = req.clone({
      headers: req.headers.set('Authorization', `Bearer ${token}`)
    });
    return next(authReq);
  }

  return next(req);
};