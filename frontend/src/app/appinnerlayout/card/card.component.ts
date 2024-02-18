import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Params, Router } from '@angular/router';
import { BudgetService } from 'src/app/services/budget.service';
import { CardService } from 'src/app/services/card.service';
import { LocalStorageService } from 'src/app/services/local-storage.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-card',
  templateUrl: './card.component.html',
  styleUrls: ['./card.component.scss']
})
export class CardComponent implements OnInit {
  userInfo: any;
  categoryList: any;
  cardForm: FormGroup;
  selectedImage: File;
  imagePath: string;
  currentId: number;
  formSubmitted: boolean = false;

  cardData: any;
  constructor(private formBuilder: FormBuilder,
    private localStorageService: LocalStorageService,
    private cardService: CardService,
    private activatedRoute: ActivatedRoute,
    private router: Router) { }

  ngOnInit(): void {


    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const formattedDate = `${year}-${month}-${day}`;


    this.activatedRoute.params.subscribe((params: Params) => {
      this.currentId = parseInt(params['id_card']);
    });


    this.cardForm = this.formBuilder.group({
      name: ['', [Validators.required]],
      // category: ['', [Validators.required]],
      // amount: ['', [Validators.required, Validators.pattern(/^\d+(\.\d{1,2})?$/)]],
      // dateOfTransaction: [formattedDate, Validators.required],
      // description: ['', Validators.pattern(/^[a-zA-Z0-9\s.,!?()-]+$/)],
      id: [null],
      // type: [null, [Validators.required]],
      image: [null]
    });


    // this.getCategories();

    // if edit mode get the details
    this.getDetails();
  }

  getDetails() {
    if (this.currentId) {

      this.cardService.getDetails(this.currentId).subscribe(
        (response) => {
          this.cardData = response.data;
          this.cardForm.patchValue({
            id: this.cardData.id_card,
            name: this.cardData.name
          });
          this.imagePath = response.imagePath
        }, (error) => { },
      );
    }

  }

  // getCategories(){
  //   this.cardService.categoryList(this.type).subscribe(
  //     (response) => {
  //       this.categoryList = response;
  //     },(error) => { },
  //   );
  // }

  onSubmit() {
    this.formSubmitted = true;
    if (this.cardForm.valid) {
      const formData = new FormData();
      formData.append('name', this.cardForm.value.name);
      formData.append('id', this.cardForm.value.id);
      formData.append('image', this.selectedImage);


      if (!!this.currentId) {
        this.cardService.updateCard(formData).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              title: 'Card',
              text: 'Card Updated',
              showConfirmButton: false,
              timer: 1500
            }).then((result) => { this.navigateBack(); });
          }, (error) => { },
        );
      } else {
        this.cardService.addCard(formData).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              title: 'Card',
              text: 'Card Added',
              showConfirmButton: false,
              timer: 1500
            }).then((result) => { this.navigateBack(); });
          }, (error) => { },
        );
      }

    }
  }

  navigateBack() {
    this.router.navigateByUrl('/cards');
  }


  onFileChange(event: any) {
    if (event.target.files.length > 0) {
      this.selectedImage = event.target.files[0];
    }
  }
  capitalizeFirstLetter(string: string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  delete() {

    Swal.fire({
      title: 'Are you sure?',
      text: 'Want to Delete Card',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Activate!'
    }).then((result) => {
      if (result.isConfirmed) {
        this.cardService.deleteCard(this.currentId).subscribe(
          (response) => {
            Swal.fire({
              icon: 'success',
              title: 'Card',
              text: 'Card Deleted',
              showConfirmButton: false,
              timer: 1500
            }).then((result) => { this.navigateBack(); });

          }, (error) => {
            Swal.fire({
              icon: 'error',
              title: 'Card',
              text: 'Card Delete Failed!',
              showConfirmButton: false,
              timer: 1500
            });
          },
        );
      }
    });
  }
}
