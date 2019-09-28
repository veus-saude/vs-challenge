import { Router } from '@angular/router';
import { Component, OnInit, NgZone } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import {AlertService, ProductService} from "@/_services";

@Component({
  selector: 'app-product-create',
  templateUrl: './product-create.component.html'
})

export class ProductCreateComponent implements OnInit {
  submitted = false;
  productForm: FormGroup;
  loading = false;

  constructor(
    public fb: FormBuilder,
    private router: Router,
    private ngZone: NgZone,
    private productService: ProductService,
    private alertService: AlertService
  ) {
  }

  ngOnInit() {
      this.productForm = this.fb.group({
          name: ['', [Validators.required]],
          brand: ['', [Validators.required]],
          price: ['', [Validators.required]],
          quantity: ['', [Validators.required]],
      });
  }

  // Getter to access form control
  get myForm() {
    return this.productForm.controls;
  }

  onSubmit() {
    this.submitted = true;

    // reset alerts on submit
    this.alertService.clear();
    // stop here if form is invalid
    if (this.productForm.invalid) {
      return;
    }

    this.loading = true;

    this.productService.createProduct(this.productForm.value).subscribe(
      (res) => {
        this.alertService.success('Produto castrado com sucesso!');
        this.ngZone.run(() => this.router.navigateByUrl('/'));
      }, (error) => {
          this.alertService.error(error);
          this.loading = false;
        console.log(error);
      });

  }

}
