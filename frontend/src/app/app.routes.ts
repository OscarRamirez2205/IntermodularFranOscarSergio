import { Routes } from '@angular/router';
import { authGuard } from './gaurds/auth.guard';
import { StudentProfileComponent } from './student-profile/student-profile.component';
import { TeacherProfileComponent } from './teachers-profile/teacher-profile.component';
import { BusinessProfileComponent } from './business-profile/business-profile.component';
import { AdminProfileComponent } from './admin-profile/admin-profile.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { RouteNotFoundComponent } from './route-not-found/route-not-found.component';
import { CompanyDetailComponent } from './company-detail/company-detail.component';
import { CreateCompanyComponent } from './create-company/create-company.component';
import { LandingComponent } from './landing/landing.component';
import { adminMatchGuard, businessMatchGuard, studentMatchGuard, teacherMatchGuard, teacherOrAdminMatchGuard } from './gaurds/role.guard';
import { FormComponentComponent } from './form-component/form-component.component';

export const routes: Routes = [
  {path: 'profile', canActivate: [authGuard],children: [
      {path: '', component: StudentProfileComponent, canMatch: [studentMatchGuard]},
      {path: '', component: TeacherProfileComponent, canMatch: [teacherMatchGuard]},
      {path: '', component: BusinessProfileComponent, canMatch: [businessMatchGuard]},
      {path: '', component: AdminProfileComponent, canMatch: [adminMatchGuard]}
    ]},
  {path: 'dashboard', component: DashboardComponent, canActivate: [authGuard], canMatch: [teacherOrAdminMatchGuard]},
  {path: 'company/:id', component: CompanyDetailComponent, canActivate: [authGuard], canMatch: [teacherOrAdminMatchGuard]},
  {path: 'create-company', component: CreateCompanyComponent, canActivate: [authGuard], canMatch: [adminMatchGuard]},
  {path: 'form', component: FormComponentComponent},
  {path: '', component: LandingComponent},
  {path: '**', component: RouteNotFoundComponent}
];