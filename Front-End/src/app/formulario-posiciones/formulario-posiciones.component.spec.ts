import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FormularioPosicionesComponent } from './formulario-posiciones.component';

describe('FormularioPosicionesComponent', () => {
  let component: FormularioPosicionesComponent;
  let fixture: ComponentFixture<FormularioPosicionesComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [FormularioPosicionesComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(FormularioPosicionesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
