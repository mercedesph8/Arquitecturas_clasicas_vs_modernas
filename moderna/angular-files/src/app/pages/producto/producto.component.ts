import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { ProductosService } from '../../services/productos.service';
import { CategoriasService } from '../../services/categorias.service';
import { ProductoModel } from '../../models/producto.model';

@Component({
  selector: 'app-producto',
  templateUrl: './producto.component.html'
})
export class ProductoComponent implements OnInit {
  id = 0;
  producto: ProductoModel | null = null;
  nombreCategoria = '—';

  constructor(
    private route: ActivatedRoute,
    private productosSvc: ProductosService,
    private categoriasSvc: CategoriasService
  ) {}

  ngOnInit(): void {
    this.route.paramMap.subscribe(params => {
      this.id = Number(params.get('id'));
      this.cargarProducto();
    });
  }

  private cargarProducto(): void {
    this.productosSvc.getProducto(this.id).subscribe({
      next: p => {
        this.producto = p;
        this.categoriasSvc.getCategorias().subscribe(cats => {
          const cat = cats.find(c => c.slug === p.categoria_slug);
          this.nombreCategoria = cat ? cat.nombre : 'Sin categoría';
        });
      },
      error: _ => this.producto = null
    });
  }
}
