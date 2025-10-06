import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { ApiService } from './api.service';
import { CategoriaModel } from '../models/categoria.model';

@Injectable({ providedIn: 'root' })
export class CategoriasService {
  constructor(private api: ApiService) {}

  getCategorias(): Observable<CategoriaModel[]> {
    return this.api.get<CategoriaModel[]>('categorias');
  }
}
