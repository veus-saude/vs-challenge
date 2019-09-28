
import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import {AlertService, ProductService} from "@/_services";


@Component({
  selector: 'app-product-edit',
  templateUrl: './product-edit.component.html'
})

export class ProductEditComponent implements OnInit {
  submitted = false;
  editForm: FormGroup;
  loading = false;

  constructor(
    public fb: FormBuilder,
    private actRoute: ActivatedRoute,
    private productService: ProductService,
    private router: Router,
    private alertService: AlertService
  ) {}

  ngOnInit() {
    this.updateProduct();
    const id = this.actRoute.snapshot.paramMap.get('id');
    this.getProduct(id);
    this.editForm = this.fb.group({
        name: ['', [Validators.required]],
        brand: ['', [Validators.required]],
        price: ['', [Validators.required]],
        quantity: ['', [Validators.required]],
    });
  }

  // Getter to access form control
  get myForm() {
    return this.editForm.controls;
  }

  getProduct(id) {
    this.productService.getProduct(id).subscribe(r => {
      let data = r.data;
      this.editForm.setValue({
          name: data['name'],
          brand: data['brand'],
          price: data['price'],
          quantity: data['quantity'],
      });
    });
  }

  updateProduct() {
    this.editForm = this.fb.group({
      name: ['', [Validators.required]],
      brand: ['', [Validators.required]],
      price: ['', [Validators.required]],
      quantity: ['', [Validators.required]],
    });
  }

  onSubmit() {

    this.submitted = true;

    // reset alerts on submit
    this.alertService.clear();
    // stop here if form is invalid
    if (this.editForm.invalid) {
      return;
    }

    if (window.confirm('Tem certeza que deseja alterar este registro?')) {
    const id = this.actRoute.snapshot.paramMap.get('id');
    this.productService.updateProduct(id, this.editForm.value)
      .subscribe(res => {
          this.alertService.success('Produto atualizado com sucesso!');
          this.router.navigateByUrl('/');
      }, (error) => {
          this.loading = false;
          console.log(error);
      });
    }

  }

}
