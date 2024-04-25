import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Validators, FormControl, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-formulario-posiciones',
  templateUrl: './formulario-posiciones.component.html',
  styleUrl: './formulario-posiciones.component.css',
})
export class FormularioPosicionesComponent {
  empresas: any[] = [];
  productos: any[] = [];

  constructor(private http: HttpClient, private router: Router) {}

  ngOnInit(): void {
    this.obtenerEmpresas();
    this.obtenerProductos();
  }

  obtenerEmpresas(): void {
    this.http
      .get<any[]>('http://localhost:8000/api/empresas')
      .subscribe((empresas) => {
        this.empresas = empresas;
      });
  }

  obtenerProductos(): void {
    this.http
      .get<any[]>('http://localhost:8000/api/productos')
      .subscribe((productos) => {
        this.productos = productos;
      });
  }

  empresaControl = new FormControl('', Validators.required);
  productoControl = new FormControl('', Validators.required);
  monedaControl = new FormControl('', Validators.required);
  fechaControl = new FormControl('', [
    Validators.required,
    this.fechaValidator,
  ]);
  montoControl = new FormControl('', [Validators.required, Validators.min(1)]);

  formulario = new FormGroup({
    idEmpresa : this.empresaControl,
    idProducto : this.productoControl,
    fechaEntregaInicio: this.fechaControl,
    precio: this.montoControl,
    moneda: this.monedaControl,
  });

  fechaValidator(control: FormControl): { [s: string]: boolean } | null {
    const selectedDate = control.value;
    const today = new Date();
    today.setHours(0, 0, 0, 0); 
    if (selectedDate < today) {
      return { invalidDate: true };
    }
    return null;
  }

  formatDate(date: Date): string {
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2);
    const day = ('0' + date.getDate()).slice(-2);
    return `${year}-${month}-${day}`;
  }


  onSubmit(data: any) {
    if (this.formulario.valid) {
      const dataToSend = {
        ...data,
        fechaEntregaInicio: this.formatDate(data.fechaEntregaInicio)
      };
  
      this.http.post('http://localhost:8000/api/posiciones', dataToSend).subscribe((result) =>{
        console.warn('result', result);
        this.router.navigate(['/list']);
      });
  
      console.log('Formulario válido, datos enviados:', dataToSend);
    } else {
      this.formulario.markAllAsTouched();
    }
  }
}
