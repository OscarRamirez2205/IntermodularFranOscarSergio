import { inject } from '@angular/core';
import { CanMatchFn } from '@angular/router';
import { AbstractAuthService } from '../services/abstarct-auth.service';

export const studentMatchGuard: CanMatchFn = (route, segments) => {
  return inject(AbstractAuthService).role() === 'student';
};

export const teacherMatchGuard: CanMatchFn = (route, segments) => {
  return inject(AbstractAuthService).role() === 'teacher';
};

export const businessMatchGuard: CanMatchFn = (route, segments) => {
  return inject(AbstractAuthService).role() === 'business';
};

export const adminMatchGuard: CanMatchFn = (route, segments) => {
  return inject(AbstractAuthService).role() === 'admin';
};

export const teacherOrAdminMatchGuard: CanMatchFn = (route, segments) => {
  const role = inject(AbstractAuthService).role();
  return role === 'teacher' || role === 'admin';
};