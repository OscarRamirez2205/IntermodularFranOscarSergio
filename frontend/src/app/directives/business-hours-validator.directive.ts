import { Directive } from '@angular/core';
import { AbstractControl, NG_VALIDATORS, ValidationErrors, Validator } from '@angular/forms';

@Directive({
  selector: '[business-hours]',
  standalone: true,
  providers: [{
    provide: NG_VALIDATORS,
    useExisting: BusinessHoursValidatorDirective,
    multi: true
  }]
})
export class BusinessHoursValidatorDirective implements Validator {
  validate(control: AbstractControl): ValidationErrors | null {
    const start = control.get('start')?.value;
    const end = control.get('end')?.value;

    if (start && end) {
      const startTime = new Date(`2000-01-01T${start}`);
      const endTime = new Date(`2000-01-01T${end}`);

      if (startTime >= endTime) {
        return { invalidHours: true };
      }
    }
    return null;
  }
}