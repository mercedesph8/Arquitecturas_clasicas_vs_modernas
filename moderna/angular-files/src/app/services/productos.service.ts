import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { ProductoModel } from '../models/producto.model';

@Injectable({ providedIn: 'root' })
export class ProductosService {
  constructor(private api: ApiService) {}

  getProductos(): Observable<ProductoModel[]> {
    return this.api.get<ProductoModel[]>('productos');
  }

  getProductosPorCategoria(slug: string): Observable<ProductoModel[]> {
    return this.api.get<ProductoModel[]>('productos', { categoria_slug: slug });
  }

  getProducto(id: number): Observable<ProductoModel> {
    return this.api.get<ProductoModel>('producto', { id });
  }
}
