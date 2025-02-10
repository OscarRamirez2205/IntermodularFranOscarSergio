import { Directive, HostListener, Input } from '@angular/core';

@Directive({
  selector: '[caracteresRestringidos]',
})
export class RestringirInputDirective {
  @Input('caracteresRestringidos') restrictedChars: string = '';

  @HostListener('keydown', ['$event']) onKeyDown(event: KeyboardEvent) {
    if (this.restrictedChars.includes(event.key)) {
      event.preventDefault();
    }
  }
}
